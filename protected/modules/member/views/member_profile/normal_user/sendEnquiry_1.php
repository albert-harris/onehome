<h1 class="title-page">Enquiry Multiple Listing</h1>
<div class="intro clearfix">
    <?php
    if(!empty($listing)){
        ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'choiceListing',
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>


        <input type="hidden" value="" id="listEnquiry" name="listEnquiry">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'id'=>'short_list',
            'dataProvider' => $listing,
            'ajaxUpdate'=>false,
            'itemView'=>'normal_user/itemChoiceEnquiry',
            'itemsCssClass' => false,
            'enablePagination'=>true,
            'template'=>'{items}',
            'pagerCssClass' => 'pagination',
            'pager'=>array(
                'cssFile' => false,
                'header'=>false,
                'firstPageCssClass'=>'hidden',
                'lastPageCssClass'=>'hidden',
            )
        ));
    }
    ?>
    <div class="clear"></div>

    <div class="form-type">
        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'name',array('label'=>'Name :','class'=>'lb-1')); ?>
            <div class="group-3">
                <?php echo $form->textField($model,'name', array('class' => 'text')); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'email',array('label'=>'Email :','class'=>'lb-1')); ?>
            <div class="group-3">
                <?php echo $form->textField($model,'email', array('class' => 'text')); ?>
                <?php echo $form->error($model,'email'); ?>
            </div>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'phone',array('label'=>'Phone :','class'=>'lb-1')); ?>
            <div class="group-3">
                <?php echo $form->textField($model,'phone', array('class' => 'text')); ?>
                <?php echo $form->error($model,'phone'); ?>
            </div>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'country_id',array('label'=>'Country :','class'=>'lb-1')); ?>
            <div class="group-3">
                <?php echo $form->dropDownList($model,'country_id', AreaCode::loadArrArea(), array('empty'=>'Select Country'));?>
                <?php echo $form->error($model,'country_id'); ?>
            </div>
        </div>

        <div class="in-row clearfix">
            <?php echo $form->labelEx($model,'description',array('label'=>'Description :','class'=>'lb-1')); ?>
            <div class="group-3">
                <?php echo $form->textArea($model,'description', array('rows' => 4,'class'=>'text'));?>
                <?php echo $form->error($model,'description'); ?>
            </div>
        </div>

        <div class="in-row clearfix">
            <input type="button" value="Submit" class="btn-3 btEnquiry" />
        </div>
    </div>


    <?php $this->endWidget(); ?>

</div>

<style>
    .intro .col-3 {
        width:484px !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btEnquiry').click(function() {
            var atLeastOneIsChecked = $('input[name=\"chkList[]\"]:checked').length > 0;
            if (!atLeastOneIsChecked)
            {
                alert('Please select at least one property to send Enquiry');
                return false;
            }else{
                $('#choiceListing').submit();
            }
        });
    });
</script>