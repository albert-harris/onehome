<?php $this->beginContent('/layouts/main'); ?>
<div id="content">
    <?php if ($this->menu):?>
    <div id="control" class="control-nav">
	<?php
	$arr = array();
	foreach ($this->menu as $k => $val) {
	    $arr[] = $val;
            $moreClass=isset($val['moreClass'])?$val['moreClass']:'';// ANH DUNG Apr 22, 2014
	    $arr[$k]['itemOptions'] = array('class' => "btn $moreClass",
                                                'title' => $val['label'],
                                                //'title'=>$val['url'][0],	
                                            );
	    if ($val['url'][0] == 'index') $val['url'][0] = 'Manager';
            
//	    if ($val['label'] == 'Create Banner')
//		$arr[$k]['label'] = ' Create Homepage Banner'; 
//	    else
//		$arr[$k]['label'] = ucfirst($val['url'][0]); 
            if(isset($val['customLabel']))$arr[$k]['label'] = ucfirst($val['customLabel']); 
	}

	$this->beginWidget('zii.widgets.CPortlet', array(
		//'title'=>'Operations',
	));

	$this->widget('ext.CMenu.CMenu', array(
	    'items' => $arr,
	    'linkLabelWrapper' => 'span',
	));

	$this->endWidget();
	?>
    </div>
    <?php endif; ?>
    <?php echo $content; ?>
</div><!-- content -->

<?php $this->endContent(); ?>

