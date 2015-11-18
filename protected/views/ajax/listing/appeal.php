<style>
    .classTextArea { width:580px !important;max-height:135px;min-height: 135px;overflow-y: scroll;}
    .classBtn {float:right; margin-top: 30px;}
  body{min-width: 0px;}
  .clearfix {width:100% !important;}
  .items {min-width: 580px;}
  .btn-2 {border:none;}
</style>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'AgentPurchaser-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
        )
);
?>
<div style="width:100%;">
    <h1 class="title-page">APPEAL FORM OF <?php echo $model->property_name_or_address; ?></h1>

    <div class="in-row clearfix" >
        <?php echo $form->labelEx($model, 'remark_rejected', array('class' => 'lb')); ?>
        <div class="group-4">
            <?php echo $form->textArea($model, 'remark_rejected', array('class' => 'text w-3 classTextArea')); ?>
            <?php echo $form->error($model, 'remark_rejected'); ?>
        </div>
    </div>
    
    <?php if(empty($role_id)): ?>
    <div class="in-row clearfix">
        <?php echo $form->labelEx($model, 'file', array('class' => 'lb')); ?>
        <div class="group-4">
            <?php
            $this->widget('CMultiFileUpload', array(
                'model' => $model,
                'attribute' => 'file',
                'accept' => "pdf,doc,docx,xls,xlsx,txt",
                'denied' => 'File is not allowed',
                'max' => 10,
                'htmlOptions' => array(
                    'class' => 'text'
                )
            ));
            ?>
        </div>
        <?php echo $form->error($model, 'file'); ?>
        <input style="float:right;" type="submit" class="btn-3 classBtn" value="Submit" />
    </div>
    
<?php endif; ?>
    
    <?php
//       $dataProvider->getTotalItemCount(); 
//       $dataProvider->itemCount; 
        
        if(!empty($appeal)>0){
             $dataProvider = $appeal->search();
             if($dataProvider->itemCount>0){
             
                $this->widget('zii.widgets.grid.CGridView', array(
                  'id' => 'sr-resume-request-grid',
                  'dataProvider' => $dataProvider,
                  //'filter'=>$model,
                  'enableSorting' => false,
                  'htmlOptions'=>array(
                      'class'=>'tb-1',
                       'style'=>'min-width:500px;'
                      
                  ),
                    'summaryText'=>'',
                  'columns' => array(
                        array(
                            'header' => 'S/N',
                            'type' => 'raw',
                            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                            'headerHtmlOptions' => array('width' => '30px', 'style' => 'text-align:center;'),
                            'htmlOptions' => array('style' => 'text-align:center;')
                        ),
                        array(
                            'name'=>'Files Download',
//                            'value'=>'$data->file',
                            'type' => 'raw',
                            'value'=>  'CHtml::link($data->file_name,Yii::app()->createAbsoluteUrl("upload/listing/".$data->listing_id."/appeal/".$data->file),array("target"=>"_blank" ))'
                        ),
//                        array(
//                            'name'=>'Date upload',
//                            'value'=>'date("d-M-Y",strtotime($data->created_date))'
//                        ),
                        array(
                            'class' => 'ButtonColumn',
                            'header' => 'Actions',
                            'template' => '{delete}',
                            'headerHtmlOptions' => array('class' => 'last', 'style' => 'width:70px;text-align:center;'),
                            'buttons' => array(
                                'delete' => array
                                    (
                                    'label'=>'Remove',
//                                    'imageUrl'=>'',
                                    'url' => 'Yii::app()->createAbsoluteUrl("ajax/deleteappeal", array("id"=>$data->id))',
                                    'options' => array('style'=>'text-align:center;'),
                                ),
                            ),
                        ),                   
                      
                  ),
              ));  
            }
        }


    ?>   
    
</div>
<?php $this->endWidget(); ?>