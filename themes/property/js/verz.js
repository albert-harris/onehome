// Anh Dung
jQuery(document).ready(function(){
        validateNumber();
        bindDisableClick();
        fnInitInputCurrency();
	// remove image button
	$('.remove-img-ajax').click(function (e) {
		e.preventDefault();
		if (!confirm('Do you sure to delete this image?'))
			return;
		var anc = $(this);
		$.ajax({
			type: 'POST',
			url: this.href,
			success: function (data) {
				if (data) {
					anc.closest('p').remove();
				} else {
					alert('can not remove image');
				}
			},
			error: function (XHR, textStatus, errorThrown) { }

		});
	});
});

function validateNumber(){
    $(".number_only").each(function(){
            $(this).unbind("keydown");
            $(this).bind("keydown",function(event){
                if( !(event.keyCode == 8                                // backspace
                    || event.keyCode == 46                              // delete
                    || event.keyCode == 9							// tab
                    || (event.keyCode == 190 || event.keyCode == 110 ) // dấu chấm (point) 
                    || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
                    || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
                    || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
                    ) {
                        event.preventDefault();     // Prevent character input
                    }
            });
    });    
}

/**
 * ANH DUNG Sep 18, 2014
 * todo: thêm dấu phẩy vào cho input currency
 * not use
 */
function fnFixInputCurrency() {
//    $(".ad_fix_currency").each(function(){
//        $(this).bind("keydown",function(event){
//            $(this).val(commaSeparateNumber($(this).val()));
//        });
//    });    
}

// ANH DUNG Sep 18, 2014
function fnInitInputCurrency() {
    $(".ad_fix_currency").each(function(){
        $(this).autoNumeric('init', {lZero:"deny", aPad: false} ); 
    });    
}

// ANH DUNG - Apr 28, 2014
function bindDisableClick(){
    $('.disable_click').on('click',function(){return false;});
//    $('.disable_click').on('change',function(){return false;});
}


/** Mar 11, 2014 -  ANH DUNG - COPY FROM MINDEDGE
 * Dùng để cập nhật url tiếp theo khi change select
 * @param {string} classOfSelect class of tag select
 * @param {string} requestUri 
 */
function fnUpdateNextUrl(classOfSelect, requestUri, attributeAdd){
    $(classOfSelect).find('option').each(function(){        
        $(this).attr('next',updateQueryStringParameter(requestUri, attributeAdd, $(this).val()));
    });  
    // reg event
    $(classOfSelect).change(function(){
        window.location= $('option:selected', this).attr('next');
    });
}

/**
* @param {String} uri
* @param {String} key : is name new attribute
* @param {String} value : is value of new attribute
* @returns {String}             */
// http://stackoverflow.com/questions/5999118/add-or-update-query-string-parameter
function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
  separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }
  else {
    return uri + separator + key + "=" + value;
  }
}  


function fnSelectTeant(item, idField){
    $('#ProTransactionsVendorPurchaserDetail_email').attr('readonly',true).val(item.email);
    $('#ProTransactionsVendorPurchaserDetail_name').attr('readonly',true).val(item.full_name);
    $('#ProTransactionsVendorPurchaserDetail_nric_passportno_roc').attr('readonly',true).val(item.nric_passportno_roc);
    $('#ProTransactionsVendorPurchaserDetail_contact_no').attr('readonly',true).val(item.contact_no);
    $('#ProTransactionsVendorPurchaserDetail_address').attr('readonly',true).val(item.address);
    $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',true).val(item.postal_code);
    $('#ProTransactionsVendorPurchaserDetail_id_type').attr('disabled',true).val(item.id_type);
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').val(item.pass_expiry_date);
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').closest('div.group-4').find('input').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').closest('div.group-4').find('img').hide();
    $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',true).val(item.postal_code);

//    if(item.upload_employment_pass_passport!=''){
        $('.span_scanned_employment_pass').text(item.upload_employment_pass_passport);
        $('.p_scanned_employment_pass').show();
        $('.span_scanned_employment_pass').closest('div.group-4').find('.help_file_type').hide();
        $('.span_scanned_employment_pass').closest('div.group-4').find('input:file').hide();
        
//    }
    
//    if(item.scanned_passport!=''){
        $('.span_scanned_passport').text(item.scanned_passport);
        $('.p_scanned_passport').show();
        $('.span_scanned_passport').closest('div.group-4').find('.help_file_type').hide();
        $('.span_scanned_passport').closest('div.group-4').find('input:file').hide();
//    }

    $('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');
}

// Apr 28, 2014
function fnRemoveUidSelect(this_, idField, idFieldCustomer){
    
    $('#ProTransactionsVendorPurchaserDetail_email').attr('readonly',false).val("");
    $('#ProTransactionsVendorPurchaserDetail_name').attr('readonly',false).val("");
    $('#ProTransactionsVendorPurchaserDetail_nric_passportno_roc').attr('readonly',false).val("");
    $('#ProTransactionsVendorPurchaserDetail_contact_no').attr('readonly',false).val("");
    $('#ProTransactionsVendorPurchaserDetail_address').attr('readonly',false).val("");
    $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',false).val("");
    $('#ProTransactionsVendorPurchaserDetail_id_type').attr('disabled',false).val('');
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').val("");
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').closest('div.group-4').find('input').attr('readonly',false);
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').closest('div.group-4').find('img').show();
    $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',false).val("");

    $('.span_scanned_employment_pass').text('');
    $('.p_scanned_employment_pass').hide();
    $('.span_scanned_employment_pass').closest('div.group-4').find('.help_file_type').show();
    $('.span_scanned_employment_pass').closest('div.group-4').find('input:file').show();
    
    $('.span_scanned_passport').text('');
    $('.p_scanned_passport').hide();
    $('.span_scanned_passport').closest('div.group-4').find('.help_file_type').show();
    $('.span_scanned_passport').closest('div.group-4').find('input:file').show();

    $('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');
}

function fnReadonlyInput(){
    $('#ProTransactionsVendorPurchaserDetail_email').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_name').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_nric_passportno_roc').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_contact_no').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_address').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',true);
    
    $('#ProTransactionsVendorPurchaserDetail_email').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_name').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_nric_passportno_roc').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_contact_no').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_address').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_id_type').attr('disabled',true);
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').closest('div.group-4').find('input').attr('readonly',true);
    $('#ProTransactionsVendorPurchaserDetail_pass_expiry_date').closest('div.group-4').find('img').hide();
    $('#ProTransactionsVendorPurchaserDetail_postal_code').attr('readonly',true);

    var span_scanned_employment_pass = $('.span_scanned_employment_pass').text();
    if($.trim(span_scanned_employment_pass)!='')
        $('.p_scanned_employment_pass').show();
    $('.span_scanned_employment_pass').closest('div.group-4').find('.help_file_type').hide();
    $('.span_scanned_employment_pass').closest('div.group-4').find('input:file').hide();
    
    var span_scanned_passport = $('.span_scanned_passport').text();
    if($.trim(span_scanned_passport)!='')
        $('.p_scanned_passport').show();
    $('.span_scanned_passport').closest('div.group-4').find('.help_file_type').hide();
    $('.span_scanned_passport').closest('div.group-4').find('input:file').hide();

    $('#ProTransactionsVendorPurchaserDetail_id_type').trigger('change');    
    
}

function fnCalcCommissionGst(gst){
    /* for commission_amount and commission_amount_gst */
    $('.commission_amount').on('change', function(){        
        var div = $(this).closest('div.wrap_commission');
        var commission_amount = ""+$(this).val();
        commission_amount = commission_amount.replace(/,/g , "");        
        var amount_gst = (commission_amount*gst*1)/100;
        var commission_amount_gst = amount_gst*1+commission_amount*1;
        div.find('.commission_amount_gst').val( commission_amount_gst );
        var val_show = commaSeparateNumber(commission_amount_gst);
        div.find('.commission_amount_gst_show').val( val_show );        
    });
    /* for commission_amount and commission_amount_gst */
}

/** dùng để đăng ký 1 action ajax giống delete, nghĩa là sẽ ajax update lại grid sau khi thực hiện action
 * @param {type} IdTable: #sr-resume-request-grid 
 * @param {type} ClassAjax: ajax_like_delete
 * @param {type} MessageConfirm: message to confirm user
 * @returns {undefined}
 */    
function fnRegisterAjaxLink(IdTable, ClassAjax, MessageConfirm){
    jQuery(document).on('click', IdTable+' '+ClassAjax,function() {
        if(!confirm(MessageConfirm)) return false;
        var th = this,
        afterDelete = function(){};
        jQuery(IdTable).yiiGridView('update', {
                type: 'POST',
                url: jQuery(this).attr('href'),
                success: function(data) {
                        jQuery(IdTable).yiiGridView('update');
//                        afterDelete(th, true, data);
                },
                error: function(XHR) {
//                        return afterDelete(th, false, XHR);
                }
        });
        return false;
    });    
}

 // format number: 200,000
function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
}


    /** Date Move - Mar 10, 2015 - Created date => Jun 02, 2014 ANH DUNG. To do bind change select alway min <= max
      * @param {string} MaxId '#minimum_price'
      * @param {string} MaxId '#maximum_price'
      */
    function fnBindChangeMinMax(MinId, MaxId){
       $(MinId).change(function(){
           var minimum_bedroom = $(MinId).val()*1;
           var maximum_bedroom = $(MaxId).val()*1;
           if(minimum_bedroom>maximum_bedroom){
               $(MaxId).val(minimum_bedroom);
               $(MaxId).trigger('change');
           }
       });

       $(MaxId).change(function(){
           var minimum_bedroom = $(MinId).val()*1;
           var maximum_bedroom = $(MaxId).val()*1;
           if(minimum_bedroom>maximum_bedroom){
               $(MinId).val(maximum_bedroom);
               $(MinId).trigger('change');
           }
       });        
    }

