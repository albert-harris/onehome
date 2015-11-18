<div class="btn-group">
    <div class="radius" style="margin-left:160px;" >

    <?php
        $action = Yii::app()->controller->action->id; 
        $currentID = array();
        if(isset($_GET['id'])&& is_numeric($_GET['id'])){
            $currentID = array('id'=>$_GET['id']);
    ?>
    
    
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
            'buttons'=>array(
                array('label'=>'Step 1 [ Basic information ]', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing/create',$currentID),'active'=>($action=='create') ? true : false),
                array('label'=>'Step 2 [ Extra details ]', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing/extradetail',$currentID),'active'=>($action=='extradetail') ? true : false),
                array('label'=>'Step 3 [ Manager photos & Documents ]', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing/managephotos',$currentID),'active'=>($action=='managephotos') ? true : false),
                array('label'=>'Step 4 [ Confirmations & Preview Summary ]', 'url'=>Yii::app()->createAbsoluteUrl('admin/listing/confrimations',$currentID),'active'=>($action=='confrimations') ? true : false),
            ),
        )); 
    ?>

   <?php }else{ ?>
    
    
    
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
            'buttons'=>array(
                array('label'=>'Step 1 [ Basic information ]', 'url'=>'#','active'=>($action=='create') ? true : false),
                array('label'=>'Step 2 [ Extra details ]', 'url'=>'#'),
                array('label'=>'Step 3 [ Manager photos & Documents ]','url'=>'#'),
                array('label'=>'Step 4 [ Confirmations & Preview Summary ]','url'=>'#'),
            ),
        )); 
    ?>

    
   <?php } ?>
    </div>
</div>