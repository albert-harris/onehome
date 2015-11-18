<?php
class ListingReleatedOnPageThankYouWidget extends CWidget
{
    public $listing_id;
    public $listing_title;
    public $limit =2;

    public function run()
    {    
        $listingInfo = Listing::model()->findByPk($this->listing_id);
        if($listingInfo) $this->listing_title = $listingInfo->property_name_or_address;
      
        $model = $this->searchReleatedListing();
        $this->render("listing_releated_page_thank_you/index",array('model'=>$model ));
    }
    
    
    public function searchReleatedListing() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.property_name_or_address',$this->listing_title,true);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
        $criteria->compare('t.id','<>'.$this->listing_id);
        $criteria->limit = $this->limit;
        return new CActiveDataProvider('Listing', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $this->limit,
            ),
        ));
    }
    
    
}