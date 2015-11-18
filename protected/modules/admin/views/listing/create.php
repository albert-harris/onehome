<?php

/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<?php
$this->breadcrumbs=array(
	'Listings Management'=>array('index'),
	($model->isNewrecord) ? 'Create New Listing' : 'Update New Listing',
);
$menus=array(
	array('label'=>'Listings Management', 'url'=>array('index')),
);

$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>
<h1><?php echo ($model->isNewrecord) ? 'Create New Listing'  : 'Update New Listing'?></h1>

<?php include_once '_step.php'; ?>
<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'pages-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
        ));
?>


<?php echo $this->renderPartial("step/$view", array('model' => $model, 'form' => $form, 'arrOrther' => (isset($arrOrther)) ? $arrOrther : null)); ?>
<?php $this->endWidget(); ?>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main_be.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/verz_custom_be.css" />
<script>
    $(document).ready(function(){
        $('#pages-form').find('input:submit').click(function(){
            $.blockUI({ message: null });
        });
    });
</script>
