<?php
/* @var $this AgentCOntroller */
/* @var $model ProAgent*/

$this->breadcrumbs[] = 'Our Team';
Yii::app()->clientScript->registerScript('agent-index', "setupOurteamPage()");
// add this button
Yii::app()->clientScript->registerScriptFile(
	"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56133df5326f44f0", 
	CClientScript::POS_END, array('async'=>'async')
);
?>

<p style="font-size: 18px">Onehome Property Pte Ltd</p> 
<p style="font-size: 18px">(Real Estate Agents License Number : L3010619I)</p>

<br/>
<br/>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agent-search-form',
	'enableClientValidation'=>false,
	'method'=>'get',
	'htmlOptions'=>array('class'=>'agent-search row')
)); ?>
    <label class="col-sm-3 text-right" for="key">Search By Agent Name or Agent Phone number : </label>
	<div class="col-sm-7 form-group">
		<?php echo $form->textField($model, 'key', array(
			'class'=>'form-control', 
			'placeholder'=>'Enter text...',
			'name'=>'key'
		)) ?>
	</div>
	<div class="col-sm-2 form-group"><button type="submit" class="btn btn-orange btn-search">Search</button></div>
<?php $this->endWidget(); ?>		

<p class="text-center agent-search-summary hide"><strong><span class="total">0</span> Agents Found</strong></p>

<p class="sort-by">Sort by : 
	<a href="<?= $this->createUrl('index', array('sort'=>'name')) ?>"
	   class="sort-link">Name</a>
	| <a href="<?= $this->createUrl('index', array('sort'=>'listing')) ?>"
		class="sort-link">Listings</a></p>

<div class="agent-list">
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
</div>

<p class="sort-by">Sort by : 
	<a href="<?= $this->createUrl('index', array('sort'=>'name')) ?>"
	   class="sort-link">Name</a>
	| <a href="<?= $this->createUrl('index', array('sort'=>'listing')) ?>"
		class="sort-link">Listings</a></p>
		
<style>
.pag-container {
  margin-bottom: 20px;
  text-align: right;
}
</style>