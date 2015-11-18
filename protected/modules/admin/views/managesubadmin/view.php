<?php
$this->breadcrumbs=array(
	'Sub Admin'=>array('index'),
    $model->first_name . " " . $model->last_name,
);
if ($model->id != Yii::app()->user->id)
{
    $menus=array(
        array('label'=>'Manage Sub Admin', 'url'=>array('index')),
        array('label'=>'Create Sub Admin', 'url'=>array('create')),
        array('label'=>'Update Sub Admin', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Delete Sub Admin', 'url'=>array('delete'), 
            'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
                        'confirm'=>'Are you sure you want to delete this item?')),
            'visible' => $model->id != Yii::app()->user->id?true:false,
    );
}
else {
    $menus=array(
        array('label'=>'Sub Admin', 'url'=>array('index')),
        array('label'=>'Create Sub Admin', 'url'=>array('create')),
        array('label'=>'Update Sub Admin', 'url'=>array('update', 'id'=>$model->id)),
        
    );
}
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Sub Admin: [<?php echo $model->first_name . " " . $model->last_name; ?>]</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'username',
            'email',
            array(
                'name' => 'role_id',
                'value'=>  $model->rRole?$model->rRole->role_name:"",
            ),            
            array(
                'name' => 'Full Name',
                'type'=>'raw',
                'value'=>$model->first_name . " " . $model->last_name
            ),
            'phone',
            array(
                'name' => 'gender',
                'value'=> Users::$gender[$model->gender],
            ),
            array(
                'name' => 'created_date',
                'type'=> 'datetime',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'name' => 'last_logged_in',
                'type'=> 'datetime',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            'status:status',
	),
)); ?>
