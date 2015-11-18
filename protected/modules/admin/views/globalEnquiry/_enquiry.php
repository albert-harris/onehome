<?php
/* @var $model ProGlobalEnquiry */
$PropertyTypeList = ProPropertyType::FormatViewProperyType($model);

if($model->type_enquiry=='Buy') include_once '_buy.php';
if($model->type_enquiry=='Sell') include_once '_sell.php';
if($model->type_enquiry=='Rent') include_once '_rent.php';
?>

<?php 
$aFile = $model->rFile;
?>
<?php if(count($aFile)):?>
    <h3>File Upload</h3>
    <table class="">
        <?php foreach($aFile as $item):?>
        <tr>
            <td><?php echo ProEnquiryGlobalFile::BindLinkFile($item);?> </td>
        </tr>
        <?php endforeach;?>
    </table>
<?php endif;?>
