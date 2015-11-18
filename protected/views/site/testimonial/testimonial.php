<h1 class="title-page">Testimonials</h1>
<!--  main container -->
<div class="main-inner-2">
    <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $data,
                    'itemView' => 'testimonial/_item_testimonial',
                    'itemsTagName' => 'div',
                    'itemsCssClass' => '',
                    'ajaxUpdate' => false,
                    'summaryText' =>'',
//                    'summaryText' => 'Showing {start} - {end} of {count} Testimonial',
                    'template' => '{summary}{pager}<div style="clear:both"></div>{items}<div style="clear:both"></div>{summary}{pager}',
                    'enablePagination' => true,
//                    'pagerCssClass' => 'pagination',
//                    'pager' => array(
//                        'cssFile' => false,
//                        'header' => false,
//                        'previousPageCssClass' => 'hidden',
//                        'nextPageCssClass' => 'hidden',
//                        'firstPageCssClass' => 'hidden',
//                        'lastPageCssClass' => 'hidden',
//                    )
                ));
                ?>
                <style type="text/css">
                    .pager .next > a, .pager .next > span { float: none; height:10px; }
                    .pager .previous > a, .pager .previous > span { float: none }
                    .pager { text-align: right }
                    ul.yiiPager .previous.hidden{display: none}
                    .pager ul li.previous a, .pager ul li.next a{padding: 3px 10px!important}
                </style>

</div>
<!------ads banner----->
 <?php $this->widget('AdsBannerMiddleWidget'); ?> 