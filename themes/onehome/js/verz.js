// fix page display messy when loading
$(window).load(function () {
	$('html').removeClass('invisible'); 
});

setTimeout(function(){
    $('html').removeClass('invisible');
}, 3000);

// Anh Dung
jQuery(document).ready(function(){
        validateNumber();
        bindDisableClick();
        fnInitInputCurrency();
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

/*
 * Javascript for Our Team page http://onehome.sg/our-team
 * 
 * @author Lam Huynh
 */
function setupOurteamPage() {
	$('body').on('click', '.short-text', function() {
		$(this).hide();
		$(this).siblings('.full-text').removeClass('hide');
		$.get($(this).siblings('.short-text-url').val());
	});
}

/*
 * Javascript for ListingWidget. Agent Detail page http://onehome.sg/agent/detail/lucas-chen
 * 
 * @author Lam Huynh
 */
function setupListingWidget() {
	$('.listing-widget').on('change', '.typeSelect, .sortBy, .pageSize', function () {
		var form = $(this).closest('form');
		var qp = getQueryParams();
		qp['s_sort'] = form.find('.sortBy').val();
		qp['pageSize'] = form.find('.pageSize').val();
		qp['listing_type'] = form.find('.typeSelect').val();
		var q = $.param(qp);
		var url = window.location.href.split("?")[0] + '?' + q;
		$.fn.yiiListView.update('yw0', {url: url });
	});
}

/*
 * Convert query string to object
 * 
 * @author Lam Huynh
 */
function getQueryParams() {
	var query = location.search.substr(1);
	var data = query.split("&");
	var result = {};
	for(var i=0; i<data.length; i++) {
		var item = data[i].split("=");
		result[item[0]] = item[1];
	}
	return result;
}

/*
 * Javascript for search tab in homepage, under main menu
 * 
 * @author Lam Huynh
 */
function setupSearchHomepage(params) {
    $(function () {
		$('.search-tab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			$('#listing_for').val(e.target.className).change();
		});
		  
        $('.more_search_options').click(function () {
            $('.more_search_box').slideToggle();
        });
		
        $("#listed_on_date").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            showOn: 'button',
            buttonImageOnly: true,
            buttonImage: params.iconCalendar
        });
        $('.multiselect_location').multiselect({
            maxHeight: 200,
            buttonWidth: '100%',
            numberDisplayed: 0,
            checkboxName: 'location[]'
        });
        $('.multiselect_location_buy').multiselect({
            maxHeight: 200,
            buttonWidth: '100%',
            numberDisplayed: 0
        });
        $('.multiselect_location_rent').multiselect({
            maxHeight: 200,
            buttonWidth: '100%',
            numberDisplayed: 0
        });
        fnBindChangeBedRoom();
        fnBindSelectType();
        fnBindChangeMinMax('#minimum_price', '#maximum_price');
        fnBindChangeMinMax('#minimum_floor', '#maximum_floor');
        fnBindChangeMinMax('#minimum_price_engage', '#maximum_price_engage');
        fnBindChangeMinMax('#minimum_price_engage_rent', '#maximum_price_engage_rent');
        fnBindChangeMinMax('#minimum_bedroom_engage', '#maximum_bedroom_engage');
        fnBindChangeMinMax('#minimum_bedroom_engage_rent', '#maximum_bedroom_engage_rent');
        fnBindChangeMinMax('#minimum_floor_engage', '#maximum_floor_engage');
        fnBindChangeMinMax('#minimum_floor_engage_rent', '#maximum_floor_engage_rent');
        fnCheckBoxClick();
    });
    $(window).load(function () {
		$('.multi-select-wrap').removeClass('hide');
        fnShowHideTenure();
    });
    function fnBindChangeBedRoom() {
        $('#minimum_bedroom').change(function () {
            var minimum_bedroom = $('#minimum_bedroom').val() * 1;
            var maximum_bedroom = $('#maximum_bedroom').val() * 1;
            if (minimum_bedroom > maximum_bedroom) {
                $('#maximum_bedroom').val(minimum_bedroom);
                $('#maximum_bedroom').trigger('change');
            }
        });
        $('#maximum_bedroom').change(function () {
            var minimum_bedroom = $('#minimum_bedroom').val() * 1;
            var maximum_bedroom = $('#maximum_bedroom').val() * 1;
            if (minimum_bedroom > maximum_bedroom) {
                $('#minimum_bedroom').val(maximum_bedroom);
                $('#minimum_bedroom').trigger('change');
            }
        });
    }
    function fnBindSelectType() {
        $('#listing_for').change(function () {
            var selected = $(this).val();
            var new_html_select = $('.price_sale_hide_' + selected).html();
            var form = $(this).closest('form');
            //minimum_price maximum_price
            var minimum_price = form.find('.minimum_price');
            var maximum_price = form.find('.maximum_price');
            minimum_price.html(new_html_select);
            maximum_price.html(new_html_select);
            maximum_price.find('option').eq(0).text('Maximum');
            minimum_price.trigger('click');
            maximum_price.trigger('click');
            fnShowHideTenure(); // fix Aug 11, 2014
        });
    }
    function fnShowHideTenure() {
        $('.select_type').each(function () {
            var selected = $(this).val();
            if ($(this).is(':checked')) {
                $('.div_furnished_tenure_' + selected).show();
            } else {
                $('.div_furnished_tenure_' + selected).hide();
            }
        });
    }	
}

/*
 * Javascript for property type dropdown. used in search tab
 * 1. khi vừa load trang thì chọn all, check tất cả
 * 2. khi người ta uncheck cái All thì uncheck tat ca , check other
 * 3. khi người ta uncheck hết đống ớ giữa thì tự động check cái Others
 * 4. khi người ta ráng uncheck luôn cái others -> không cho uncheck
 * 5. nếu đang all (tất cả check) mà người ta uncheck 1 cái ở giữa hoặc others thì tự động uncheck cái All
 * 
 * @author Jason
 */
function checkboxList(form) {

	$('.multiselectbox').each(function() {
		var totalChecked = $(this).find('input[type="checkbox"]:checked').length;
		if (form === 'search' && totalChecked === 0) //check all as default
		{
			$(this).find('input[type="checkbox"]').prop('checked', true);
		} else {
			var checkboxListUlHolder = $(this).find('.checkBoxList_list');
			var totalCheckItems = checkboxListUlHolder.find('.checkboxItem').length;
			var totalChecked = checkboxListUlHolder.find('.checkboxItem:checked').length;

			var checkboxOtherChecked = true;
			if ($(this).find('.checkboxOther').length > 0) {
				if ($(this).find('.checkboxOther').is(':checked') == false)
					checkboxOtherChecked = false;
			}
			$(this).find('.checkAll').prop('checked', totalCheckItems === totalChecked && checkboxOtherChecked);
		}
	});

	//SELECT BOX - action click to show
	$('.checkAll').on('click', function() {
		var objCurrentHolder = $(this).parent().children('.checkBoxList');
		if (objCurrentHolder.is(':visible'))
			objCurrentHolder.hide();
		else
			objCurrentHolder.show();

	});

	//Jason
	//action click OK
	$('.checkBoxList_actions .btn-ok').on('click', function() {
		$(this).parent().parent('.checkBoxList').hide();
	});

	//Jason
	//action click CANCEL
	$('.checkBoxList_actions .btn-cancel').on('click', function() {
		$(this).parent().parent('.checkBoxList').find('input[type="checkbox"]').prop('checked', false);
		$(this).parent().parent('.checkBoxList').hide();

	});

	//Jason
	//click out of area
	$(document).mouseup(function(e) {
		var container = $(".checkBoxList");
		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.hide();
		}
	});


	/**
	 * <Jason>
	 */
	$('.checkAll').click(function() {
		var status = $(this).is(':checked');
		$(this).parent().next().find('.checkboxItem').prop('checked', status);
	});

	//Jason
	var objCheckboxItem = $('.multiselectbox .checkBoxList_list .checkboxItem');
	objCheckboxItem.on('click', function() {
		var checkboxListUlHolder = $(this).parent().parent().parent('.checkBoxList_list');
		var totalCheckItems = checkboxListUlHolder.find('.checkboxItem').length;
		var totalChecked = checkboxListUlHolder.find('.checkboxItem:checked').length;

		var objHolder = checkboxListUlHolder.parent('.checkBoxList_container').parent('.multiselectbox');
		if (totalChecked === 0) //must select at least one checkbox - auto check others
		{
			if (objHolder.find('.checkboxOther').length > 0) {
				objHolder.find('.checkboxOther').prop('checked', true);
			}
		}

		var checkboxOtherChecked = true;
		if (objHolder.find('.checkboxOther').length > 0) {
			if (objHolder.find('.checkboxOther').is(':checked') === false)
				checkboxOtherChecked = false;
		}
		checkboxListUlHolder.prev().children('.checkAll').prop('checked', totalCheckItems === totalChecked && checkboxOtherChecked);
	});
}

/*
 * Javascript for add short list button, display in property item
 * 
 * @author Lam Huynh
 */
function setupShortList(data) {
	var user_id = data.userId;
	var role_id = data.roleId;
	var role_member = data.roleMember;
	var url = data.addShortListUrl;
	$('.page-content').on('click', '.shortlist', function() {
		if (user_id && role_id === role_member) {
			var listing_id = $(this).data('listing-id');
			var data = {};
			data["listing_id"] = listing_id;
			$.ajax({
				url: url,
				data: data,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					alert(data.message);
				},
				error: function() {
					alert(data.message);
				}
			});
		} else {
			window.location = $(this).attr('next');
		}
	});
}

/*
 * Javascript for add newsletter form
 * 
 * @author Lam Huynh
 */
function setupNewsletterForm(newsletterUrl) {
	$(document).ready(function () {
		$('#btn_Subscribe').unbind('click').bind('click', function () {
			var email = $('#guest_mail').val();
			// begin ajax
			var url_ = newsletterUrl;;
			$.ajax({
				url: url_,
				data: {email: email, ajax: 'ajax'},
				type: "post",
				dataType: "json",
				async: false,
				success: function (data) {
					if (data['success'] == true) {
						$('.newsletter .errorSummary').show().css({color: "#0099FF"}).text("Successfully!");
						$('#guest_mail').val('');
					} else {
						$('.newsletter .errorSummary').show().css({color: "red"}).text(data['msg']);
						return false;
					}
				}
			});
			return false;
			// end ajax
		});
	});
}

/*
 * Javascript for property detail page. http://onehome.sg/agent/detail/lucas-chen
 * 
 * @author Lam Huynh
 */
function setupPropertyPhotoGallery() {
    // listing gallery photo
    (function($) {
        $(function() {
            var jcarousel = $('.jcarousel');

            jcarousel.jcarousel({
                wrap: 'circular'
            });

            $('.jcarousel-control-prev')
                .jcarouselControl({
                    target: '-=1'
                });

            $('.jcarousel-control-next')
                .jcarouselControl({
                    target: '+=1'
                });

            $('.jcarousel-pagination')
                .on('jcarouselpagination:active', 'a', function() {
                    $(this).addClass('active');
                })
                .on('jcarouselpagination:inactive', 'a', function() {
                    $(this).removeClass('active');
                })
                .on('click', function(e) {
                    e.preventDefault();
                })
                .jcarouselPagination({
                    perPage: 1,
                    item: function(page) {
                        return '<a href="#' + page + '">' + page + '</a>';
                    }
                });
        });
    })(jQuery);
    $(".thumb").bind('click', $(this), function (e) {
        e.preventDefault();
        $('#mycarousel li').removeClass('first active');
        $(this).parent().addClass('active');
        $("#img_main").attr('src', $(this).attr('href'));
    });
}

window.app = {
	
	setupAgentRegisterPage: function () {
		// add new rules
		var rules = [
			{
				inputs: '#ProAgent_uploadPhoto, #ProAgent_uploadNricFront, #ProAgent_uploadNricBack',
				validators: [app.imageValidator],
				form: 'form'
			}
		];
		rules.forEach(function(value, index, arr) {
			app.addValidateRule(value);
		});
	},
	
	addValidateRule: function (rule) {
		$(rule.inputs).each(function () {
			var inputId = this.id;
			var inputName = '';
			inputId.split('_').forEach(function(value, index, arr) {
				if (index==0) {
					inputName = value;
				} else {
					inputName += '['+value+']';
				}
			});
			var yiiRule = {
				'id': inputId,
				'inputID': inputId,
				'errorID': inputId + '_em_',
				'enableAjaxValidation': false,
				'clientValidation': app.createValidateChain(rule.validators)
			};
			$(this).closest(rule.form).data('settings').attributes.push(yiiRule);
		});
	},
	
	removeValidateRule: function (inputs) {
		$(inputs).each(function () {
			var inputID = this.id;
			var attributes = $(this).closest('form').data('settings').attributes;
			attributes.forEach(function (item, index, object) {
				if (item.inputID == inputID) {
					attributes.splice(index, 1);
				}
			});
		});
	},
	
	numberValidator: function (value, messages, attribute) {
		if (isNaN(value)) {
			messages.push("Minimum value is 1.");
			return false;
		}
		return true;
	},

	imageValidator: function (value, messages, attribute) {
		var input = $('#'+attribute.inputID);
		if (input.size()<1 || input[0].files.length<1) {
			return true;
		}
		var f = input[0].files[0];
		var ext = f.name.substr(f.name.lastIndexOf('.')+1);
		if ($.inArray(ext, ['jpg','png','gif']) == -1) {
			messages.push('Only allow file type: *.jpg, *.png, *.gif');
			return false;
		}
		
		return true;
	},
	
	checkboxValidator: function (value, messages, attribute) {
		var input = $('#'+attribute.inputID);
		if (input.size()<1 || input[0].files.length<1) {
			return true;
		}
		var f = input[0].files[0];
		var ext = f.name.substr(f.name.lastIndexOf('.')+1);
		if ($.inArray(ext, ['jpg','png','gif']) == -1) {
			messages.push('Only allow file type: *.jpg, *.png, *.gif');
			return false;
		}
		
		return true;
	},
	
	createValidateChain: function (rules) {
		return function (value, messages, attribute) {
			rules.every(function (valFunc, index, arr) {
				return valFunc(value, messages, attribute);
			});
		};
	},
	
	setupEngageUsForm: function () {
		// client validation for term & condition checkbox
		$('#eu-sell-form').data('settings').attributes.push({
			id: 'sell-term',
			inputID: 'sell-term',
			errorID: 'ProGlobalEnquiry_get_update_em_',
			enableAjaxValidation: false,
			clientValidation: function (value, messages, attribute) {
				if ( !$('#'+attribute.inputID).is(':checked') ) {
					messages.push('You must agree to the term & condition');
					return false;
				}
				return true;
			}
		});
		
		// client validation for term & condition checkbox
		$('#eu-rent-form').data('settings').attributes.push({
			id: 'rent-term',
			inputID: 'rent-term',
			errorID: 'ProGlobalEnquiry_get_update_em_',
			enableAjaxValidation: false,
			clientValidation: function (value, messages, attribute) {
				// if is Landlord
				if ( !$('#'+attribute.inputID).is(':checked') 
					&& $('#rent2').is(':checked') 
					&& $('#ProGlobalEnquiry_rent_type_0').is(':checked') ) {
					messages.push('You must agree to the term & condition');
					return false;
				}
				return true;
			}
		});
		
		// client validation for nric
		$('#eu-rent-form').data('settings').attributes.push({
			id: 'ProGlobalEnquiry_nric',
			inputID: 'ProGlobalEnquiry_nric',
			errorID: 'ProGlobalEnquiry_nric_em_',
			enableAjaxValidation: false,
			clientValidation: function (value, messages, attribute) {
				// if is Landlord
				if ( $('#'+attribute.inputID).val().trim()===''
					&& $('#rent2').is(':checked') 
					&& $('#ProGlobalEnquiry_rent_type_0').is(':checked') ) {
					messages.push('Nric cannot be blank.');
					return false;
				}
				return true;
			}
		});
		$('#buy, #sell, #rent2, input[name="ProGlobalEnquiry[rent_type]"]').click(app.updateEngageUsForm);
		app.updateEngageUsForm();
	},
	
	updateEngageUsForm: function () {
		// Show checkbox of “I Agree terms&conditions” if Sell
		// Show checkbox of “I Agree terms&conditions” if rent->Landlord
		// Hide check box of “I Agree terms&conditions” if buy
		// Hide check box of “I Agree terms&conditions” if rent -> tenant
		if ( $('#buy').is(':checked') 
			|| ($('#rent2').is(':checked') && $('#ProGlobalEnquiry_rent_type_1').is(':checked')) ) {
			$('.term-chk').addClass('hide');
		} else {
			$('.term-chk').removeClass('hide');
		}
	}
	
};