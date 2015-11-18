<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menus-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); 
    if(isset($errorSummary)) {  ?>
    <div class="errorSummary">    
    <ul>
    <li><?php echo $errorSummary; ?></li>
    </ul>
    </div>
    <?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_name'); ?>
		<?php echo $form->textField($model,'menu_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'menu_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_link'); ?>
		<?php echo $form->textField($model,'menu_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'menu_link'); ?>
	</div>
        
    <div class="row">
		<?php echo $form->labelEx($model,'module_name'); ?>
		<?php echo $form->dropDownList($model,'module_name',CmsFormatter::$allModule); ?>
		<?php echo $form->error($model,'module_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controller_name'); ?>
		<?php echo $form->textField($model,'controller_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'controller_name'); ?>
	</div>
        
        
        <?php /*
            <div class="row">
                <?php echo $form->labelEx($model,'controller_name'); ?>
                <?php echo $form->textField($model,'controller_name',array('size'=>30,'maxlength'=>100)); ?>
                <?php echo $form->error($model,'controller_name'); ?>
            </div>


    <div class="row">
        <?php echo $form->labelEx($model,'action_name'); ?>
        <?php echo $form->textField($model,'action_name',array('size'=>30,'maxlength'=>100)); ?>
        <?php echo $form->error($model,'action_name'); ?>
    </div>
 */?>

        <?php
        $tmp_ = array();
        for($i=1;$i<100;$i++)
            $tmp_[$i]=$i;
        ?>
	<div class="row">
		<?php echo $form->labelEx($model,'display_order'); ?>
                <?php echo $form->dropDownList($model,'display_order',$tmp_); ?>
		<?php echo $form->error($model,'display_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'show_in_menu'); ?>
		<?php echo $form->checkBox($model,'show_in_menu',
                (!empty($model->show_in_menu) && $model->show_in_menu==1)?array('checked'=>'checked'):array()); ?>
		<?php echo $form->error($model,'show_in_menu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'place_holder_id'); ?>
		<?php echo $form->dropDownList($model,'place_holder_id',PlaceHolders::loadItems()); ?>
		<?php echo $form->error($model,'place_holder_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'application_id'); ?>
		<?php echo $form->dropDownList($model,'application_id',Applications::loadItems()); ?>
		<?php echo $form->error($model,'application_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo Menus::getDropDownList('Menus[parent_id]','Menus_parent_id',$model->parent_id,true); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

    <div class="row">

        <?php /*?>
		<?php echo $form->labelEx($model,'roles'); ?>
        <div class="menus-role-list">
            <?php echo CHtml::checkBoxList("roles", $aSelectedRoles, $aRoles); ?>
        </div>
        <?php */?>

        <?php echo CHtml::label('Roles','Menus_roles'); ?>

        <div class="menus-role-list">
        <?php foreach($aRoles as $roleID => $roleName){ ?>

            <?php //echo $aRoleMenuActionExist[$roleID]; exit; ?>

            <?php $check = (in_array($roleID,$aSelectedRoles)) ?>
            <?php echo CHtml::label($roleName,'role_'.$roleID); ?>
            <?php echo CHtml::checkBox('roles[]', $check, array('value'=>$roleID, 'id'=>'role_'.$roleID)); ?>
            <?php echo CHtml::textArea('actions[]', isset($aRoleMenuActionExist[$roleID]) ? $aRoleMenuActionExist[$roleID] : '', array('class'=>'rolepermission')); ?>
            </br>

        <?php } ?>
        </div>

	</div>
    <div class="clr"></div>
    <div id="checkboxresult"></div>
    
	<div class="row buttons">
		<span class="btn-submit"><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript">
	jQuery(document).ready(function(){

		validateNumber();

        $("input[name='roles[]']").change(function(){
			//alert(1);
		});



	});
        
        $("input[name='Menus[controller_name]']").change(getAction);
        
        $("select[name='Menus[module_name]']").change(getAction);
        
        function getAction(){
            var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/getactions/getactionsname');?>";
            var request = $.ajax({
                type: "post",
                url: url,
                data: { controller: $("input[name='Menus[controller_name]']").val(), module: $("select[name='Menus[module_name]']").val()}
              }).done(function(msg) {
                $("textarea[name='actions[]']").html(msg);                
              });
              
              request.fail(function() {
                alert( "Wrong controller!");
              });  
              
              getCheckBox();          
        }
        
        function getCheckBox(){
            var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/menus/getcheckbox');?>";
            var request = $.ajax({
                type: "post",
                url: url,
                data: { controller: $("input[name='Menus[controller_name]']").val(), module: $("select[name='Menus[module_name]']").val()}
              }).done(function(msg) {
                $("#checkboxresult").html(msg);                
              });
              
              request.fail(function() {
                alert( "Wrong controller!");
              });
        }
        
	function validateNumber(){
		$(".number").each(function(){
			$(this).unbind("keydown");
			$(this).bind("keydown",function(event){
			    if( !(event.keyCode == 8                                // backspace
			        || event.keyCode == 46                              // delete
			        || event.keyCode == 9							// tab
			        || event.keyCode == 190							// dấu chấm (point) 
			        || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
			        || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
			        || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
			        ) {
			            event.preventDefault();     // Prevent character input
			    	}
			});
		});
	}
	
</script>