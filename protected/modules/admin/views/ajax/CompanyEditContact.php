<h2>Edit Contact Number</h2>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'pro-defect-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>
    <div class="row grid-view">
        <table class="items">
            <thead>
                <tr>
                    <td class="item_b">Property Address</td>
                    <td class="item_b">Contact No</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($aModelListing as $item):?>
                <tr>
                    <td class="w-250"><?php echo $item->property_name_or_address;?></td>
                    <td>
                        <?php echo $form->textField($model,'contact_name_no[]', array('class'=>'w-150 contact_name_no', 'value'=>$item->contact_name_no, 'maxlength'=>20)); ?>
                        <?php echo $form->hiddenField($model,'id[]', array('value'=>$item->id)); ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>            
        </table>
    </div>

    <div class="row buttons" style="padding-left: 275px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=> 'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	
        <!--<button class="iframe_close" type="button">Cancel</button>-->
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<style>
    .contact_name_no { margin: 0 !important;}
</style>

<script>
    $(function(){
        $('.iframe_close').live('click', function(){
            parent.$.colorbox.close();
        });
    });
    
//     $(document).ready(function(){
//        $(".show-image").fancybox();
//     });
</script>

<style>
    .btn-small{
        margin-left: 6px;
    }
    
    .img{
        width: 140px;
        height: 120px;
    }
</style>