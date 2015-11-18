<?php
if($function=='sendImage'){
        //image
        $this->widget('CMultiFileUpload', array(
              'model'=>$model,
              'attribute'=>$attribute,
              'accept'=>"$allowFile",
              'denied'=>'File is not allowed',
              'max'=>$Maxfile,
              'options'=>array(
                 'afterFileSelect'=>'function(e, v, m){
//                        var fileSize = e.files[0].size;
//                        if(fileSize>10*1024*1024){ //10MB limit
//                           alert("Exceeds file upload limit 10 MB");
//                           $(".MultiFile-remove").click(); 
//                         }else{
                            sendImage("'.$url.'","'.$idFormdata.'","'.$class.'");
//                        }   
                    }',
              ),
              'htmlOptions'=>array(
                  'class'=>$class
              )
        ));  
}else{
        //file
         $this->widget('CMultiFileUpload', array(
              'model'=>$model,
              'attribute'=>$attribute,
              'accept'=>"$allowFile",
              'denied'=>'File is not allowed',
              'max'=>$Maxfile,
              'options'=>array(
                 'afterFileSelect'=>'function(e, v, m){
//                        var fileSize = e.files[0].size;
//                        if(fileSize>10*1024*1024){ //10MB limit
//                           alert("Exceeds file upload limit 10 MB");
//                           $(".MultiFile-remove").click(); 
//                         }else{
                                  sendFile("'.$url.'","'.$idFormdata.'","'.$class.'");
//                        }                       
                  }',
              ),
              'htmlOptions'=>array(
                  'class'=>$class
              )
        ));     
}

?>

<script src="<?php echo $assets ?>/js/T_file_ajax.js"></script>
<script src="<?php echo $assets ?>/js/jquery.blockUI.js"></script>