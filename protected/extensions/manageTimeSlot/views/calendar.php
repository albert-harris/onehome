<script type="text/javascript">
	function doAjaxCalendarDelete(url, appointment_id)
	{			
		if (confirm('Are you sure you want to delete this appointment ?')) {
		    LoadingScreen('calandar_placeholder', '<?php echo Yii::app()->theme->baseUrl; ?>');
			$.ajax({
				type: 'GET',
				url: url,
				success: function(data){
							$('#appointment_' + appointment_id).remove();
							$("#overlayloading").remove();
						}
	
			});
		}
	}

	function doAjaxCalendarNav(url)
	{	
	    LoadingScreen('calandar_placeholder', '<?php echo Yii::app()->theme->baseUrl; ?>');
	    $.ajax({
	        type: 'GET',
	        url: url,
	        success: function(data){
	                    $('#calandar_placeholder').html(data);
						$("#overlayloading").remove();
	                }

    	});

	}
	function appointments_request(url, obj)
	{
		$.ajax({
	        type: 'GET',
	        url: url+ '&status=' + $(obj).val(),
	        success: function(data){
	                    $('#calandar_placeholder').html(data);
	                }

    	});
	}
	
    function showPopupAppointment(url)
    {
        jQuery.colorbox({href:url});
		return false;

    }

</script>

<?php
function getIsoWeeksInYear($year) {
    $date = new DateTime;
    $date->setISODate($year, 53);
    return ($date->format("W") === "53" ? 53 : 52);
}
$color = array(1=>'type-1',2=>'type-2',3=>'type-3');
/* date settings */

//$starting_date = date('l j M Y', $aWeekDays[0]);
if($startWithCurrentDate != 1){
      $iWeeksInThisYear = getIsoWeeksInYear($year);
      $iNextLinkWeek = $week + 1;
      $iNextLinkYear = $year;

      $iPrevLinkWeek = $week - 1;
      $iPrevLinkYear = $year;

       if($iNextLinkWeek > $iWeeksInThisYear){
          $iNextLinkWeek = 1;
          $iNextLinkYear++;
       }
       if($iPrevLinkWeek < 1){
          $iPrevLinkYear--;
          $iPrevLinkWeek = getIsoWeeksInYear($iPrevLinkYear);
       }
       $sNextLink = '?week='.$iNextLinkWeek.'&year='.$iNextLinkYear;
       $sPrevLink = '?week='.$iPrevLinkWeek.'&year='.$iPrevLinkYear;
 }else{

     $iNextDateLink = strtotime('+ 7 day',$beginDate);
     $iPrevDateLink = strtotime('- 7 day',$beginDate);
     $sNextLink = '?beginDate='.$iNextDateLink.'&doctor_id='.$doctor_id.'&isMine='.$isMine;
     $sPrevLink = '?beginDate='.$iPrevDateLink.'&doctor_id='.$doctor_id.'&isMine='.$isMine;
     $sCurrentLink = '?beginDate='.$beginDate.'&doctor_id='.$doctor_id.'&isMine='.$isMine;
 }
	$deleteAppointmentLink = Yii::app()->createAbsoluteUrl("/member/users/DoctorDeleteAppointment/id");
	$changeAppointmentStatusLink = Yii::app()->createAbsoluteUrl("/member/users/DoctorChangeAppointmentStatus/".$sCurrentLink);
?>


<div class="page">
	<?php if($isMine != 1){ ?>
    <p class="note">Click on the time slot to book an appointment</p>
   	<?php } ?>
    
   <?php /*?> <?php if($isMine == 1){ ?>
    <p class="note">Current status:
    <select name="appointments_request"  onchange="appointments_request('<?php echo $changeAppointmentStatusLink ?>', this)" id="appointments_request">
        <option value="1" <?php if($isAppointmentsRequest == 1){ ?> selected="selected" <?php }?> >Request an Appointment</option>
        <option value="0" <?php if($isAppointmentsRequest == 0){ ?> selected="selected" <?php }?>>Show time slot</option>
    </select>
    </p>
    <?php } ?><?php */?>

    <div class="page-link">
        <a href="javascript:void(0)" <?php if($isPreventBack ==1){  ?>class="none" <?php }else{ ?> onClick="doAjaxCalendarNav('<?php echo Yii::app()->createAbsoluteUrl('/member/users/ajaxProfileCalendarNav/').$sPrevLink ?>')" <?php } ?>><span class="prev">prev 7 days</span></a>
        <a href="javascript:void(0)" <?php if($isPreventNext ==1){  ?>class="none" <?php }else{ ?> onClick="doAjaxCalendarNav('<?php echo Yii::app()->createAbsoluteUrl('/member/users/ajaxProfileCalendarNav/').$sNextLink ?>')"<?php } ?>><span class="next">next 7 days</span></a>
    </div>
</div>
<table cellpadding="0" cellspacing="0" width="100%" class="search-result">
    <thead>
        <tr>
            <?php foreach($aWeekDays as $Day){ ?>
            <th><strong><?php echo date('l', $Day); ?></strong> <?php echo date('j M Y', $Day);
                    $addAppointmentLink = Yii::app()->createAbsoluteUrl("/member/users/DoctorAddAppointment/appointmentDate/" . strtotime(date("Y-m-d", $Day))) ;
                ?>
                <?php /*?><a href="javascript:void(0)" onClick="doAjaxCalendar('<?php echo $addAppointmentLink ?>')"><?php */?>

                <?php if($isMine == 1){ ?>
                    <?php if($this->countNumOfAppointment($Day,$doctor_id) >= 10){ ?>
                    	<a href="javascript:void(0)" onclick="javascript:alert('You can not add more than 10 timeslots per day.')">
                    <?php }else{?>
                    <a href="javascript:void(0)" class="addAppointmentPopup" onclick="showPopupAppointment('<?php echo $addAppointmentLink ?>')">
                    <?php } ?>
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/add.png" width="12" height="12" alt="add appointment" class="add_appoitment_btn"/>
                    </a>
                 <?php } ?>

            </th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <tr>
        <?php if($isAppointmentsRequest != 1){ ?>

            <?php if(count($events) > 0){ ?>
                <?php foreach($aWeekDays as $Day){ $currentDateSlot = date('Y-m-d', $Day);?>
                <td>
                    <?php foreach($events as $event){
                            $eventDate = date ('Y-m-d',strtotime($event['date_appointment']));
                            $eventHour = date ('g:i A',strtotime($event['date_appointment']));
                            if($eventDate == $currentDateSlot){
    							$showAppointmentLink = Yii::app()->createAbsoluteUrl("/member/users/DoctorShowAppointment/id/" .$event['id']) ;
                    ?>
                    <p id="<?php echo 'appointment_'.$event['id'] ?>">

                    <?php if($isMine == 1){ ?>

                        <?php if($this->isBooked($event['id'])){ ?>
                        <a title='booked' href="javascript:void(0)" style="text-decoration: none;" class="showAppointmentPopup" onclick="showPopupAppointment('<?php echo $showAppointmentLink; ?>')">
                            <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/checked-icon.png" width="12" height="12" alt="show appointment" class="delete_appoitment_btn"/>
                        </a>
                        <?php } ?>
                        <a href="javascript:void(0)" class="<?php echo $color[$event->address->order]; ?> showAppointmentPopup" onclick="showPopupAppointment('<?php echo $showAppointmentLink; ?>')">
                            <?php echo $eventHour; ?>
                        </a>

                    	<a href="javascript:void(0)" class="deleteAppointment" onclick="doAjaxCalendarDelete('<?php echo $deleteAppointmentLink.'/'.$event['id'] ?>','<?php echo $event['id'] ?>')">
                    		<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/delete.png" width="12" height="12" alt="delete appointment" class="delete_appoitment_btn"/>
                    	</a>
                    <?php }else{ ?>
                        <?php if(!$this->isBooked($event['id'])){ ?>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl("/member/site/book/doctor_id/".$doctor_id."/appointment_id/" .$event['id']) ?>" class="<?php echo $color[$event->address->order] ?>"><?php echo $eventHour; ?></a>
                        <?php } ?>
                    <?php } ?>


                    </p>
                    <?php }} ?>
                </td>
                <?php } ?>
            <?php }else{ ?>

                <?php if(!empty($sNextAvailableLink)){ ?>
                    <td style="text-align: center; width: 100%" colspan="7">
                    <a href="javascript:void(0)" onClick="doAjaxCalendarNav('<?php echo Yii::app()->createAbsoluteUrl('/member/users/ajaxProfileCalendarNav/').$sNextAvailableLink ?>')">
                        Next available appointment is on <?php echo date('d M', $nextAvailableDate).' at '.date('g.i A', $nextAvailableDate) ?></a></td>
                <?php }elseif(!empty($sFirstAvailableLink)){ ?>
                    <td style="text-align: center; width: 100%" colspan="7">
                    <a href="javascript:void(0)" onClick="doAjaxCalendarNav('<?php echo Yii::app()->createAbsoluteUrl('/member/users/ajaxProfileCalendarNav/').$sFirstAvailableLink ?>')">
                         There are no appointments available.  First available appointment is on <?php echo date('d M', $firstAvailableDate).' at '.date('g.i A', $firstAvailableDate) ?></a></td>
                <?php }else{ ?>
                    <td style="text-align: center; width: 100%" colspan="7">
                         There are no appointments available.</td>
                <?php } ?>
            <?php } ?>


        <?php }else{ ?>
              <td style="text-align: center; width: 100%" colspan="7"><a href="<?php echo Yii::app()->createAbsoluteUrl("/member/site/book/doctor_id/".$doctor_id) ?>">Appointments on request</a></td>

        <?php } ?>
    	</tr>
    </tbody>
</table>

