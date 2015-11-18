<?php
/* @var $data ProAgent*/
$link = $this->createUrl('/agent/view', array('slug'=>$data->slug));
$phone = substr($data->phone,0,4).' '.substr($data->phone,4,4);
?>
<?php if($index%4==0): ?>
<div class="row">
<?php endif ?>

<div class="col-md-3 col-sm-6">
	<div class="agent-thumb">
		<div class="image">
			<a href="<?= $link ?>"><?= InputHelper::holderImage($data->getAvatarUrl(278,199), 278, 199)?></a>
			<div class="listing-count"><strong><?= $data->listingCount ?></strong><br/>Listings</div>
			<div class="caption">OneHome's Agent</div>
		</div>

		<div class="desc">
			<div class="row">
				<div class="col-xs-6">
					<h3><a href="<?= $link ?>"><?= $data->name_for_slug ?></a></h3>

					<p><i class="fa fa-phone-square fa-lg"></i>&nbsp;+65&nbsp;
						<?php $this->widget('ShortTextWidget', array(
							'text' => $phone,
							'urlOnCLick' => $this->createUrl('fieldClick', array('id'=>$data->id, 'field'=>'phone'))
						)) ?>
					</p>

					<?php if ($data->email_not_login): ?>
					<p style="white-space: nowrap"><i class="fa fa-envelope-square fa-lg"></i>
						<?php $this->widget('ShortTextWidget', array(
							'text' => $data->email_not_login,
							'urlOnCLick' => $this->createUrl('fieldClick', array('id'=>$data->id, 'field'=>'email'))
						)) ?>
					</p>
					<?php endif ?>
				</div>

				<div class="col-xs-6">
					<p><a href="<?= $link ?>" class="btn btn-orange btn-view">View Details</a></p>
					<p>&nbsp;<i class="fa fa-eye fa-lg"></i>
						&nbsp;&nbsp;<?= (int)$data->view_count ?> views</p>
					<div class="addthis_native_toolbox" data-title="<?= CHtml::encode($data->name_for_slug) ?>"
						 accesskey=""data-url="<?= Yii::app()->createAbsoluteUrl('agent/view', array('slug'=>$data->slug)) ?>"></div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php if($index%4==3 || ($index==($widget->dataProvider->itemCount-1))): ?>
</div>
<?php endif;?>