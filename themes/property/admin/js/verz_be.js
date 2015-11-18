/** Apr 18, 2014 ANH DUNG
 *  To fix target blank for all index page
 */
$(document).ready(initVerz);

function initVerz() {
	fixTargetBlank();
}

function fixTargetBlank() {
	$('.button-column a').attr('target', '_blank');
//	$('.control-nav').find('.btn a').attr('target', '_blank');
}

/** Mar 06, 2014
 * @todo remove tr and refresh order number of row
 */
function fnBindRemoveIcon(){
    $('.remove_icon_only').live('click',function(){
        if(confirm('Are you sure you want to delete this item?')){
            $(this).closest('tr').remove();
            fnRefreshOrderNumber();
            fnAfterRemoveIcon();
        }
    });
}

function fnAfterRemoveIcon(){}

/** Mar 06, 2014
 * @todo refresh order number of row
 */
function fnRefreshOrderNumber(){
    $('.materials_table').each(function(){
        var index = 1;
        $(this).find('.order_no').each(function(){
            $(this).text(index++);
        });
    });
} 

// format number: 200,000
function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
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