<?php
/**
 * VerzDesignCMS
 *
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	view.php
 * @author  	duytoan
 */
?>
<?php
$this->breadcrumbs=array(
	'Email Template Management'=>array('index'),
	$model->email_subject,
);

$menus=array(
	array('label'=>'Email Template Management', 'url'=>array('index')),
//	array('label'=>'Create EmailTemplates', 'url'=>array('create')),
	array('label'=>'Update Email Template', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete EmailTemplates', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Email Template: <?php echo $model->email_subject; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'email_subject',
		'email_body:html',
		'parameter_description',
	),
)); ?>
