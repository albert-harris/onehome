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
	$model->property_name_or_address=>array('view','id'=>$model->id),
	Yii::t('translation','Update')." $HeadTitle",
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Company Listing Management'), 'url'=>array('index')),
	array('label'=> Yii::t('translation', 'View'), 'url'=>array('view', 'id'=>$model->id)),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1><?php echo "Update $HeadTitle: ".$model->property_name_or_address; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>