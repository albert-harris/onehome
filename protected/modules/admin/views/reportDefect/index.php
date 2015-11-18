<?php
$this->breadcrumbs=array(
	Yii::t('translation','Tenancies Management')=>array('tenancy/index'),
	'Report Defect(s)',
);

$menus = array(	
//        array('label'=> Yii::t('translation', 'Tenancies Management'), 'url'=>array('tenancy/index')),
	array('label'=> 'Create Report Defect(s)', 'url'=>array('create', 'id'=>$model->transaction_id), 'moreClass'=>'createCallsLog'),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$this->menu [] = array('label'=> Yii::t('translation', 'Tenancies Management'), 'url'=>array('tenancy/index'));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-defect-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-defect-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-defect-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-defect-grid');
        }
    });
    return false;
});
");

$mTrans = $model->rTransactions;
$cmsFormater = new CmsFormatter(); 
$arrVal = array("name"=>$mTrans->listing->property_name_or_address, "transaction_id"=>$mTrans->id);
$sPropertyName = $cmsFormater->formatpropertyname($arrVal);
$tenancy_agreement_date = $cmsFormater->formatLongDate($mTrans->tenancy_agreement_date);
$expiring_date = $cmsFormater->formatLongDate($mTrans->expiring_date);

$titleH1 = $sPropertyName." [ $tenancy_agreement_date - $expiring_date ] ";
?>
<h1>Report Defect(s): <?php echo $titleH1; ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-defect-grid',
	'dataProvider'=>$model->search(),
//	'enableSorting' => false,
	'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank(); fnUpdateColorbox(); }',
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'header' => 'Date/Time',
            'name' => 'created_date',
            'type' => 'DateTimeReport',
            'value' => '$data->created_date',
            'headerHtmlOptions' => array('class'=>'first','style' => 'text-align:center;'),
        ),
        array(
            'name' => 'description',
            'value' => '$data->description',
        ),
            
        array(
            'name' => 'location_text',            
        ),
//        array(
//            'header' => 'Location',
//            'value' => 'ProReportDefect::GetViewLocation($data)',
//        ),
        array(
            'header' => 'Uploaded Photos',
            'name'=>'photo',
            'type'=>'PhotoAdmin',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'header' => 'Status',
            'value' => 'CmsFormatter::$statusReport[$data->status]',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
	
        array(
            'name'=>'approved_by_progess',
            'type'=>'ReportApproveBy',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),            
        array(
            'name'=>'approved_date',
            'type'=>'ReportApproveDate',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),            
        array(
            'name'=>'remark',
            'type'=>'ReportApproveRemark',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;'),
        ),            
            
        array(
                'header' => 'Actions',
                'class'=>'CButtonColumn',
                'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('UpdateDefectStatus','update','delete')),
                'buttons'=>array(
                    'UpdateDefectStatus'=>array(
                        'label'=>'Update Status Report Defect(s)',
                        'imageUrl'=>Yii::app()->theme->baseUrl . '/admin/images/edit.png',
                        'options'=>array('class'=>'update UpdateDefectStatus'),
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/reportDefect/UpdateDefectStatus",
                            array("id"=>$data->id))',
                        'visible'=>'$data->status != CmsFormatter::COMPLETE_REPORT',
                    ),
                    'updateDefect'=>array(
                        'label'=>'Update Report Defect(s)',
                        'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/update.png',
                        'options'=>array('class'=>'update update_item'),
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/transactions/updateDefect",
                            array("id"=>$data->id))',
                    ),
                    'deleteDefect'=>array(
                        'label'=>'Update Report Defect(s)',
                        'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/delete.png',
                        'options'=>array('class'=>'delete'),
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/transactions/deleteDefect",
                            array("id"=>$data->id))',
                    ),
                ),                      
        ),
            
            
	),
)); ?>


<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />

<script>
$(document).ready(function() {
    fnUpdateColorbox();

//    jQuery(document).on('click','#pro-defect-grid a.delete',function() {
//	if(!confirm('Are you sure you want to delete this item?')) return false;
//	var th = this,
//		afterDelete = function(){};
//	jQuery('#pro-defect-grid').yiiGridView('update', {
//		type: 'POST',
//		url: jQuery(this).attr('href'),
//		success: function(data) {
//			jQuery('#pro-defect-grid').yiiGridView('update');
//			afterDelete(th, true, data);
//		},
//		error: function(XHR) {
//			return afterDelete(th, false, XHR);
//		}
//	});
//	return false;
//    });
    
    
     
});

function fnUpdateColorbox(){    
    $(".createCallsLog a").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
    $(".update").colorbox({iframe:true,innerHeight:'535', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
    $(".UpdateDefectStatus").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
    jQuery('a.gallery').colorbox();
//    jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
}
</script>