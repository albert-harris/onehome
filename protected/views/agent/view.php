<?php
/* @var $model ProAgent */
/* @var $this AgentController */
$this->breadcrumbs = array(
	'Our Team' => array('index'),
	$model->name_for_slug
);
$phone = substr($model->phone,0,4).' '.substr($model->phone,4,4);
// add this button
Yii::app()->clientScript->registerScriptFile(
	"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56133df5326f44f0", 
	CClientScript::POS_END, array('async'=>'async')
);
?>
<div class="agent-detail">
	<div class="row" style="margin-bottom: 30px">
		<div class="col-sm-5">
			<div class="image">
				<?= InputHelper::holderImage($model->getAvatarUrl(286,286), 286, 286)?>
				<div class="listing-count"><strong><?= $model->listingCount ?></strong><br/>Listings</div>
				<div class="caption">OneHome's Agent</div>
			</div>
		</div>
		<div class="col-sm-7">
			<h3 class="agent-title"><?= $model->name_for_slug ?></h3>
			<p style="color: #aaa9b7">CEA Reg No: <span class="cea"><?= $model->agent_cea ?></span></p>
			<br/>
			<br/>
			<br/>
			<br/>
			<p class="phone"><i class="fa fa-phone-square fa-lg"></i>&nbsp;+65&nbsp;
				<?php $this->widget('ShortTextWidget', array(
					'text' => $phone,
					'urlOnCLick' => $this->createUrl('fieldClick', array('id'=>$model->id, 'field'=>'phone'))
				)) ?>
			</p>

			<?php if ($model->email_not_login): ?>
			<p class="email"><i class="fa fa-envelope-square fa-lg"></i>&nbsp;
				<?php $this->widget('ShortTextWidget', array(
					'text' => $model->email_not_login,
					'urlOnCLick' => $this->createUrl('fieldClick', array('id'=>$model->id, 'field'=>'email'))
				)) ?>
			</p>
			<?php endif ?>
			
			<div style="font-size:14px">
				<div class="row">
					<div class="col-sm-4 col-xs-6">
						&nbsp;<i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;
						<?= (int)$model->view_count ?> views</div>
					<div class="col-sm-8 col-xs-6">
						<div class="addthis_native_toolbox" data-title="<?= CHtml::encode($model->name_for_slug) ?>"
							 data-url="<?= Yii::app()->createAbsoluteUrl('agent/view', array('slug'=>$model->slug)) ?>"></div>
					</div>
				</div>
			</div>
		</div>
	</div>	

	<div class="green-tab agent-tab">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="<?= $this->getTabCssClass('agent') ?>"><a href="#profile" class="" 
				aria-controls="home" role="tab" data-toggle="tab">Profile</a>
			</li>
			<li role="presentation" class="<?= $this->getTabCssClass('listing') ?>"><a href="#listing" class=""
				aria-controls="profile" role="tab" data-toggle="tab">Listing</a>
			</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane profile-tab <?= $this->getTabCssClass('agent') ?>" id="profile">
				<h4>Agent Details</h4>
				<?php $sections = array(
					'Introduction' => $model->introduction,
					'Qualifications' => $model->qualification,
					'Experience' => $model->experience,
				);
				$s = trim(strip_tags(implode($sections)));
				?>
				<?php if ($s): // check if all field is empty ?>
					<?php foreach($sections as $label => $content): ?>
						<?php
						$t = trim(strip_tags($content)); 
						if (!$t) continue;
						?>
						<section class="<?= strtolower($label) ?>">
							<h5><?= $label ?></h5>
							<div class="content"><?= $content ?></div>
						</section>
					<?php endforeach; ?>
				<?php else: ?>
				<p><em>Profile is not available yet.</em></p>
				<?php endif ?>
			</div>
			<div role="tabpanel" class="tab-pane listing-tab <?= $this->getTabCssClass('listing') ?>" id="listing">
				<?php $this->widget('ListingWidget', array(
					'dataProvider' => $model->getListingsDataProvider(),
					'showTypeFilter' => true
				)); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$('.agent-detail').on('click', '.shortlist', function(){
	var user_id = '<?php echo Yii::app()->user->id; ?>';
	var role_id = '<?php echo Yii::app()->user->role_id; ?>';
	var role_member = '<?php echo ROLE_REGISTER_MEMBER; ?>';
	if (user_id && role_id === role_member) {
		var listing_id = $(this).data('listing-id');
		var params = {};
		params["listing_id"] = listing_id;
		var url = '<?php echo Yii::app()->createAbsoluteUrl('site/addShortlist'); ?>';
		$.ajax({
			url: url,
			data:params,
			type:'POST',
			dataType : 'JSON',
			success : function(data) {
				alert(data.message);
			},
			error: function() {
				alert(data.message);
			}
		});
	}
	else{
		window.location = $(this).attr('next');
	}
})
</script>