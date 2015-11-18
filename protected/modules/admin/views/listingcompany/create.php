<?php
$HeadTitle = 'Immediate Listing';
if(isset($_GET['company_listing_type'])){
    $current_company_listing_type = $_GET['company_listing_type'];
    if($current_company_listing_type==Listing::COMPANY_FOLLOW_UP){
        $HeadTitle = 'Follow Up Listing';
    }
}

$this->breadcrumbs=array(
	Yii::t('translation','Company Listing Management')=>array('index'),
	Yii::t('translation','Create')." $HeadTitle",
);

$menus = array(		
        array('label'=> Yii::t('translation', 'Company Listing Management') , 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1><?php echo Yii::t('translation', 'Create')." $HeadTitle"; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>