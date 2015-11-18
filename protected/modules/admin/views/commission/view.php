<?php
$this->breadcrumbs=array(
	'Commission scheme'=>array('index'),
	'View',
);

$menus=array(
	array('label'=>'Management', 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Commission</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes'=>array(                
            array(
                'name' => 'User name',
                'value' => $model->user->username,
            ), 
            array(
                'name' => 'Name',
                'value' => $model->user->first_name." ".$model->user->last_name
            ),
            array(
                'name' => 'Transaction Number',
                'value' => $model->transaction->transactions_no
            ),  
            'commission_amount',
            array(
                'name' => 'status',
                'value' => (!empty($model->status) && $model->status==1) ? 'Paid' : 'Unpaid',
            ),
            array(
                'name' => 'created_date',
                'value' => $model->transaction->created_date,
                'type' => 'date'
            ),
	),
)); ?>
