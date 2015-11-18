$('.remove-photo').live('click', function() {
    if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url: $(this).attr('rel'),
            type: 'GET',
            // data: formData,
            // datatype:'json',
            // async: false,
            beforeSend: function() {
                $.blockUI({message: null});
            },
            success: function(data) {
                $.fn.yiiListView.update("manager_photo", {
                    data: $(this).serialize()
                });
            },
            complete: function() {
//                setTimeout($.unblockUI, 2000); // ANH DUNG CLOSE JAN 19, 2015
                setTimeout(fnAfterSetCoverPhoto, 2000);
            },
            error: function(data) {
                $.unblockUI({
                    onUnblock: function() {
                        alert('There may a error on delete. Try again later');
                    }
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

});

//$('.btn_take_off').live('click', function() {
//    if (confirm('Are you sure you want to take off this item?')) {
//        $('#myModal').modal('show');
////        $.ajax({
////            url: $(this).attr('rel')+'/'+$(this).attr('id'),
////            type: 'GET',
////            // data: formData,
////            // datatype:'json',
////            // async: false,
////            beforeSend: function() {
////                $.blockUI({message: null});
////            },
////            success: function(data) {
////                $.fn.yiiGridView.update("sr-resume-request-grid", {
////                    data: $(this).serialize()
////                });
////            },
////            complete: function() {
////                setTimeout($.unblockUI, 2000);
////            },
////            error: function(data) {
////                $.unblockUI({
////                    onUnblock: function() {
////                        alert('There may a error on take off. Try again later');
////                    }
////                });
////            },
////            cache: false,
////            contentType: false,
////            processData: false
////        });
//    }
//
//});

$('.btn_take_off').live('click', function() {
    $('#url').val($(this).attr('rel')+'/'+$(this).attr('id'));
    $('#myModal').modal('show');
});
$('.btn-send-take-off').live('click',function(){
    $.ajax({
        url: $('#url').val(),
        type: 'GET',
        data: {takeOff:$('#request_take_off').val() },
        datatype:'json',
        async: false,
        success: function(data) {
            $.fn.yiiGridView.update("sr-resume-request-grid", {
                data: $(this).serialize()
            });
        },
        complete: function() {
             $('#url').val("");
             $('#request_take_off').val("");               
             $('#myModal').modal('hide');
        },
        error: function(data) {
            alert('There may a error on take off. Try again later');
        },
    });
})


$('.btn-admin-take-off').live('click', function() {
    if (confirm('Are you sure you want to approve take off this item?')) {
        $.ajax({
            url: $(this).attr('rel')+'/'+$(this).attr('id'),
            type: 'GET',
            // data: formData,
            // datatype:'json',
            // async: false,
            beforeSend: function() {
                $.blockUI({message: null});
            },
            success: function(data) {
                $.fn.yiiGridView.update("sr-resume-request-grid", {
                    data: $(this).serialize()
                });
            },
            complete: function() {
                setTimeout($.unblockUI, 2000);
            },
            error: function(data) {
                $.unblockUI({
                    onUnblock: function() {
                        alert('There may a error on approve take off. Try again later');
                    }
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

});

$('.remove-file-doc').live('click', function() {
    if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url: $(this).attr('rel'),
            type: 'GET',
            // data: formData,
            // datatype:'json',
            // async: false,
            beforeSend: function() {
                $.blockUI({message: null});
            },
            success: function(data) {
                $.fn.yiiListView.update("manager_cea", {
                       data: $(this).serialize()
                });  
            },
            complete: function() {
                setTimeout($.unblockUI, 2000);
            },
            error: function(data) {
                $.unblockUI({
                    onUnblock: function() {
                        alert('There may a error on delete. Try again later');
                    }
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

});

$('.btn-publish').live('click', function() {
    if (confirm('Are you sure you want to puhlish listing')) {
        $.ajax({
            url: $(this).attr('rel'),
            type: 'GET',
            beforeSend: function() {
                $.blockUI({message: null});
            },
            success: function(data) {
                $.fn.yiiGridView.update("sr-resume-request-grid", {
                       data: $(this).serialize()
                });  
            },
            complete: function() {
                setTimeout($.unblockUI, 2000);
            },
            error: function(data) {
                $.unblockUI({
                    onUnblock: function() {
                        alert('There may a error on publish. Try again later');
                    }
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

});


    $('.btn-set-cover').live('click', function() {
        $.ajax({
            url: $(this).attr('rel'),
            type: 'GET',
            // data: formData,
            // datatype:'json',
            // async: false,
            beforeSend: function() {
                $.blockUI({message: null});
            },
            success: function(data) {
                $.fn.yiiListView.update("manager_photo", {
                    data: $(this).serialize()
                });
            },
            complete: function() {
                setTimeout( fnAfterSetCoverPhoto, 2000);
            },
            error: function(data) {
                $.unblockUI({
                    onUnblock: function() {
                        alert('There may a error on delete. Try again later');
                    }
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    
    /** ANH DUNG JAN 19, 2015
     *  To do some action after set cover photo
     */
    function fnAfterSetCoverPhoto(){
        fnBindSortable();
        $.unblockUI();
    }
