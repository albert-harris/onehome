<?php $cAction = strtolower(Yii::app()->controller->action->id);
    $textH = "Other Listings In $name";
    if($cAction == 'salesperson_listing'){
        $textH = "Other Listings Of $name";
    }
?>
<div class="main-inner">
    <h1><?php echo $textH; ?></h1>
    <?php
        $selectSortBy = Listing::DEFAULT_SORT_BY;
        if(isset($_GET['sort'])){
             $selectSortBy = $_GET['sort'];
        }
        $selectPageSize = Listing::DEFAULT_ITEM_PERPAGE;
        if(isset($_GET['pageSize']) && $_GET['pageSize']>=$selectPageSize){
             $selectPageSize = (int)$_GET['pageSize'];
        }
        $dataProvider = $model;
        $widget = $this->widget('zii.widgets.CListView', array(
            'dataProvider'=> $dataProvider,
            'id'=>'listing-grid',
            'itemView'=>'listing/list_item',
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
<!--  aside -->
</div>
<aside class="sidebar">

    <!-- box -->
    <?php $this->widget('PropertySearch'); ?>
</aside>
