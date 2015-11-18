<?php echo CHtml::form(array('site/search/'),'get'); ?>

<div id="searchBox">
    Search: <?php echo CHtml::textField('keyword',''); ?>
</div>
<?php echo CHtml::endForm(); ?>