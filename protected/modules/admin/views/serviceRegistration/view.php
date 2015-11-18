<?php
$this->breadcrumbs = array(
    'Service Registration Management' => array('index'),
    'View registration #' .$model->fullname,
);

$menus = array(
    array('label' => 'Service Registration Management', 'url' => array('index')),
    array('label' => 'Delete Service Registration', 'url' => array('delete'), 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View registration <?php echo $model->fullname; ?></h1>

<h3>Property Information</h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'propertyTypeText',
		'roomTypeText',
		'room_size',
	),
)); ?>

<h3>Profile Registration</h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fullname',
		'email',
		'contact_no',
		'address',
		'preferedTimeText',
		'knowByText',
		'created_at:datetime',
	),
)); ?>

<h3>Services</h3>
<?php foreach($model->getRegisteredServiceData() as $group): ?>
	<p><strong><?= $group['model']->name ?></strong></p>
	<ul>
	<?php foreach($group['childs'] as $item): ?>
	<li><?= $item->name ?></li>
	<?php endforeach ?>
	</ul>
<?php endforeach ?>
