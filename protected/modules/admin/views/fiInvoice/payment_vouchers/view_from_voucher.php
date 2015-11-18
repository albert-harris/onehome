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

  <div class="grid-view" >
  <div class="clearfix" style="margin-bottom:5px;">
  	<h3 style="text-align:center;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;padding:5px 0px;" >
  		--Details--
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
      		</tr>		
    	</thead>
    	<tbody>
      		<tr ng-repeat="todo in  vouchers">
        			<td>{{$index + 1}}</td>
        			<td>
                  <input disabled="disabled" readonly="readonly"  class="form-validate form-control-add search" name="FiPaymentVoucherDetail[{{$index + 1}}][transacion]" type="text" value="" placeholder="Auto Search" ng-model="todo.transacion" >
                  <input class="invoice_id_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][invoice_id]" type="hidden" value="" ng-model="todo.invoice_id" >
        			</td>
        			<td><input disabled="disabled"  class="form-validate form-control-add invoice_name_{{$index + 1}}" type="text" name="FiPaymentVoucherDetail[{{$index + 1}}][invoice_no]" value="" ng-model="todo.invoice_no" readonly="readonly" ></td>
        			<td><input disabled="disabled"  class="form-validate form-control-add form-control-desciption" ng-model="todo.description" name="FiPaymentVoucherDetail[{{$index + 1}}][description]"  type="text" value="" ></td>
        			<td>
                   <?php echo CHtml::dropDownList('FiPaymentVoucherDetail[{{$index + 1}}][client_type]',"todo.client_type",Listing::getDropdownlistWithTableName('ProMasterClientType','id','name'),array('class'=>'form-validate form-control-add clinet-type-custom','ng-model'=>'todo.client_type','disabled'=>true));?>
              </td>
              <td><input disabled="disabled" class="form-validate form-control-add change-item comm comm_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][comm]" ng-model="todo.comm" type="text" value="" ></td>
              <td><input disabled="disabled" class="form-validate form-control-add change-item gross gross_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][gross_commission]" ng-model="todo.gross_commission"  type="text" value="" ></td>
              <td><input disabled="disabled" class="form-validate form-control-add amount amount_{{$index + 1}}" name="FiPaymentVoucherDetail[{{$index + 1}}][amount]" ng-model="todo.amount" type="text" value="" readonly="readonly" ></td>
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