<div class="interested-wrap clearfix">
    <p class="title-1">We also thought you might be interested in viewing these listings:</p>
    <div class="main-inner">
        <div class="grid">
            <?php
                $this->widget('zii.widgets.CListView', array(
                    'id' => 'short_list',
                    'dataProvider' => $model,
//                    'emptyText'=>'<div style="margin-left:15px;">No results found.<div>', 
                    'ajaxUpdate' => false,
                    'itemView' => 'listing_releated_page_thank_you/_item_view',
                    'itemsCssClass' => false,
                    'enablePagination' => true,
                    'pagerCssClass' => 'pagination',
                    'template'=>'{items}',
                    'pager' => array(
                        'cssFile' => false,
                        'header' => false,
                        'firstPageCssClass' => 'hidden',
                        'lastPageCssClass' => 'hidden',
                    )
                ));
            ?>

        </div>
    </div>
    <aside class="sidebar">
         <?php $this->widget('AdsBannerMiddleWidget'); ?>   
        <!--<div class="bn-advers-2"><a href="#"><img alt="image" src="img/bn-ads-2.jpg"></a></div>-->
    </aside>
</div>