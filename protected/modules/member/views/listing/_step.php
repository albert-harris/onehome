<div class="radius" style="width:750px;" >

    <?php
        $action = Yii::app()->controller->action->id; 
        $currentID = array();
        if(isset($_GET['id'])&& is_numeric($_GET['id'])){
            $currentID = array('id'=>$_GET['id']);
    ?>
    <ul class="clearfix">
        
        <li <?php if ($action == 'create') echo 'class="active"' ?> >	
            <a class="circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/create',$currentID) ?>">Step 1</a> 
            <a class="txt-circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/create',$currentID) ?>">Basic information</a>
        </li>
        
        <li  <?php if ($action == 'extradetail') echo 'class="active"' ?>  >	
            <a class="circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/extradetail',$currentID) ?>"> Step 2</a>
            <a class="txt-circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/extradetail',$currentID) ?>">Extra details</a>
        </li>
        
        <li  <?php if ($action == 'managephotos') echo 'class="active"' ?> >	
            <a class="circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/managephotos',$currentID) ?>">Step 3 </a>
            <a class="txt-circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/managephotos',$currentID) ?>">Manager photos & Documents</a>
        </li>
        
        <li  <?php if ($action == 'confrimations') echo 'class="active"' ?> >	
            <a class="circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/confrimations',$currentID) ?>"> Step 4</a>
            <a class="txt-circle" href="<?php echo Yii::app()->createAbsoluteUrl('member/listing/confrimations',$currentID) ?>">Confirmations & Preview Summary</a>
        </li>
        
    </ul>
   <?php }else{ ?>
     <ul class="clearfix">
        
        <li <?php if ($action == 'create') echo 'class="active"' ?> >	
            <a class="circle" href="javascript:;">Step 1</a> 
            <a class="txt-circle" href="javascript:;">Basic information</a>
        </li>
        
        <li  <?php if ($action == 'extradetail') echo 'class="active"' ?>  >	
            <a class="circle" href="javascript:;"> Step 2</a>
            <a class="txt-circle" href="javascript:;">Extra details</a>
        </li>
        
        <li  <?php if ($action == 'managephotos') echo 'class="active"' ?> >	
            <a class="circle" href="javascript:;">Step 3 </a>
            <a class="txt-circle" href="javascript:;">Manager photos & Documents</a>
        </li>
        
        <li  <?php if ($action == 'confrimations') echo 'class="active"' ?> >	
            <a class="circle" href="javascript:;"> Step 4</a>
            <a class="txt-circle" href="javascript:;">Confirmations & Preview Summary </a>
        </li>
        
    </ul>   
    
   <?php } ?>
</div>