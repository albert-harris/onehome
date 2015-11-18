<?php

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 2500).fadeOut("slow");',
   CClientScript::POS_READY
);
?>

<?php if(Yii::app()->user->hasFlash('successUpdate')):?>
    <div class="info" style="widows:600px;height:50px; color:#FF0000;font-weight:bold;text-align:center; font-size:24px;margin-top:30px;">
        <?php echo Yii::app()->user->getFlash('successUpdate'); ?>
    </div>
<?php endif; ?>

<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
        $model->username,
);
if ($model->id != Yii::app()->user->id)
{
    $this->menu=array(
        array('label'=>'List Users', 'url'=>array('index')),
    //	array('label'=>'View Users', 'url'=>'view', 'active'=>true),
        array('label'=>'Create Member', 'url'=>array('create')),
        array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Delete Member', 
            'url'=>array('delete'), 
            'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
                            'confirm'=>'Are you sure you want to delete this item?')),

    );
}
else {
     $this->menu=array(
        array('label'=>'List Users', 'url'=>array('index')),
    //	array('label'=>'View Users', 'url'=>'view', 'active'=>true),
        array('label'=>'Create Member', 'url'=>array('create')),
        array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->id)),
        );
}

$address = '';
$address .='<p>'.nl2br($model->address).'</p>';
?> 

<h1>View User: <?php echo $model->username; ?></h1>

<?php 
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//            'username',
            array(
                'label'=>'Full Name',
                'value'=>$model->client_salutation.' '.$model->username,
            ),
		
		'email',
        'phone',
        array(
            'name' => 'created_date',
            'value'=> ($model->created_date!= "0000-00-00 00:00:00") ? DateHelper::toDateFormat($model->created_date) : "",
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name' => 'Country',
            'value'=> ($model->area_code_id!= "") ? $model->area_code->area_name : "",
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name' => 'Address',
            'value' => $address,    
            'type'=>'raw',
        ),            
            'client_type',
            'client_designation',
            'company_name',
            'client_department',
            'client_mobile',
            'status:status',
	),	
)); ?>
