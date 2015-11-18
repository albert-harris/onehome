<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<?php
/**
 * User: Kvan
 * Date: 4/23/14
 * Time: 10:23 AM
 * To change this template use File | Settings | File Templates.
 */

$this->breadcrumbs=array(
//	'Dashboard'=>array('member/listing/index'),
    'ALL ENQUIRIES',
);
 ?>
<h3 style="font-size:1.17em;"><b>ALL ENQUIRIES</b></h3>
<?php 
foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
    ?>
<div class="clear"></div>


<div id="basic-modal">
    <?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'enquiry-grid-view',
    'dataProvider'=>$enquiries,
    //'filter'=>$model,
    'enableSorting' => true,
    'summaryText' => "Showing items {start} to {end} of {count}",
    'htmlOptions'=>array(
        'class'=>'tb-1',
    ),
    'template'=>'{items}
                        <div class="action-group clearfix">
                           <div class="pager f-right">{pager}</div>
                           <div class="lb f-right">{summary}</div>
                     </div>
          ',
    'pager' => array(
        'header' => '',
        'cssFile' => false,
        'prevPageLabel' => 'Previous',
        'nextPageLabel' => 'Next',
        'lastPageLabel'  => '',
        'firstPageLabel'  => '',
        'htmlOptions'=>array(
            'class'=>'listing_manager'
        )
    ),
    'columns'=>array(
        array(
            'header' => 'No',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('class'=>'first','width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        
    
        array(
            'header' => 'Status',
            'type' => 'html',
            'htmlOptions' => array('style' => 'text-align:center; width:70px;'),
            'value'=> '($data->status == ENQUIRY_PROPERTY_NEW) ?
                CHtml::image(Yii::app()->theme->baseUrl."/img/mail_light_new_2.png", "New Email"):
                (
                    ($data->status == ENQUIRY_PROPERTY_READ) ?
                    CHtml::image(Yii::app()->theme->baseUrl."/img/email.png", "Email") :
                    CHtml::image(Yii::app()->theme->baseUrl."/img/mail_reply_sender.png", "Replied Email")
                );'
        ),
        array(
            'name'=>'name',
            'header'=>'Property Name',
            'headerHtmlOptions'=>array('style'=>'width:200px;'),
            'value'=>'isset($data->listing->property_name_or_address) ? $data->listing->property_name_or_address :""'
        ),           
//        array(
//            'header'=>'From',
//            'name'=>'email',
//            'type'=>'raw',
//            'headerHtmlOptions'=>array('style'=>'width:200px;'),
//        ),
        array(
            'name'=>'name',
            'headerHtmlOptions'=>array('style'=>'width:200px;'),
        ),
//        array(
//            'name'=>'property_id',
//            'header'=>'Subject',
//            'value'=>'$data->listing->property_name_or_address." Enquiry"',
//            'headerHtmlOptions'=>array('style'=>'width:370px;'),
//        ),
   
          array(
            'header'=>'Address',
            'name'=>'email',
            'type'=>'raw',
            'headerHtmlOptions'=>array('style'=>'width:200px;'),
        ),      
        
        
        
        array(
            'name'=>'created_date',
//            'header'=>'Received',
            'header'=>'Date',
            'type'=>'datetime',
            'htmlOptions'=>array('style'=>'width: 200px;text-align:left;'),
        ),

        array(
            'class'=>'ButtonColumn',
            'header'=>'Actions',
            'evaluateID'=>true,
            'template'=> '{view}{delete}{reply}',
            'headerHtmlOptions'=>array('class'=>'last','style'=>'width:100px;'),
            'buttons'=>array(
                'reply'   =>  array(
                    'label'=>'Reply',
                    'imageUrl'=>Yii::app()->theme->getBaseUrl().'/img/reply.png',
                    //'url'=>'Yii::app()->createAbsoluteUrl("admin/epdbilling/print_pdf", array("id"=>$data->id))',
                    'options'=>array('class'=>'btn_reply','id'=>'$data->id','data-email'=>'$data->email','data-subject'=>'"RE: ".$data->listing->property_name_or_address." Enquiry"')
                ),
            ),
        ),
    ),
)); ?>

    <!-- model content -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">&times;</a>
                    <h3>Reply Email</h3>
                </div>
                <div class="modal-body">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                    'action'=>Yii::app()->createAbsoluteUrl('member/enquiries/reply'),
                    'method'=>'post',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => false,
//                    'clientOptions' => array(
//                        'validateOnSubmit' => true,
//                    ),
                )); ?>
                    <?php echo $form->hiddenField($enquiryReply,'enquiry_property_id',array('value'=>'','id'=>'enquiry_id')); ?>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($enquiryReply, 'subject'); ?>
                        <?php echo $form->textField($enquiryReply,'subject',array('class'=>'text','placeholder'=>'Name','value'=>'','id'=>'enquiry_subject')); ?>
                        <?php echo $form->error($enquiryReply,'subject'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($enquiryReply, 'email_to'); ?>
                        <?php echo $form->textField($enquiryReply,'email_to',array('class'=>'text','placeholder'=>'To','value'=>'','id'=>'enquiry_to')); ?>
                        <?php echo $form->error($enquiryReply,'email_to'); ?>
                    </div>
                    <div class="in-row clearfix">
                        <?php echo $form->labelEx($enquiryReply, 'message'); ?>
                        <?php echo $form->textArea($enquiryReply,'message',array('class'=>'text','rows'=>'7')); ?>
                        <?php echo $form->error($enquiryReply,'message'); ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="submit" type="submit">Send</button>
                </div>
            </div>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn_reply').click(function() {
            var email_to = $(this).attr('data-email');
            var email_subject = $(this).attr('data-subject');
            var enquiry_id = $(this).attr('id');
            $('#enquiry_id').val(enquiry_id);
            $('#enquiry_subject').val(email_subject);
            $('#enquiry_to').val(email_to);
            $('#myModal').modal('show');
        });
    });
</script>