<?php

/* Author : Pham Duy Toan 
 * Email :ghostkissboy12@gmail.com and open the template in the editor.
 */
?>
<?php include_once '_step.php'; ?>
<?php

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'pages-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'ad_form_sort_photo',
    ),
        ));
?>
<?php echo $this->renderPartial("step/$view", array(
    'model' => $model,     
    'form' => $form, 'arrOrther' => (isset($arrOrther)) ? $arrOrther : null)); ?>
<?php $this->endWidget(); ?>
<script>
    $(document).ready(function(){
        $('#pages-form').find('input:submit').click(function(){
            $.blockUI({ message: null });
        });
    });
</script>