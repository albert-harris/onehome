 /*
 * @Author: ghostkiss_boy
 * @Date:   2014-07-31 14:28:19
 * @Last Modified by:   ghostkiss_boy
 * @Last Modified time: 2014-08-26 11:10:27
 */


var app = angular.module('NgValidationTestApp', ['xtForm']);
function checkAmount(currentItem){
     var total = 0;
     var gst = parseFloat($('#gst').val());
     if (currentItem.comm != 'undefined' && currentItem.gross_commission != 'undefined' ){
        if(Number(currentItem.comm) && Number(currentItem.gross_commission) ){
            var comm  = parseFloat(currentItem.comm);
            var gross = parseFloat(currentItem.gross_commission);
            var total =  (comm*gross*1)/100;// Jan 23, 2015 ANH DUNG FIX
//            var total =  (comm*gross*1);// Jan 23, 2015 ANH DUNG CLOSE
            
            //var total = parseFloat(total); 

            //var total = ( parseFloat(currentItem.comm)+ parseFloat(currentItem.gross_commission));
/*            total =  total.toFixed(2).replace(/./g, function(c, i, a) {
                return i && c !== "." && !((a.length - i) % 3) ? ',' + c : c;
            });   */   
            
            return parseFloat(total);            
        }
    }   
    return 0;    
}



function checkprice(name) {
    $(name).live('keydown', function(e) {
        var key = e.which;
        if (key != 8 && key != 107 && key != 187 && key != 16 && key != 9 && key != 37 && key != 38 && key != 39 && key != 40 && key != 46 && key != 13 && key != 96 && key != 97 && key != 98 && key != 99 && key != 100 && key != 101 && key != 102 && key != 103 && key != 104 && key != 105 && key != 173) {
                if (key < 48 && key !=110 && key !=190) e.preventDefault();
                else if (key > 57 && key !=110 && key !=190) e.preventDefault();
        }
    });
}

function unkeydown(name) {
    $(name).live('keydown', function(e) {
        var key = e.which;
        if (key != 8) {
            e.preventDefault();
        }
    });
}

function price(total){
    if(total !='' && Number(total)){
        total = parseFloat(total)*1;
        total =  total.toFixed(2).replace(/./g, function(c, i, a) {
            return i && c !== "." && !((a.length - i) % 3) ? ',' + c : c;
        });   
        return total;       
    }
}

function number(name) {
    $(name).live('keydown', function(e) {
        var key = e.which;
        if (key != 8 && key != 107 && key != 187 && key != 16 && key != 9 && key != 37 && key != 38 && key != 39 && key != 40 && key != 46 && key != 110 && key != 13 && key != 96 && key != 97 && key != 98 && key != 99 && key != 100 && key != 101 && key != 102 && key != 103 && key != 104 && key != 105 && key != 173) {
            if (e.shiftKey) {
                if (key == 61 || key == 57 || key == 48 || key == 173) return key.returnValue;
                else e.preventDefault();
            } else {
                if (key < 48) e.preventDefault();
                else if (key > 57) e.preventDefault();
            }
        }
    });
}

//default 
checkprice('.comm');
checkprice('.gross');

function caculaterPrice(){   
    var total  = 0; 
     $('table.item-payment tr').each(function(){
        var comm   = parseFloat($(this).find('.comm').val());
        var gross  = parseFloat($(this).find('.gross').val());   
        if(Number(comm) && Number(gross) ){  
            var totalCurent = (comm*gross*1)/100; // Jan 23, 2015 ANH DUNG FIX
            $(this).find('.amount').val(price(totalCurent));
            total += totalCurent;
        }else{
             $(this).find('.amount').val("");
        }         
    })
    
     $('.allTotalAmount').val(price(total));
     $('.allTotalAmount_hidden').val(total);
}

$(function(){
    $('.change-item').live('change',function(){
        caculaterPrice();
    })
    
    $('.remove-item').live('click',function(){
        caculaterPrice();
    })

    $('.change-item').trigger('change');
    $('.allTotalAmount').val(price($('.allTotalAmount_hidden').val()));

})


app.controller('TodoCtrl', function($scope) {
    $scope.form = {
        onSubmit: function(isValid) {
            if (isValid) {
                $('#partner-form-submit').submit();
            }
        }
    };
    
    $scope.vouchers      = [{
        client_type:1
    }];
    
    $scope.clearCompleted  = function(array, index) {
        array.splice(index, 1);
        
        if (array.length == 0) {        
            $scope.vouchers.push({});
        }
    }

    $scope.getAllAmount = function () {
        var total = 0;
        for(var i = 0; i < $scope.vouchers.length; i++){
            var amount = checkAmount($scope.vouchers[i]);
            if(Number(amount)){
                total += amount;
            }
        }
        total =  total.toFixed(2).replace(/./g, function(c, i, a) {
                    return i && c !== "." && !((a.length - i) % 3) ? ',' + c : c;
                });
        return  total;
    };

    $scope.addTodo = function() {
        $scope.vouchers.push({ client_type:1 });
    };
});

app.directive('autoComplete', function() {
    return {
        restrict: 'A',
        link: function(scope, elem, attr, ctrl) {
            if($("#FiPaymentVoucher_user_name").val()==''){
                $('.search').attr('disabled',true);
            }else{
                $('.search').attr('disabled',false);
            }
            elem.autocomplete({
                source: $('#ajaxlink').val(), //from your service
                select: function( event, ui ) {
                    $('.invoice_id_'+attr.item).val(ui.item.id);
                    $('.invoice_name_'+attr.item).val(ui.item.invoice_no);
                    $('.comm_'+attr.item).val($('#commission_schema_id').val());
                    $('.gross_'+attr.item).val(ui.item.gross);
                    $('.desciption_'+attr.item).val(ui.item.description);
                    caculaterPrice();
                }
            });
        }
    };
});