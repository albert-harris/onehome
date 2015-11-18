<?php
$this->breadcrumbs=array(
	'Members',
);

$menus=array(
//	array('label'=>'Export Current List', 'url'=>array('exportexcel'), 'customLabel'=>'Export Current List'),        
	array('label'=> Yii::t('translation','Create Member'), 'url'=>array('create')),  
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-model-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#users-model-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('users-model-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('users-model-grid');
        }
    });
    return false;
});
");

?>

<h1>Members</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-model-grid',
	'dataProvider'=>$model->search(),
        'enableSorting' => false,
        'afterAjaxUpdate'=>'function(id, data){ fixTargetBlank();}',
//	'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'header' => 'Name',
            'type'=>'raw',
            'value'=>'$data->first_name." ".$data->last_name',
        ),        
        'affiliate_code',
            'coins_balance',
        'commission_amount',
        
        array(
                    'header' => 'View Join Member Packages',
                    'type' => 'raw',
                    'value'=> 'CHtml::link(
                                CHtml::image(Yii::app()->theme->baseUrl."/admin/images/icon/package.png","View Visitors",array("title"=>"View Join Member Packages")),
                                Yii::app()->createAbsoluteUrl("admin/packagesRegisterUser/index",array("user_id"=>$data->id))
                              ) ',
                    'headerHtmlOptions' => array('width' => '80px','style' => 'text-align:center;'),
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),        
        
        array(
                    'header' => 'View Vistors',
                    'type' => 'raw',
                    'value'=> 'CHtml::link(
                                CHtml::image(Yii::app()->theme->baseUrl."/admin/images/user-icon.png","View Visitors",array("title"=>"View Vistor")),
                                Yii::app()->createAbsoluteUrl("admin/transactionsCommission/index",array("user_id"=>$data->id))
                              ) ',
                    'headerHtmlOptions' => array('width' => '80px','style' => 'text-align:center;'),
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),        
        'email',
        'gender',
        array(
            'name' => 'hand_phone',
            'htmlOptions' => array('style' => 'text-align:right;')
        ),    
            array(
            'header' => 'Mailing Address',
            'name' => 'mailing_address1',
            'type'=>'html',
            'value'=>'$data->mailing_address1',
        ),  
            array(
            'header' => 'Shipping Address',
            'name' => 'shipping_address1',
            'type'=>'html',
            'value'=>'$data->shipping_address1',
        ),  
        array(
            'name' => 'created_date',
            'type'=>'date',
//            'value'=> '($data->created_date!= "0000-00-00 00:00:00") ? DateHelper::toDateFormat($data->created_date) : ""',
            'htmlOptions' => array('style' => 'text-align:center;')
        ),    
            
         array(
            'name'=>'status',
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("status"=>$data->status,"id"=>$data->id)',
			'filter' => array('1'=>'Yes','0' => 'No')
        ),
         array(
            'name'=>'payment_status',
            'type'=>'paymentStatus',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("status"=>$data->payment_status,"id"=>$data->id, "allowOneTime"=>1)',
			'filter' => array('1'=>'Yes','0' => 'No')
        ),
        'payment_type',
        array(
            'header'=>'Actions',
                'class'=>'CButtonColumn',
                'template' => '{update} {delete}',
        ),
	),
)); ?>
