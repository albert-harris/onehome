Dear <?php echo $name;?>,
<br />
As you requested, your password has now been reset. Your new login details are as follows:<br />
<br />
Username: <?php echo $username; ?><br />
Password: <?php echo $password; ?><br />
<?php echo CHtml::link(
    'Login page',
    Yii::app()->createAbsoluteUrl('/member/login')
); ?><br />
<br />
Regards, <br />
Judoing

