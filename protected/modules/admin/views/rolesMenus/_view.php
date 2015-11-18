<div class="view">

        <b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->role->role_name), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_id')); ?>:</b>
	<?php echo CHtml::encode($data->menu->menu_name); ?>
	<br />


</div>