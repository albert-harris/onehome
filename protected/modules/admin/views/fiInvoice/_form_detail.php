<?php // include '_form_detail_test_app.php';?>
<div class="row grid-view">
    <label>&nbsp;</label>
    <table class="materials_table items ">
        <thead>
            <tr>
                <td colspan="3" class="item_c item_b">Details</td>
<!--                <td class="item_c item_b">
                    <input type="button" value="Add row" class="btn btn-small AddRowBtn">
                    <button type="button"class="btn btn-small">Add row</button>
                </td>-->
            </tr>
            <tr>
                <th class="w-20 item_c">#</th>
                <th class="w-500 item_c">Description</th>                        
                <th class="w-200 item_c">Amount SG $</th>                        
                <!--<th class="last item_c">Remove</th>-->
            </tr>
        </thead>
        <tbody>
            <?php // if(0):?>
            <?php if(is_array($model->aModelDetail) && count($model->aModelDetail)):                 
                $total_amount_due = 0;
            ?>
            <?php foreach($model->aModelDetail as $key=>$mDetail):?>
            <tr class="materials_row ">
                <td class="item_c order_no row_class_id<?php echo $mDetail->id;?>"><?php echo ($key+1);?></td>
                <td class="l_padding_10 ">
                    <span class="description"><?php echo FiInvoiceDetail::fnBuildDescription($mDetail);?></span>
                    <?php 
                    $display_none = 'display_none';
//                    $total_amount_due+=$mDetail->amount;
                    $total_amount_due+=$mDetail->amount_gst;
                    if($key){
                        $display_none = '';
                    }
                        
                    $next = Yii::app()->createAbsoluteUrl('admin/fiInvoice/create', array('row_number'=>($key+1)));?>
                    <a href="<?php echo $next;?>" maxrow="<?php echo ($key+1);?>" class="btn btn-small AddProperty row_number_<?php echo ($key+1);?>">
                        Add Property
                    </a>
                    <?php echo $form->hiddenField($mDetail,'id[]',array('value'=>$mDetail->id,"class"=>"w-100 detail_id",'maxlength'=>14)); ?>
                </td>
                <td class="l_padding_10 w-150 item_r">
                    <?php echo $form->textField($mDetail,'amount[]',array('value'=>  MyFormat::formatNumberInput($mDetail->amount), "class"=>"amount w-100 number_only item_r",'maxlength'=>14)); ?>
                    <p>Amount Gst (<?php echo Yii::app()->params['gst'];?> %) : <span class="amount_gst"><?php echo $cmsFormater->formatPrice($mDetail->amount_gst);?></span></p>
                    <?php echo $form->error($mDetail,'amount', array('class'=>'errorMessage')); ?>
                </td>
<!--                <td class="item_c last ">
                    <span class="remove_icon_only <?php echo $display_none;?>"></span>
                </td>-->
            </tr>                    
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="item_r item_b">
                    Total Amount Due
                </td>
                <td class="item_r TotalAmountDue item_b"><?php echo $cmsFormater->formatPrice($total_amount_due);?></td>
                <!--<td></td>-->
            </tr>
        </tfoot>
    </table>
    <?php echo $form->error($model,'aModelDetail', array('class'=>'errorMessage clr')); ?>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/colorbox/jquery.colorbox-min.js"></script>    
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />
<script>
    $(function(){
        fnBindAddRow();
        fnBindRemoveIcon();
        fnUpdateColorbox();
        $('.amount').live('keyup', function(){
            fnCalcTotalPay();
        });
    });
    
    function fnBindAddRow(){
        $('.AddRowBtn').live('click', function(){
            var tr = $('.materials_row:last').clone();
            tr.find('.remove_icon_only').removeClass('display_none');            
            tr.find('.amount').val('');
            tr.find('.detail_id').val('');
            tr.find('.description').text('');
            var row_number = tr.find('.AddProperty').attr('maxrow')*1;
            tr.find('.AddProperty').removeClass('row_number_'+row_number);
            row_number++;
            var class_row_number = "row_number_"+row_number;
            var next = '<?php echo Yii::app()->createAbsoluteUrl('admin/fiInvoice/create');?>'+"?row_number="+row_number;
            tr.find('.AddProperty').addClass(class_row_number);
            tr.find('.AddProperty').attr('href', next);
            tr.find('.AddProperty').attr('maxrow', row_number);
            
            $('.materials_row:last').after(tr);
            fnRefreshOrderNumber();
            fnUpdateColorbox();
        });
    }
    
    function fnUpdateColorbox(){
        $(".AddProperty").colorbox({iframe:true,innerHeight:'500', innerWidth: '800',close: "<span title='close'>close</span>",overlayClose :false, escKey:false});        
    }
    
    function fnCalcTotalPay(){
        var gst = <?php echo Yii::app()->params['gst'];?>;
        var total_amount = 0;
        $('.materials_table tbody .materials_row').each(function(){
           var amount = $(this).find('.amount').val()*1; 
           total_amount += amount;
//           var amount_gst = fnCalcGst(amount, gst);
           amount_gst = (amount*gst*1)/100;
//           console.log(amount_gst);
           amount_gst = parseFloat(amount_gst);
           amount_gst = Math.round(amount_gst * 100) / 100;
           $(this).find('.amount_gst').text(commaSeparateNumber(amount_gst)); 
        });
//        total_amount = parseFloat(total_amount);
//        total_amount = Math.round(total_amount * 100) / 100;
//        $('.TotalAmountDue').text(commaSeparateNumber(total_amount));

        var total_amount_gst = fnCalcGst(total_amount, gst);
        total_amount_gst = parseFloat(total_amount_gst);
        total_amount_gst = Math.round(total_amount_gst * 100) / 100;
        $('.TotalAmountDue').text(commaSeparateNumber(total_amount_gst));
    }
    
    function fnAfterRemoveIcon(){
        fnCalcTotalPay();
    }
    
    // Sep 11, 2014 dùng để update row sau khi add property
    function fnUpdateAddProperty(json){
        var ObjJson = jQuery.parseJSON(json);
        var data = ObjJson[0];
        var CurrentTr = $('.row_number_'+data.row_number).closest('tr');
        CurrentTr.find('.description').html(data.description);
        CurrentTr.find('.detail_id').val(data.id);
    }
    
    // Oct 21, 2014 calc gst
    function fnCalcGst(amount, gst){
        var amount_gst = (amount*gst*1)/100;
        var res_amount_gst = amount_gst*1+amount*1;
        return res_amount_gst;
        /* for commission_amount and commission_amount_gst */
        $('.commission_amount').live('change', function(){        
            var div = $(this).closest('div.wrap_commission');
            var commission_amount = $(this).val();
            var amount_gst = (commission_amount*gst*1)/100;
            var commission_amount_gst = amount_gst*1+commission_amount*1;
            div.find('.commission_amount_gst').val( commission_amount_gst );
        });
        /* for commission_amount and commission_amount_gst */
    }
    
</script>