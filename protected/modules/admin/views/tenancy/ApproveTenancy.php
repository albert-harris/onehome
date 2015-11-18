<?php
?>
<h2>Update Status Tenancy</h2>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pro-transactions-form',
	'enableAjaxValidation'=>false,
)); ?>
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->dropDownList($model,'status', ProTransactions::$LIST_STATUS_TENANCY_TEXT, array('class'=>'w-400')); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>     
	<div class="row buttons" style="padding-left: 115px;">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	
            <button class="iframe_close" type="button">Cancel</button>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    $(function(){
        $('.iframe_close').live('click', function(){
            parent.$.colorbox.close();
        });
    });
    $(window).load(function(){ // không dùng dc cho popup
//        $('.materials_table').floatThead();
//        fnResizeColorbox();
    });    
    function fnResizeColorbox(){
//        var y = $('body').height()+100;
        var y = $('#main_box').height()+100;
        parent.$.colorbox.resize({innerHeight:y});        
    }    
</script>