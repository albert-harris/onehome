Dear <?php echo $name; ?>,<br />
Someone requested that the password be reset for the following account:<br />
<br />
Username: <?php echo $name ?><br />
<br />
If this was a mistake, just ignore this email and nothing will happen.<br />
<br />
To reset your password, visit the following address:
<?php echo CHtml::link(
    'Reset Password',
    Yii::app()->createAbsoluteUrl(
        '/admin/site/resetPassword',
        array('id'=>$id, 'key'=>$key)
    )
) ?><br />
<br />
Regards, <br />
Judoing
