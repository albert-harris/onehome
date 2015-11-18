<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//run_prettify.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//angular.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//xtForm.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl ?>/admin/partner//todo.js"></script>

<div  ng-app="NgValidationTestApp" ng-controller="TodoCtrl">
  <?php $form=$this->beginWidget('CActiveForm', array(
  	'id'=>'actions-roles-form',
  	'enableAjaxValidation'=>false,
  )); ?>
  <div class="form form-type">
  	<p class="note">Fields with <span class="required">*</span> are required.</p>
  	<?php //echo $form->errorSummary($model); ?>

    <div class="row">
      <?php echo Yii::t('translation', $form->labelEx($model,'pay_to')); ?>
      <?php echo $form->dropDownList($model,'pay_to',FiPaymentVoucher::$STATUS_PAY_TO, array('style'=>'width:360px;', 'empty'=>'Select')); ?>
      <?php echo $form->error($model,'pay_to'); ?>
    </div>

    <?php if(!$model->isNewRecord): ?>
  	<div class="row">
  		<?php echo $form->labelEx($model,'voucher_no'); ?>
  		<?php echo $form->textField($model,'voucher_no',array('class'=>'w-350','readonly'=>true)); ?>
  		<?php echo $form->error($model,'voucher_no'); ?>
  	</div>	

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
         <?php echo $form->dropDownList($model,'status', CmsFormatter::$statusPaymentVoucher,array('style'=>'width:360px;')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
      <?php echo $form->labelEx($model,'date_paid'); ?>
      <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,        
                'attribute'=>'date_paid',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=> ActiveRecord::getDateFormatJquery(),
//                        'maxDate'=> '0',
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showOn' => 'button',
                    'buttonImage'=> Yii::app()->theme->baseUrl.'/img/calendar-ico.png',
                    'buttonImageOnly'=> true,                                
                ),        
                'htmlOptions'=>array(
                    'class'=>'',
                    'style'=>'width: 200px;margin-right:10px;',
                    'readonly'=>'readonly',
                ),
            ));
        ?>
      <?php echo $form->error($model,'date_paid'); ?>
    </div>

  <?php endif; ?>


  <div class="row">
      <?php echo Yii::t('translation', $form->labelEx($model,'user_name')); ?>
      <div class="f-left">
      <?php
          // ANH DUNG Sep 11, 2014 widget auto complete search user customer and supplier
          $url = Yii::app()->createAbsoluteUrl('ajax/search_user_financial');
          $aData = array(
              'model'=>$model,
              'name_relation_user'=>'rUser', // relation of field
              'field_customer_id'=>'user_id',// hidden field need update 
              'field_autocomplete_name'=>'user_name',
              'placeHolder'=>'Type name to search',
              'divClosest'=>'unique_wrap_autocomplete',                        
              'CallFunctionLandLord'=>"InvoiceSelectUser",// name function define
              'NotShowTableInfo'=>1,
              'CustomClass'=>"w-350",
//              'ShowNoDataFound'=> 0,
              'url'=> $url,
          );
            $this->widget('ext.ProAutocompleteUser.ProAutocompleteUser',  array('data'=>$aData));

      ?>
      </div>
      <div class="clearfix"></div>
      <?php echo $form->hiddenField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
      <?php echo $form->error($model,'user_name'); ?>
    </div>

    <div class="row">
        <?php echo Yii::t('translation', $form->labelEx($model,'nric')); ?>
        <?php echo $form->textField($model,'nric',array("class"=>"w-350",'maxlength'=>300)); ?>
        <?php echo $form->error($model,'nric'); ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'user_billing_address'); ?>
            <?php echo $form->textField($model,'user_billing_address',array('class'=>'w-350')); ?>
            <?php echo $form->error($model,'user_billing_address'); ?>
    </div>

    <div class="row">
            <?php echo $form->labelEx($model,'user_postal_code'); ?>
            <?php echo $form->textField($model,'user_postal_code',array('class'=>'w-350')); ?>
            <?php echo $form->error($model,'user_postal_code'); ?>
    </div>

    <!--anh dung Oct 24, 2014--> 
    <div class="row listing_type_radio_list">
        <?php echo $form->labelEx($model,'payment_mode'); ?>
        <?php
            echo $form->radioButtonList($model, 'payment_mode', FiPaymentVoucher::$ARR_PAYMENT_MODE, array(
                'separator' => '',
                'class' => 'listing_type_rd',
            ));
        ?>
        <div class="clr"></div>
        <?php echo $form->error($model,'payment_mode'); ?>
    </div>
    
    

    <div class="row cheque_number_1 cheque_number_div <?php echo $model->payment_mode==FiPaymentVoucher::PAYMENT_MODE_CHEQUE?"":'display_none'; ?>">
        <?php echo $form->labelEx($model,'cheque_number'); ?>
        <?php echo $form->textField($model,'cheque_number',array('class'=>'w-350')); ?>
        <?php echo $form->error($model,'cheque_number'); ?>
    </div>

        <!--anh dung Oct 24, 2014--> 
  
    <div class="row">
        <?php echo $form->labelEx($model,'bank_reference_no'); ?>
        <?php echo $form->textField($model,'bank_reference_no',array('class'=>'w-350')); ?>
        <?php echo $form->error($model,'bank_reference_no'); ?>
    </div>
</div>

  <input type="hidden" id="commission_schema_id"  />

  <div class="grid-view" >
  <div class="clearfix" style="margin-bottom:5px;">
  	<h3 style="text-align:center;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;padding:5px 0px;" >
  		--Details--
  		<input class="pull-right" type="button" value="Add Row" ng-click="addTodo()"  >
  	</h3>
  </div>
  <form name="tester" id="partner-form-submit" class="form-horizontal" method="POST" action="" role="form" xt-form="form" novalidate>

  <table class="items item-payment">
    	<thead>
            <tr>
                <th style="width:30px;">#</th>
                <th >Transaction No</th>
                <th >Invoice No</th>
                <th >Description</th>
                <th >Client Type</th>
                <th >COMM.%</th>
                <th >Gross commission</th>
                <th >Amount SG$</th>
                <th style="width:50px;text-align:center;">&nbsp;</th>
            </tr>
    	</thead>
    	<tbody>
            <tr ng-repeat="todo in  vouchers">
                <td>{{$index + 1}}</td>
                <td>
                    <input auto-complete item="{{$index + 1}}" class="form-validate form-control-add search" name="FiPaymentVoucherDetail[{{$index + 1}}][transacion]" type="text" value="" placeholder="Auto Search" ng-model="todo.transacion" >
                    <input item="{{$index + 1}}" class="invoice_id_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][invoice_id]" type="text" style="display:none;" ng-model="todo.invoice_id" >
                </td>
                <td><input class="form-validate form-control-add invoice_name_{{$index + 1}}" type="text" name="FiPaymentVoucherDetail[{{$index + 1}}][invoice_no]" value="" ng-model="todo.invoice_no" readonly="readonly" ></td>
                <td><input class="form-validate form-control-add form-control-desciption desciption_{{$index + 1}}" ng-model="todo.description" name="FiPaymentVoucherDetail[{{$index + 1}}][description]"  type="text" value="" ></td>
                <td>
                   <?php echo CHtml::dropDownList('FiPaymentVoucherDetail[{{$index + 1}}][client_type]',"todo.client_type",Listing::getDropdownlistWithTableName('ProMasterClientType','id','name'),array('class'=>'form-validate form-control-add client-type-custom','ng-model'=>'todo.client_type'));?>
              </td>
                <td><input class="form-validate form-control-add change-item comm comm_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][comm]" ng-model="todo.comm" type="text" value="" ></td>
                <td><input class="form-validate form-control-add change-item gross gross_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][gross_commission]" ng-model="todo.gross_commission"  type="text" value="" ></td>
                <td><input class="form-validate form-control-add amount amount_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][amount]" ng-model="todo.amount" type="text" value="" readonly="readonly" ></td>
                <td style="text-align:center;">
                  <a ng-click="clearCompleted(vouchers,$index)"  class="remove-item" href="javascript:;">
                    <img width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl ?>/admin/images/remove.png">
                  </a>
                </td>
            </tr>
          <tr>
              <tr>
                  <td colspan="7">
                    <div class="pull-right">Total Amount </div>
                  </td>
                  <td>
                      <input type="hidden" id="gst" value="<?php echo Yii::app()->params['gst'] ?>"/>
                      <?php echo $form->textField($model,'total_amount',array('class'=>'form-control-add allTotalAmount','readonly'=>true,'value'=>'{{getAllAmount()}}')) ?>
                      <?php echo $form->hiddenField($model,'total_amount',array('class'=>'form-control-add allTotalAmount_hidden')) ?>
                  </td>
              </tr>
          </tr>
    	</tbody>

  </table>

  <input type="hidden" name="ajaxlink" id="ajaxlink" value="<?php echo Yii::app()->createAbsoluteUrl('ajax/searchtransactionvoucher',array('q'=>"")); ?>" >
  </form>
  <div class="clearfix" style="margin-top:5px;;margin-bottom:5px;">
  	  <h3 style="text-align:center;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;padding:20px 0px;" >
          <input type="button" style="margin-top:-14px;margin-left:10px;" class="btn-3 btn-submit-form-validate pull-right" value="Save" />
<!--   		    <input type="button" style="margin-top:-14px;" class="btn-3 btn-submit-form-validate pull-right" value="Cancel" /> -->
  	  </h3>
  </div>

  </div>

  <?php if( isset($dataTmp) && $dataTmp !=''): ?>
  <div ng-init="vouchers = [<?php echo htmlspecialchars($dataTmp); ?>]; "></div>
  <?php endif; ?> 

</div>

<?php $this->endWidget(); ?>
<style>
	.form-control-add {width:150px;}
  .errorCustom {border: solid 1px red !important;}
  .errorMessage {margin-left:120px;}
	.form-control-desciption{width:250px;}
  .ui-autocomplete-loading { background:url('<?php echo Yii::app()->theme->baseUrl; ?>/img/loading_v1.gif') no-repeat right center; }
</style>
<script> 
    // function update after select from autocomplete
    function InvoiceSelectUser(item, idField){
        $('#FiPaymentVoucher_user_billing_address').val(item.address);
        $('#FiPaymentVoucher_user_postal_code').val(item.postal_code);
        $('#FiPaymentVoucher_nric').val(item.nric_passportno_roc);
        $('#commission_schema_id').val(item.commission_schema_id);
        $('.search').attr('disabled',false);

    }

    $('.clinet-type-custom').trigger('click',function(){
         alert($(this).val());
    });

    $('.btn-submit-form-validate').click(function(){
        var isvalidate =true;
        $('.form-validate').each(function(){
           if($(this).val()==''){
              $(this).addClass('errorCustom');
           }else{
              $(this).removeClass('errorCustom');
           }
        })
        $('.form-validate').each(function(){
           if($(this).val()==''){
              isvalidate=false;
              return;
            }
        })
        if(isvalidate){
            $('#actions-roles-form').submit();
        }
    });
    
    // ANH DUNG OCT 24, 2014
    $(function(){
       bindRadioPaymentMode();
    });
    
    function bindRadioPaymentMode(){
        $('.listing_type_rd').click(function(){
           if($(this).val()==2){
               $('.cheque_number_div').show();
           }else{
               $('.cheque_number_div').hide();
               $('.cheque_number_div input').val('');
           }
       });
    }
    // ANH DUNG OCT 24, 2014

</script>