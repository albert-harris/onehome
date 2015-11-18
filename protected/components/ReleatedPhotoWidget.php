<?php
class ReleatedPhotoWidget extends CWidget
{
    public $listing_id;
    public $listing_title;
    public $limit =20;
    public $json_releated;
    public $dataJson;
    public $showPhoto;

    public function run()
    {    
        $this->dataJson = array();
        if(!empty($this->json_releated)){
            $data = json_decode($this->json_releated,true);
            if(is_array($data) && count($data)>0) $this->dataJson = $data;
        }
//        if(isset($_GET['f']) && is_numeric($_GET['f'])){
//            $this->showPhoto = $_GET['f'];
//        }
//        
        
        $model = $this->searchReleatedListing();
        $this->render("releated/index",array('model'=>$model ));
    }
    
    
    public function searchReleatedListing() {

        $criteria = new CDbCriteria;
        $criteria->compare('t.property_name_or_address',$this->listing_title,true);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.status_listing', STATUS_LISTING_ACTIVE);
        $criteria->compare('t.id','<>'.$this->listing_id);
        
//        if(!empty($this->showPhoto)){
//            $criteria->with = array('releated');
//            $criteria->order = 'releated.listing_id ASC';
//        }else{
            $criteria->order ='t.date_listed DESC'; //DATE ADMIN APPROVE
//        }
        
        $criteria->limit = $this->limit;
//        return Listing::model()->findAll($criteria);
        
        return new CActiveDataProvider('Listing', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $this->limit,
            ),
        ));
    }
    
    
}