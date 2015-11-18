<?php
$this->breadcrumbs=array(
	Yii::t('translation','Tenancies Management')=>array('tenancies'),
	'Calls Log',
);

$menus = array(	
        array('label'=> Yii::t('translation', 'Tenancies Management'), 'url'=>array('tenancies')),
	array('label'=> 'Create Calls Log', 'url'=>array('createCallsLog', 'id'=>$model->transaction_id), 'moreClass'=>'createCallsLog'),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pro-transactions-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#pro-transactions-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('pro-transactions-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('pro-transactions-grid');
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

<h1>Calls Log: <?php echo $titleH1; ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pro-transactions-grid',
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
            'name'=>'date',
            'type'=>'DateTimeTran',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'headerHtmlOptions' => array('class'=>'first','style' => 'text-align:center;'),
        ),
        array(
            'name'=>'received_by',
//            'htmlOptions' => array('style' => 'text-align:center;'),
        ),
        array(
            'name'=>'description',
            'type'=>'html',
            'value'=>'MyFormat::replaceNewLineTextArea($data->description)',
        ),
        array(
            'name'=>'person_call_type',
            'value'=>'isset(ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type])?ProCallLog::$ARR_PERSON_CALL_TYPE[$data->person_call_type]:""',
            'htmlOptions' => array('style' => 'text-align:center;', 'class'=>'w-100')
        ),            
        array(
            'name'=>'person_called',
//            'type'=>'html',
        ),            
        array(
            'name'=>'phone',
//            'type'=>'html',
        ),            
      
	
        array(
                'header' => 'Actions',
                'class'=>'CButtonColumn',
                'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('updateCallsLog','deleteCallsLog')),
                'buttons'=>array(
                    'updateCallsLog'=>array(
                        'label'=>'Update Call Log',
                        'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/update.png',
                        'options'=>array('class'=>'update update_item'),
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/transactions/updateCallsLog",
                            array("id"=>$data->id))',
                    ),
                    'deleteCallsLog'=>array(
                        'label'=>'Update Call Log',
                        'imageUrl'=>Yii::app()->theme->baseUrl . '/img/gridview/delete.png',
                        'options'=>array('class'=>'delete'),
                        'url'=>'Yii::app()->createAbsoluteUrl("admin/transactions/deleteCallsLog",
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

    jQuery(document).on('click','#pro-transactions-grid a.delete',function() {
	if(!confirm('Are you sure you want to delete this item?')) return false;
	var th = this,
		afterDelete = function(){};
	jQuery('#pro-transactions-grid').yiiGridView('update', {
		type: 'POST',
		url: jQuery(this).attr('href'),
		success: function(data) {
			jQuery('#pro-transactions-grid').yiiGridView('update');
			afterDelete(th, true, data);
		},
		error: function(XHR) {
			return afterDelete(th, false, XHR);
		}
	});
	return false;
    });
    
});

function fnUpdateColorbox(){    
    $(".createCallsLog a").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
    $(".update_item").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
    

    
}
</script>