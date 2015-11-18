<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	Yii::t('translation','$label')=>array('index'),
	Yii::t('translation','Create'),
);\n";
?>

$menus = array(		
        array('label'=> Yii::t('translation', '<?php echo $this->modelClass; ?> Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo "<?php echo Yii::t('translation', 'Create ".$this->modelClass."'); ?>"; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
