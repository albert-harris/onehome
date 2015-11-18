<?php
$this->breadcrumbs = array(
    'Newsletter Management' => array('index'),
    $model->subject,
);

$menus = array(
    array('label' => 'Newsletter Management', 'url' => array('index')),
    array('label' => 'Create Newsletter', 'url' => array('create')),
    array('label' => 'Update Newsletter', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Newsletter', 'url' => 'delete', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Newsletter [<?php echo $model->subject; ?>]</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
//		'id',
        'subject',
        'created_time:datetime',
        'send_time:datetime',
        'content:html',
        'total_subscriber',
        'total_sent',
//        array(
//            'name' => 'total_read',
//            'value' => count($model->newsletter_tracking),
//        ),
        array(
            'name' => 'Send',
            'value' => ($model->countRemain() == 0) ? 'Yes' : 'No',
        ),
          array(
                    'name'=>'dedicate_list',
                    'type'=>'html',
                    'value'=>Newsletter::getDedicateByStr($model->dedicate_list),
                ),
    ),
));
?>
