<section id="about">

        <?php if(!empty($errmsg)):?>

            <?php echo $errmsg;?>
        <?php endif;?>
  <div class="page-header">
    <h1>Authorize<small><?php echo $rs['application_title']?></a> &nbsp;Access to your account and enjoy a more convenient service</small></h1>
  </div>
  <div class="row">
    <div class="span-one-third">
      <h3>Certain applications</h3>
        <p> Developers：m1840<br>
            Common <span class="gray6">3</span> People use the application </p>
      <ul>
        <li>Access to your personal information, friendships</li>
        <li>Share content to the community</li>
        <li>Your comment</li>
      </ul>
        <p>You can at any time <a target="_blank " href="#">My Settings</a> In the deauthorizing.</p>
    </div>
    <div class="span-two-thirds">
      <h3>Registration Authority</h3>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt>.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('Log in and to authorize the'); ?>
	</div>

<?php $this->endWidget(); ?>
    </div>
  </div><!-- /row -->

</section>

