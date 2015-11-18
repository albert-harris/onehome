/*
 * UPLOAD IMAGE
 */
function sendImage(link,idFormdata,buttonSubmit){
    var formData = new FormData($("#"+idFormdata)[0]);
    $.ajax({
        url: link,
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            $.blockUI({ message: null }); 
        },
        success: function (data) {
                if(data =="limit"){
                        alert("Limit photo upload");
                }else{
                     if(data=='maxsize'){
                         alert("Limit file upload 10 MB");
                    }else{
                        $.fn.yiiListView.update("manager_photo"); 
//                        $.fn.yiiListView.update("manager_photo", {
//                              data: $(this).serialize()
//                       });                      
                    }                   
                }
                $(".MultiFile-remove").click(); 
                $.unblockUI;
        },
 
        complete: function() {
                    setTimeout($.unblockUI, 2000); 
        },
 
        error: function (data) {
            $.unblockUI({ 
               onUnblock: function(){ alert('There may a error on uploading. Try again later'); } 
           });             
        },
        cache: false,
        contentType: false,
        processData: false
    });
 
    return false;
}

/*
* UPLOAD FILE
*/
function sendFile(link,idFormdata,buttonSubmit){
   var formData = new FormData($("#"+idFormdata)[0]);
   if($("#Listing_title_cea").val()==''){
       alert('Title cannot be blank');
       $(".MultiFile-remove").click(); 
   }else{
   $.ajax({
        url: link,
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            $.blockUI({ message: null }); 
        },
        success: function (data) {
                if(data =="limit"){
                        alert("Limit file upload");
                }
                else{
                    if(data=='maxsize'){
                         alert("Limit file upload 10 MB");
                    }else{
//                        $.fn.yiiListView.update("manager_cea", {
//                              data: $(this).serialize()
//                       });   
                         $.fn.yiiListView.update("manager_cea"); 
                    }
                }
                $('#Listing_title_cea').val("");
                $(".MultiFile-remove").click(); 
                $.unblockUI;        
        },
 
        complete: function() {
                    setTimeout($.unblockUI, 2000); 
        },
 
        error: function (data) {
            $.unblockUI({ 
               onUnblock: function(){ alert('There may a error on uploading. Try again later'); } 
           });             
        },
        cache: false,
        contentType: false,
        processData: false
    });       
   }
 
 
    return false;
}