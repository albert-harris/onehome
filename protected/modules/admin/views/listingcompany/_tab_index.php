
<div class="wide form">
     <div class="row">
        <!--<label>List:</label>-->
        <?php 
        $this->widget('bootstrap.widgets.TbButtonGroup', array(
            'buttons'=>array(
                array('label'=>'Immediate Listing', 
                    'url'=>Yii::app()->createAbsoluteUrl('admin/listingcompany/index',array('company_listing_type'=> Listing::COMPANY_IMMEDIATE)),
                    'active'=>($current_company_listing_type=='' || $current_company_listing_type ==Listing::COMPANY_IMMEDIATE ) ? true : false),
                
                array('label'=>'Follow up Listing', 
                    'url'=>Yii::app()->createAbsoluteUrl('admin/listingcompany/index',array('company_listing_type'=>Listing::COMPANY_FOLLOW_UP)),
                    'active'=>($current_company_listing_type ==Listing::COMPANY_FOLLOW_UP) ? true : false),
            ),
        )); 
    ?>   
    </div>
</div> <!-- end wide form -->

<h1 class="l_padding_20">Company Listings Management - <?php echo $HeadTitle;?></h1>