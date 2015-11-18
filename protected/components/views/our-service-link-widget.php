<?php
/* @var $categories OurService[] */
/* @var $this OurServiceLinkWidget */
?>
<?php foreach($categories as $category): ?>
	<section class="links">
		<h5 class="<?= $this->getCssClass($category)?>">
			<a href="<?php echo Yii::app()->createAbsoluteUrl('site/ourServices', array('slug'=>$category->slug)) ?>"
			><?= $category->name ?></a>
		</h5>
		<?php if ($category->childs): ?>
		<ul class="list-unstyled orange collapse <?php if ($this->isItemActive($category)) echo 'in' ?>">
			<?php foreach($category->childs as $child): ?>
			<li>
				<?php if ($this->isItemActive($child)): ?>
				<span><?= $child->name ?></span>
				<?php else: ?>
				<a href="<?php echo Yii::app()->createAbsoluteUrl('site/ourServices', array('slug'=>$child->slug)) ?>"
				    ><?= $child->name ?></a>
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
		<?php endif ?>
	</section>
<?php endforeach; ?>
