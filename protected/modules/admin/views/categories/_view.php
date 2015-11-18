<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_name')); ?>:</b>
	<?php echo CHtml::encode($data->category_name); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('category_slug')); ?>:</b>
	<?php echo CHtml::encode($data->category_slug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_order')); ?>:</b>
	<?php echo CHtml::encode($data->display_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published')); ?>:</b>
	<?php echo CHtml::encode((!empty($data->published) && $data->published==1) ? "Yes" : "No"); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />


</div>