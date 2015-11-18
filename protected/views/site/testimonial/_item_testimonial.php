<?php $cmsFormater = new CmsFormatter(); ?>
<div class="testimonial">
    <blockquote class="<?php echo ($index%2==0) ? 'test-blue'  : 'test-orange'?>">
        <?php echo $data->description; ?>
        <span class="<?php echo ($index%2==0) ? 'tesr-row-blue'  : 'tesr-row-orange'?> "></span>
    </blockquote>
    <p class="author">
        <cite><?php echo $data->name; ?></cite>
        <?php echo $cmsFormater->formatTestimonialType($data); ?>
    </p>
</div>