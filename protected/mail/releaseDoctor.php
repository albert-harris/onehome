Dear <?php echo $name; ?>,<br/><br/>

We appologize for the short notice and regret to inform you the Clinic has released your request a job as  
<br/><br/>
Date: <?php echo $date; ?><br/>
From: <?php echo $from; ?><br/>
To: <?php echo $to; ?><br/>
<br/>
You can try orther position at <?php echo CHtml::link(
    'Judoing',
    Yii::app()->createAbsoluteUrl('/member/login')
); ?>. 
<br /><br /><br/>

Regards, <br/>
Noisy Radar