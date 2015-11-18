<?php
$current_company_listing_type = Listing::COMPANY_IMMEDIATE;
$HeadTitle = 'Immediate Listing';
$MoveTo = 'Follow Up';
$MoveToType = Listing::COMPANY_FOLLOW_UP;
if(isset($_GET['company_listing_type'])){
    $current_company_listing_type = $_GET['company_listing_type'];
    if($current_company_listing_type==Listing::COMPANY_FOLLOW_UP){
        $HeadTitle = 'Follow Up Listing';
        $MoveTo = 'Immediate';
        $MoveToType = Listing::COMPANY_IMMEDIATE;
    }
}

$this->breadcrumbs=array(
	'Company Listings Management',
);

$menus=array(
	array('label'=> Yii::t('translation','Create'), 'url'=>array('create','company_listing_type'=>$current_company_listing_type)),
	array('label'=> Yii::t('translation','Export'), 'url'=>array('export')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('listing-company-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#listing-company-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('listing-company-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('listing-company-grid');
        }
    });
    return false;
});
");
?>

<?php include '_tab_index.php'; ?>

<div class="search-form" style="">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php include '_tab_bulk_action.php'; ?>
<?php include '_tab_grid.php'; ?>



