<div class="c2">
    <div class="row">
        <?php echo $form->labelEx($model,'floor_area'); ?>
        <?php echo $form->textField($model,'floor_area',array('class'=>'float_l number_only w-250','maxlength'=>20)); ?>
        <div class="f-left" style="padding:3px;color: red;"> <?php echo Listing::LAND_AREA_UNIT; ?></div>
        <?php echo $form->error($model,'floor_area'); ?>
    </div> 
    <div class="row ">
        <?php echo $form->labelEx($model,'of_bedroom'); ?>
        <?php echo $form->textField($model,'of_bedroom',array('class'=>'number_only w-250','maxlength'=>20)); ?>
        <?php echo $form->error($model,'of_bedroom'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'company_storey'); ?>
        <?php echo $form->textField($model,'company_storey',array('class'=>'w-250','maxlength'=>200)); ?>
        <?php echo $form->error($model,'company_storey'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'company_utility_room'); ?>
        <?php echo $form->textField($model,'company_utility_room',array('class'=>'w-250','maxlength'=>20)); ?>
        <?php echo $form->error($model,'company_utility_room'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'price'); ?>
        <?php echo $form->textField($model,'price',array('class'=>'number_only w-250','maxlength'=>20)); ?>
        <?php echo $form->error($model,'price'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'company_built_up'); ?>
        <?php echo $form->textField($model,'company_built_up',array('class'=>'w-250','maxlength'=>200)); ?>
        <?php echo $form->error($model,'company_built_up'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'tenure'); ?>
        <?php echo $form->textField($model,'tenure',array('class'=>'w-250','maxlength'=>200)); ?>
        <?php echo $form->error($model,'tenure'); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'company_availability'); ?>
        <?php echo $form->textField($model,'company_availability',array('class'=>'w-250','maxlength'=>200)); ?>
        <?php echo $form->error($model,'company_availability'); ?>
    </div> 
    
    <div class="row">
        <?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id', 
			CHtml::listData(Users::getTelemarketers(), 'id', 'name_for_slug')); ?>
    </div> 
    <div class="row">
        <?php echo $form->labelEx($model,'last_update_time'); ?>
        <?php echo $cmsFormater->formatDate($model->last_update_time); ?>
    </div> 

</div> 