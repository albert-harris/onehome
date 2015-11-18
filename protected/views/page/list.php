    <?php 
        // Apr 08, 2014 - ANH DUNG
       $selectSortBy = Listing::DEFAULT_SORT_BY;
       if(isset($_GET['sort'])){
            $selectSortBy = $_GET['sort'];
        }
       $selectPageSize = Listing::DEFAULT_ITEM_PERPAGE;
       if(isset($_GET['pageSize'])){
            $selectPageSize = (int)$_GET['pageSize'];
       }
        
       $activeForSale = 'active';
       $activeForRent = '';
       $_GET['listing_for'] = 'for_sale';
       if( $page_id == Pages::PAGE_FOR_RENT ){
           $_GET['listing_for'] = 'for_rent';
            $activeForSale = '';
            $activeForRent = 'active';
       }
       
       $classHideSale = '';
       $classHideRent = '';
       if(isset($_GET['listing_for']) && $_GET['listing_for']=='for_sale'){
           $classHideRent = 'display_none';
           $activeForSale = 'active';
       }elseif(isset($_GET['listing_for']) && $_GET['listing_for']=='for_rent'){
           $classHideSale = 'display_none';
           $activeForRent = 'active';
       }
       
       parse_str($_SERVER['QUERY_STRING'], $output);
       $aVariableRent = array_merge($output, array('listing_type'=>"rent"));
       $currentUrl = "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->requestUri;
       $link_search_for_sale = Yii::app()->createAbsoluteUrl('site/index', $output);
       $link_search_for_rent = Yii::app()->createAbsoluteUrl('site/index', $aVariableRent);
    ?>
    
<!--    <ul class="tabs clearfix">
        <li class="<?php echo $activeForSale.' '.$classHideSale;?>"><a href="<?php echo $link_search_for_sale;?>">For Sale</a></li>
        <li class="<?php echo $activeForRent.' '.$classHideRent;?> "><a href="<?php echo $link_search_for_rent;?>">For Rent</a></li>
    </ul>-->
    
    <div class="action-group tab-content clearfix">
        <label class="lb">Sort By</label>
        <div class="select-1">
            <?php
                echo CHtml::dropDownList('sortBy', $selectSortBy,
                Listing::$SORT_BY, array('class'=>'sortBy'));
            ?>  
        </div>
        <label class="lb">Items per page</label>
        <div class="select-2">
            <?php
                echo CHtml::dropDownList('pageSize', $selectPageSize,
                 Listing::$ITEM_PERPAGE, array('class'=>'pageSize'));
            ?>  
        </div>  
        <div class="pager"><ul></ul></div>
    </div>

    <?php
        $dataProvider = Listing::searchAtIndex();
        $widget = $this->widget('zii.widgets.CListView', array(
            'dataProvider'=> $dataProvider,
            'id'=>'listing-grid',
            'itemView'=>'list_item',
            'viewData'=>array('dataProvider'=>$dataProvider),
            'itemsCssClass'=>'items clearfix',
            'ajaxUpdate'=>false,                                     
            'enablePagination'=>true,
            'pager' => array(
                'maxButtonCount' => 5,
                'header' => false,
                'footer'=> false,
                'prevPageLabel' =>  'Previous',
                'nextPageLabel' =>  'Next',
                'lastPageLabel' => '',
                'firstPageLabel' => '',
                'selectedPageCssClass'=>'active',
//                'htmlOptions'=>array('class'=>'pager')
            ),
            'template'=>'{items}{pager}',
    ));?>

    <div class="action-group clearfix">
        <label class="lb">Sort By</label>
        <div class="select-1">
             <?php
                echo CHtml::dropDownList('sortBy', $selectSortBy,
                Listing::$SORT_BY, array('class'=>'sortBy'));
            ?> 
        </div>
        <label class="lb">Items per page</label>
        <div class="select-2">
            <?php
                echo CHtml::dropDownList('pageSize', $selectPageSize,
                Listing::$ITEM_PERPAGE, array('class'=>'pageSize'));
            ?>    
        </div>  
        <div class="pager"><ul></ul></div>
    </div>



<script type="text/javascript">
    $(document).ready(function(){
        // Xử lý copy pager của yii sang pager html design
        var yiiPager = $('#listing-grid').find('.pager').eq(0);
        var yiiPagerUl = $('#listing-grid').find('.pager').eq(0).find('ul');
        var li_page = yiiPagerUl.html();
        $('.action-group').find('.pager ul').html(li_page);
        yiiPager.hide();
        // Xử lý copy pager của yii sang pager html design
        
        var requestUri = '<?php echo "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->requestUri;?>';
        fnUpdateNextUrl('.pageSize', requestUri, 'pageSize');
        fnUpdateNextUrl('.sortBy', requestUri, 'sort');
        
    });

    $('.shortlist').on('click', function(){
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

