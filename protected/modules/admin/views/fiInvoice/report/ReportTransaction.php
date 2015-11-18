<?php
$this->breadcrumbs=array(
	'Report',
);
?>
<?php echo $this->renderPartial('_tab_index',array('model'=>$model) ); ?>

<h1>Report Financial</h1>

<div class="search-form">
<?php $this->renderPartial('_search_report',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<script>
    $(function(){
        
    });
    
</script>