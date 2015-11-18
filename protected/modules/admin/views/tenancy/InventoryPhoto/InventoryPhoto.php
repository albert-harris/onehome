<?php
$this->breadcrumbs=array(
	Yii::t('translation','Tenancies Management')=>array('tenancy/index'),
	'Inventory Photo',
);

$menus = array(	
//        array('label'=> Yii::t('translation', 'Tenancies Management'), 'url'=>array('tenancies')),	
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$this->menu [] = array('label'=> Yii::t('translation', 'Tenancies Management'), 'url'=>array('tenancy/index'));

$mTrans = $model->rTransactions;
$cmsFormater = new CmsFormatter(); 
$arrVal = array("name"=>$mTrans->listing->property_name_or_address, "transaction_id"=>$mTrans->id);
$sPropertyName = $cmsFormater->formatpropertyname($arrVal);
$tenancy_agreement_date = $cmsFormater->formatLongDate($mTrans->tenancy_agreement_date);
$expiring_date = $cmsFormater->formatLongDate($mTrans->expiring_date);
$titleH1 = $sPropertyName." [ $tenancy_agreement_date - $expiring_date ] ";
?>
<h1>Inventory Photo: <?php echo $titleH1; ?></h1>

<?php include 'InventoryPhotoList.php';?>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/verz_custom_be.css" />
<script>
$(document).ready(function() {
    fnUpdateColorbox();
});

function fnUpdateColorbox(){    
//    $(".createCallsLog a").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
//    $(".update_item").colorbox({iframe:true,innerHeight:'535', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
//    $(".UpdateDefectStatus").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});    
//    jQuery('a.gallery').colorbox();
}
</script>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>
<script type="text/javascript">
    // Jul 25, 2014 ANH DUNG 
    $(function(){
        fnBindRemoveGlobalFile();
        fnBindFancyPhoto();
        $('.file_name').change(function(){
            parent_div = $(this).closest('div.box_inventory_photo');
            parent_form = $(this).closest('form');
            var url_ = '<?php echo Yii::app()->createAbsoluteUrl('enquiry/ajaxUploadFileAll', array('admin'=>1, 'uid'=>Yii::app()->user->id))?>';
            parent_form.ajaxSubmit({
                dataType: 'json',
                type: 'post',
                data: {},
                url: url_,
                beforeSend:function(data){
                    $.blockUI({
                           message: '', 
                           overlayCSS:  { backgroundColor: '#fff' }
                   });
                },
                success: function(data)
                {
                    if(data['code']){
                        $('.inventory_photo_show').find('ul').append(data['li']);
                        parent_div.find('input:file').val('');
                    }else{
                        alert(data['message']);
                    }
                    fnBindFancyPhoto();
                    $.unblockUI();
                }
            });// end $('#submit-form').ajaxSubmit({
            
        });// end $('.file_name').change(function(){
        
    });// end $(function()
    
    function fnBindRemoveGlobalFile(){
        $('.remove_file_js').live('click', function(){
            if(confirm('Are you sure delete this item?')){
                $(this).closest('li').remove();
                var url_ = $(this).attr('next');
                $.ajax({
                    url:url_
                });
            }
        });
    }
    
    function fnBindFancyPhoto(){
        $(".FancyPhoto").colorbox();
        return;
        $('.FancyPhoto').fancybox({
//            fitToView:true,
            width: 600,
            autoSize:false,autoHeight:true,scrolling : false,
            title:"",
            helpers: { overlay : {
                    closeClick : true,  // if true, fancyBox will be closed when user clicks on the overlay
                }
            }
        });
    }
    
</script>