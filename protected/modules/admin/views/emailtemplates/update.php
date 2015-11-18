<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: update.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<?php
$this->breadcrumbs=array(
	'Email Template Management'=>array('index'),
	$model->email_subject=>array('view','id'=>$model->id),
	'Update',
);

$menus=array(
	array('label'=>'Email Template Management', 'url'=>array('index')),
//	array('label'=>'Create EmailTemplates', 'url'=>array('create')),
	array('label'=>'View Email Template', 'url'=>array('view', 'id'=>$model->id)),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Update Email Template: <?php echo $model->email_subject; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>