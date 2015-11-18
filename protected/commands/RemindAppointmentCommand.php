<?php


class RemindAppointmentCommand extends CConsoleCommand
{
    protected $max = 10;
    protected $index = 0;
    protected $data = array();

    public function run($arg)
    {
        $last_working = Yii::app()->setting->getItem('last_working');
        if(!empty($last_working))
        {
            $timestampNext = strtotime(ActiveRecord::timeCalMinutes(- 10));
            if(strtotime($last_working) > $timestampNext)
            {
//                Yii::log(strtotime($last_working), 'error', 'NewsletterCommand.run');
//                Yii::log($timestampNext, 'error', 'NewsletterCommand.run');
                echo 'waiting because last working is nearly';
                return;
            }
        }

        //$this->doTest($arg);
        $this->doJob($arg);
        echo "Sent {$this->index} emails";
        Yii::app()->setting->setDbItem('last_working', date('Y-m-d h:i:s'));
    }
    protected function doTest($arg)
    {
        $data = array(
                            'subject'=>'just for test cron job',
                            'params'=>array(
                                'message'=>'just for test cron job',
                            ),
                            'view'=>'message',
                            'to'=>'quocbao1087@gmail.com',
                            'from'=>Yii::app()->params['autoEmail'],
                        );
                        CmsEmail::mail($data);
    }

    protected function doJob($arg)
    {
        $tomorrow = strtotime("+ 12 day", strtotime(date('Y-m-d H:i:s')));
        $mAppointment = Appointment::model()->findAll(array(
            'condition'=>'t.date_appointment < "' . date('Y-m-d H:i:s', $tomorrow).'" AND t.date_appointment > "' . date('Y-m-d H:i:s').'"',
            'order'=>'t.date_appointment ASC',
        ));

        if(count($mAppointment) > 0)
        {
            foreach($mAppointment as $eApp)
                foreach($eApp->bookings as $booking)
                    if($booking->email_reminded == 0){
                        //send email notification to doctor
                        $modelEmailTemplate = EmailTemplates::model()->findByPk(8);
                        $dataEmail = array( $booking->appointment->users->first_name.' '. $booking->appointment->users->last_name,
                                            $booking->user->first_name.' '.$booking->user->last_name,
                                            $booking->user->email,
                                            $booking->user->phone,
                                            date('l, d M Y, g:i A', strtotime($booking->appointment->date_appointment)),
                                            $booking->id,
                                            $booking->user->first_name.' '.$booking->user->last_name);
                        $pattern = array('{DOCTOR_NAME}',
                                            '{PATIENT_NAME}',
                                            '{PATIENT_EMAIL}',
                                            '{PATIENT_PHONE}',
                                            '{DATE_APPOINTMENT}',
                                            '{BOOKING_ID}',
                                            '{BOOKING_NAME}');

                        $message = str_replace($pattern, $dataEmail, $modelEmailTemplate->email_body);

                        $subject =  $modelEmailTemplate->email_subject;

                        $data = array(
                            'subject'=>$subject,
                            'params'=>array(
                                'message'=>$message,
                            ),
                            'view'=>'message',
                            'to'=>$booking->appointment->users->email,
                            'from'=>Yii::app()->params['autoEmail'],
                        );
                        CmsEmail::mail($data);

                        //send email notification to patient
                        $modelEmailTemplate = EmailTemplates::model()->findByPk(7);
                        $dataEmail = array( $booking->appointment->users->first_name.' '. $booking->appointment->users->last_name,
                                            $booking->user->first_name.' '.$booking->user->last_name,
                                            $booking->appointment->users->doctors->main_specialty,
                                            date('l, d M Y, g:i A', strtotime($booking->appointment->date_appointment)),
                                            $booking->id,
                                            $booking->appointment->address->address);
                        $pattern = array('{DOCTOR_NAME}',
                                            '{PATIENT_NAME}',
                                            '{DOCTOR_SPECIALTY}',
                                            '{DATE_APPOINTMENT}',
                                            '{BOOKING_ID}',
                                            '{DOCTOR_ADDRESS}');
                        $message = str_replace($pattern, $dataEmail, $modelEmailTemplate->email_body);

                        $subject =  $modelEmailTemplate->email_subject;

                        $data = array(
                            'subject'=>$subject,
                            'params'=>array(
                                'message'=>$message,
                            ),
                            'view'=>'message',
                            'to'=>$booking->user->email,
                            'from'=>Yii::app()->params['autoEmail'],
                        );
                        CmsEmail::mail($data);


                        $booking->email_reminded = 1;
                        $booking->update(array('email_reminded'));

                        $this->index++;//count email is sent for current cron job
                        if($this->index >= $this->max)
                            break;
                    }

        }
        else
        {
            return;
        }
    }
}