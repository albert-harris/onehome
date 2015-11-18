<?php
Yii::import('zii.widgets.CPortlet');
class ManageTimeSlot extends CPortlet
{
    public $events;
    public $startWithCurrentDate;// 0 : list from Mon to Sun; 1: list from CurrentDate to next 7 days
    public $doctor_id; //user_id
    public $isMine;

    public function init()
    {
        parent::init();
    }

    public function renderContent()
    {
        //init, get variable
        if(isset($_GET['doctor_id'])) $this->doctor_id =$_GET['doctor_id'];
        if(isset($_GET['isMine'])) $this->isMine =$_GET['isMine'];
        $mUser = Users::model()->find('id='.$this->doctor_id);
        $isAppointmentsRequest = $mUser->doctors->appointments_request;//1-0

        $aTimeSlotColor = array();
        $aTimeSlotColorIndex = 1;
        foreach($mUser->address as $item)
        {
            $aTimeSlotColor[$item['id']] = 'type-'.$aTimeSlotColorIndex;
            $aTimeSlotColorIndex++;
        }

        //config calendar
        $iLimitMonth = 6;
        $startWithCurrentDate = 1;

        if($startWithCurrentDate != 1)
        {
          if(isset($_GET['week'])) $week = (int)$_GET['week'];
          else $week = date('W');

          if(isset($_GET['year'])) $year = (int)$_GET['year'];
          else $year = date('Y');

          $aWeekDays = $this->findWeekDates($week, $year);
          $startDate = date('Y-m-d', $aWeekDays[0]);
          $endDate = date('Y-m-d', $aWeekDays[6]);
        }
        else
        {
          if(isset($_GET['beginDate'])) $beginDate = (int)$_GET['beginDate'];
          else $beginDate = strtotime(date('Y-m-d'));

          $aWeekDays = $this->findWeekDatesByBegin($beginDate);

          $startDate = date('Y-m-d', $aWeekDays[0]);
          $endDate = date('Y-m-d', $aWeekDays[6]);

          if($beginDate <= strtotime(date('Y-m-d'))) $isPreventBack = 1;
          else $isPreventBack = 0;
          if($beginDate >= strtotime ( "+$iLimitMonth month", strtotime(date('Y-m-d')) ))
            $isPreventNext = 1;
          else $isPreventNext = 0;
        }
        $criteria=new CDbCriteria;

        //$criteria->compare('doctor_id', '= 2');
        $criteria->compare('doctor_id', '=' . $this->doctor_id);
        $criteria->addBetweenCondition('DATE(date_appointment)',$startDate,$endDate);
        $criteria->order = 'date_appointment ASC';

        $events = Appointment::model()->findAll($criteria);

        $sNextAvailableLink = '';
        $sFirstAvailableLink = '';
        $nextAvailableDate = '';
        $firstAvailableDate = '';
        if(count($events) == 0)//next available appointment
        {
            $aRowAppID = Yii::app()->db->createCommand()
                ->selectDistinct('appointment_id')
                ->from('65doctor_booking')
                ->queryAll();
            $aAppID = array();
            foreach($aRowAppID as $item){
               $aAppID[] = $item['appointment_id'];
            }

            $criteria2=new CDbCriteria;
            if($this->isMine != 1)
                $criteria2->addNotInCondition('id',$aAppID);

            $criteria2->compare('doctor_id', '=' . $this->doctor_id);
            $criteria2->compare('DATE(date_appointment)', '>' . $endDate);
            $criteria2->order = 'date_appointment ASC';
            $events2 = Appointment::model()->findAll($criteria2);


            if(count($events2) > 0)
            {
               $nextAvailableDate = strtotime($events2[0]->date_appointment);
               $iDaySpan = $this->dateSpan($beginDate, $nextAvailableDate);
               $countWeek = ( int ) ($iDaySpan / 7);
               $nextAvailableDateBegin = strtotime("+ $countWeek week",$beginDate);

               $sNextAvailableLink = '?beginDate='.$nextAvailableDateBegin.'&doctor_id='.$this->doctor_id.'&isMine='.$this->isMine;
            }
            else{//find in past
                $criteria3=new CDbCriteria;

                if($this->isMine != 1)
                    $criteria3->addNotInCondition('id',$aAppID);

                $criteria3->compare('doctor_id', '=' . $this->doctor_id);
                $criteria3->compare('DATE(date_appointment)', '<' . $startDate);
                $criteria3->compare('DATE(date_appointment)', '>=' . date('Y-m-d'));
                $criteria3->order = 'date_appointment ASC';
                $events3 = Appointment::model()->findAll($criteria3);

                if(count($events3) > 0)
                {
                   $firstAvailableDate = strtotime($events3[0]->date_appointment);
                   $iDaySpan = $this->dateSpan($firstAvailableDate, $beginDate);
                   $countWeek = ( int ) ($iDaySpan / 7) + 1;
                   $firstAvailableDateBegin = strtotime("- $countWeek week",$beginDate);

                   $sFirstAvailableLink = '?beginDate='.$firstAvailableDateBegin.'&doctor_id='.$this->doctor_id.'&isMine='.$this->isMine;
                   $isPreventNext = 1;
                }
                else{
                    $firstAvailableDate = strtotime("- 1 day",strtotime(date('Y-m-d')));
                }
            }
        }

        if($startWithCurrentDate != 1)
          $this->render('calendar',array('events'=>$events,
                                      'aWeekDays'=>$aWeekDays,
                                      'week'=>$week,
                                      'year'=>$year,
                                      'startWithCurrentDate'=>$startWithCurrentDate,
                                      'isMine'=>$this->isMine,
                                      'doctor_id'=>$this->doctor_id,
                                      'isAppointmentsRequest'=>$isAppointmentsRequest
                                  ));

        else
            $this->render('calendar',array('events'=>$events,
                                      'aWeekDays'=>$aWeekDays,
                                      'beginDate'=>$beginDate,
                                      'startWithCurrentDate'=>$startWithCurrentDate,
                                      'isPreventBack'=>$isPreventBack,
                                      'isPreventNext'=>$isPreventNext,
                                      'isMine'=>$this->isMine,
                                      'doctor_id'=>$this->doctor_id,
                                      'isAppointmentsRequest'=>$isAppointmentsRequest,
                                      'sNextAvailableLink'=>$sNextAvailableLink,
                                      'sFirstAvailableLink'=>$sFirstAvailableLink,
                                      'nextAvailableDate'=>$nextAvailableDate,
                                      'firstAvailableDate'=>$firstAvailableDate,
                                      'aTimeSlotColor'=>$aTimeSlotColor
                                  ));
    }

    //show calendar from Mon to Sun
    function findWeekDates($weekNumber=null, $year=null )
    {
        // receives a specific Week Number (0 to 52-53) and returns that week's day dates in an array.
        // If no week specified returns this week's dates.

        $weekNumber = ($weekNumber=='') ? date('W'): $weekNumber ;
        $year = ($year=='') ? date('Y'): $year ;

        $weekNumber=sprintf("%02d", $weekNumber);
        for ($i=1;$i<=7;$i++) {
            $arrdays[] = strtotime($year.'W'.$weekNumber.$i);
        }
        return $arrdays;
    }

    //show calendar start from current date to next 7 days
    function findWeekDatesByBegin($beginDate=null)
    {
        for ($i=0;$i<7;$i++) {
            $arrdays[] = strtotime ( "+$i day", $beginDate );
        }
        return $arrdays;
    }
    //count number of appointment on date
    public function countNumOfAppointment($date,$doctor_id)//time
    {
        $criteria=new CDbCriteria;
        $criteria->compare('DATE(date_appointment)',date('Y-m-d', $date));
        $criteria->compare('doctor_id',$doctor_id);
        return Appointment::model()->count($criteria);

    }
    private function dateSpan($startDate, $endDate) {
		if ($endDate >= $startDate)
			return ($endDate - $startDate) / (3600 * 24);
		return - 1;
	}

    public function isBooked($appointmentID)
    {
        $result = Booking::model()->count('appointment_id="'.$appointmentID.'"');
        return $result > 0 ? 1 : 0;
    }

}