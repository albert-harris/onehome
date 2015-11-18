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
  	<?php echo $form->errorSummary($model); ?>

  	<div class="row">
  		<?php echo $form->labelEx($model,'pay_to'); ?>
  		<?php echo $form->textField($model,'pay_to'); ?>
  		<?php echo $form->error($model,'pay_to'); ?>
  	</div>
  	<div class="row">
  		<?php echo $form->labelEx($model,'voucher_no'); ?>
  		<?php echo $form->textField($model,'voucher_no'); ?>
  		<?php echo $form->error($model,'voucher_no'); ?>
  	</div>		

  	<div class="row">
  		<?php echo $form->labelEx($model,'created_date'); ?>
  		<?php echo $form->textField($model,'created_date',array('disabled'=>true)); ?>
  		<?php echo $form->error($model,'created_date'); ?>
  	</div>

    
  	
  	<div class="row">
  		<?php echo $form->labelEx($model,'user_billing_address'); ?>
  		<?php echo $form->textField($model,'user_billing_address'); ?>
  		<?php echo $form->error($model,'user_billing_address'); ?>
  	</div>

  	<div class="row">
  		<?php echo $form->labelEx($model,'user_postal_code'); ?>
  		<?php echo $form->textField($model,'user_postal_code'); ?>
  		<?php echo $form->error($model,'user_postal_code'); ?>
  	</div>
  </div>


  <div class="grid-view" >
  <div class="clearfix" style="margin-bottom:5px;">
  	<h3 style="text-align:center;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;padding:5px 0px;" >
  		--Details--
  		<input class="pull-right" type="button" value="Add Row" ng-click="addTodo()"  >
  	</h3>
  </div>
  <form name="tester" id="partner-form-submit" class="form-horizontal" method="POST" action="" role="form" xt-form="form" novalidate>

  <table class="items">
  	<thead>
  		<tr>
  			<th style="width:30px;">#</th>
  			<th >Transaction No</th>
  			<th >Invoi No</th>
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
  				  <input class="form-control-add" ng-model="todo.transacion" type="text" value="" >
  			</td>
  			<td><input class="form-control-add" type="text" value="" ></td>
  			<td><input class="form-control-add form-control-desciption" type="text" value="" ></td>
  			<td><input class="form-control-add" type="text" value="" ></td>
  			<td><input class="form-control-add" type="text" value="" ></td>
  			<td><input class="form-control-add" type="text" value="" ></td>
  			<td><input class="form-control-add" type="text" value="" ></td>
  			<td style="text-align:center;">
            <a ng-click="clearCompleted(vouchers,$index)"  href="javascript:;">
              <img width="16" height="16" src="<?php echo Yii::app()->theme->baseUrl ?>/admin/images/remove.png">
            </a>
        </td>
  		</tr>
  	</tbody>
  </table>
  </form>
  <div class="clearfix" style="margin-bottom:5px;">
  	<h3 style="text-align:center;border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;padding:5px 0px;" >
  		 <input type="submit"  class="btn-3 btn-submit-form" value="Save" />
  	</h3>
  </div>

  </div>
</div>

<?php $this->endWidget(); ?>
<style>
	.form-control-add {width:150px;}
	.form-control-desciption{width:250px;}
</style>
<script> 
    // function update after select from autocomplete
    function InvoiceSelectUser(item, idField){
        $('#FiInvoice_user_billing_address').val(item.address);
        $('#FiInvoice_user_postal_code').val(item.postal_code);
    }
</script>