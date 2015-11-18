<?php
/* @var array $topics */
/* @var array $forums */
?>
<div class="latest-topics">
	<h3>LATEST TOPICS</h3>
	<div class="content">
		<ul class="items list-unstyled">
			<?php foreach ($topics as $topic): ?>
			<li><a href="<?= $topic['link'] ?>" target="_blank"><?= $topic['title'] ?></a></li>
			<?php endforeach ?>
		</ul>
		<div class="text-right">
			<a href="<?= Yii::app()->params['forumUrl'] ?>" class="btn">
				VIEW MORE&nbsp;&nbsp;<i class="fa fa-search fa-lg"></i>
			</a>
		</div>
	</div>
</div>

<div class="latest-forums">
<?php foreach ($forums as $index => $forum): ?>
	<?php if($index%4==0): ?>
	<div class="row">
	<?php endif ?>

	<div class="col-md-3">
		<div class="item">
			<h4><?= $forum['name'] ?></h4>
			<div style="padding: 10px">
				<p class="image"><?= InputHelper::holderImage($forum['image'], 258, 141) ?></p>
				<p><?= $forum['desc'] ?></p>
			</div>
			<a href="<?= $forum['link'] ?>" target="_blank" class="read-more">READ MORE</a>
		</div>
	</div>

	<?php if($index%4==3 || ($index==(count($forums)-1))): ?>
	</div>
	<?php endif;?>
<?php endforeach ?>	
</div>
<style>
.latest-topics {
	margin-bottom: 30px;
}

.latest-topics h3 {
  background-color: #f36421;
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
  color: #fff;
  display: inline-block;
  font-size: 14px;
  font-weight: bold;
  margin: 0 15px;
  padding: 15px;
}

.latest-topics .content {
  background-color: #f36421;
  background-image: url("<?= Yii::app()->getBaseUrl(true) ?>/themes/onehome/img/bg-city.jpg");
  background-position: center bottom;
  background-repeat: repeat-x;
  border-radius: 4px;
  padding: 15px;
}

.latest-topics .items {
  background-color: #fff;
  border-radius: 4px;
}

.latest-topics .items li:nth-child(even) {
	background: #e3e3e3
}

.latest-topics .items a {
  color: #1e1e1e;
  display: block;
  line-height: 40px;
  padding-left: 20px;
}

.latest-topics .items li:hover a {
	font-weight: bold;
}

.latest-topics .btn {
  background-color: #fff;
  color: #f36421;
  font-weight: bold;
  padding: 11px 13px;
}

.latest-forums .item {
  border: 1px solid #ccc;
  border-radius: 4px;
}

.latest-forums h4 {
  background-color: #8bc63e;
  color: #fff;
  font-size: 14px;
  margin: 0;
  padding: 13px 18px;
}

.latest-forums .image img {
  border-radius: 4px;
  margin: 0 auto;
}

.latest-forums .item .read-more {
  background-color: #d9d9d9;
  color: #575757;
  display: block;
  font-size: 11px;
  padding: 15px 0;
  text-align: center;
}
</style>