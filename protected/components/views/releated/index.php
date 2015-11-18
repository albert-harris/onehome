<?php
/*
 * DTOAN
 * Email : toan.pd@verzdesign.com.sg
 */
?>

<div id="Listing-releated" class="clearfix">
    <?php
    $widget = $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $model,
        'emptyText' => '<div class="item-releated"></div>',
        'id' => 'releatedListing',
        'itemView' => 'releated/_item_view',
        'pagerCssClass' => 'pager_appoitment',
        'template' => '{items} <div class="action-group clearfix clear"> <div class="pager f-right">{pager}</div></div>',
        'ajaxUpdate' => true,
        'ajaxUrl' => Yii::app()->request->getUrl(),
        'enablePagination' => true,
        'pager' => array(
            'header' => '',
            'cssFile' => false,
            'prevPageLabel' => 'Previous',
            'nextPageLabel' => 'Next',
            'lastPageLabel' => '',
            'firstPageLabel' => '',
            'selectedPageCssClass' => 'active',
            'htmlOptions' => array(
                'class' => 'listing_manager'
            )
        ),
    ));
    ?>   
</div>
<style>
    #Listing-releated {min-height: 150px;clear:both;}
    #Listing-releated .item-releated { float:left;width:127px;min-height: 96px;margin-right:15px;}
    #Listing-releated .item-releated .img  {height: 96px;width:120px;text-align: center;}
    #Listing-releated .item-releated  input {float:left;}
</style>
<?php
Yii::app()->clientScript->registerScript('search', "
        $('.checkphoto-releated').on('click',function(){
        var url = '" . Yii::app()->createAbsoluteUrl('ajax/CheckPhoto') . "';   
        var check  = 0;
        if($(this).attr('checked')=='checked') check=1;
            $.ajax({
                url: url +'/id/" . $this->listing_id . "'+'/releated/'+$(this).val()+'/checkitem/'+check ,
                type: 'GET',
                data: {takeOff:$('#request_take_off').val() },
            });
        })
"
);
?>
