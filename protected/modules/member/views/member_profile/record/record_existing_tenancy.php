<?php
/**
 * @Author: ANH DUNG Mar 27, 2014
 * @Todo: create new and update transaction
 */
?>
<?php 
    $backText = 'Tenancy';
    $backUrl = Yii::app()->createAbsoluteUrl('member/agent/tenancy');
    
    $cmsFormater = new CmsFormatter();
    $type_for_text = 'Record existing tenancy';
    $defaultTitle = 'Record existing tenancy';
?>
        
<div class="breadcrumb">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">Home</a> &raquo;
    <a href="<?php echo $backUrl;?>"><?php echo $backText;?></a>
    &raquo; <strong><?php echo $defaultTitle;?></strong></div>
    <h1 class="title-page"><?php echo $type_for_text;?></h1>
    
<div class="fix_block_submit display_none">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'transaction-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    )); 
    CHtml::$afterRequiredLabel = ' <span class="required">*</span> :';
    ?>

    <?php include_once '_box_consultant.php'; ?>
    <p class="tenancy_alert_existing">This is only recording existing tenancy. To create new tenancy with transaction, go to Transactions</p>
    <?php include_once '_box_property_detail.php'; ?>
    <?php include_once '_box_rent_detail.php'; ?>
    <?php include_once '_box_upload_property_document.php'; ?>


    <div class="clearfix output">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('member/agent/tenancy');?>" class="btn-2">Cancel</a>
        <input  class="SaveAsDraft" name="SaveAsDraft" value="0" type="hidden" >
        <input type="button" class="btn-3 submit_draft" value="Save as Draft" />
        <input type="submit" class="btn-3 submit_trans" value="Submit" />
    </div>
    <?php $this->endWidget(); ?>
</div>

<style>
.tenancy_alert_existing { margin: 0; font-size: 15px; color: red; font-weight: bold;}
</style>

<script>
    $(function(){
        $('#transaction-form').find('input:submit').click(function(){
            $.blockUI({ message: null });
        });
        
        $('.submit_trans').click(function(){
            $('#transaction-form select').attr('disabled',false);
        });
        
        /* for show and hide bill to radio button */
        $('#ProTransactionsBillTo_bill_to_id li').hide();
        $('.client_type_id').click(function(){
            fnShowHideBillTo($(this).val());
        });
        
        <?php if($mTransactions->client_type_id): ?>
                fnShowHideBillTo(<?php echo $mTransactions->client_type_id;?>);
        <?php endif; ?>
        /* for show and hide bill to radio button */
        
        /* for show and hide with_tenancy date */
        $('.with_tenancy').click(function(){            
            $('.with_tenancy_yes').hide();
            if($(this).val()==1){
                $('.with_tenancy_yes').show();
            }
        });
        <?php if($mTransactions->with_tenancy): ?>
            $('.with_tenancy_yes').show();
        <?php endif;?>
        /* for show and hide with_tenancy date */
        
        /* for bind event show and hide bill_to_id */
        $('.paying_to_external_co_broke').click(function(){
            $('.table_external_co_broke').hide();
            if($(this).val()==1){
                $('.table_external_co_broke').show();
            }
        });
                
    }); // end $(function()
    
    // update order of table
    function fnRefreshOrderRow(){
        $('.tb-1 tbody').each(function(){
            var index = 1;
            $(this).find('tr').each(function(){                
                $(this).find('td:first').text(index++);
            });            
        });
    }
    
    $(window).load(function(){
        fnBindSaveDraft();
        $('.fix_block_submit').show();
        
        $('.in-row').each(function(){
                var label = $(this).find('label:first');
                if(label.find('span').size()<1){
                    label.append(' :');
                }
                if(label.find('span.required').size()>1){
                    label.find('span.required:first').remove();
                    label.find('span.x1:first').remove();
                }
        });
    });
    
    function fnBindSaveDraft(){
        $('.submit_draft').click(function(){
            $('.SaveAsDraft').val(1);
            $(this).closest('form').submit();
        });
    }
    
</script>
            