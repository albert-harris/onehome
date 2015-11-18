<?php
$this->breadcrumbs = array(
    'Global Enquiry Management' => array('index'),
    'View global enquiry #' .$model->name,
);

$menus = array(
    array('label' => 'Global Enquiry Management', 'url' => array('index')),
    array('label' => 'Delete Global Enquiry', 'url' => array('delete'), 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
$this->menu = ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View global enquiry #<?php echo $model->name; ?></h1>

<?php
    $PropertyTypeList = ProPropertyType::FormatViewProperyType($model);

    if($model->type_enquiry=='Buy') include_once '_buy.php';
    if($model->type_enquiry=='Sell') include_once '_sell.php';
    if($model->type_enquiry=='Rent') include_once '_rent.php';
?>

<?php 
$aFile = $model->rFile;
?>
<?php if(count($aFile)):?>

    <h1>File Upload</h1>
    <div class="f-left l_padding_140">
    <table class="">
        <?php foreach($aFile as $item):?>
        <tr>
            <td><?php echo ProEnquiryGlobalFile::BindLinkFile($item);?> </td>
        </tr>
        <?php endforeach;?>
    </table>

    </div>
<?php endif;?>

