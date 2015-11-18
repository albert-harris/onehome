<?php
/* @var $this AgentController */
/* @var $model ProAgent*/
?>
<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->searchAgent(),
	'itemView'=>'_agent-item',
	'pagerCssClass' => 'pag-container',
	'template' => '{pager}{items}{pager}',
	'afterAjaxUpdate' => 'function () { window.addthis.layers.refresh(); }',
	'pager' => array(
		'header' => '',
	),
));
?>