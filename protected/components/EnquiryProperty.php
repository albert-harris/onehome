<?php
class EnquiryProperty extends CWidget
{
    public $position;
    public $property_id;
    public $agent_id = NULL;
    public $dir ;

    public function run() {
        $box = Pages::getPageById(PAGE_PROPERTY_BOX);
        $model = new ProEnquiryProperty();
        $mListing = Listing::model()->findByPk($this->property_id);;
//        echo $mListing->property_name_or_address;die;
        Listing::ReplaceContentCmsPage($box, $mListing);
        $model->country_id = ActiveRecord::getDefaultAreaCode();
        if(isset(Yii::app()->user->id)){
            $model->name = Yii::app()->user->title . ' ' .Yii::app()->user->first_name . ' '.Yii::app()->user->last_name;
            $model->email = Yii::app()->user->email;
            if(Yii::app()->user->role_id != ROLE_REGISTER_MEMBER){
                 $model->email = Yii::app()->user->email_not_login;
            }
            $model->phone = Yii::app()->user->phone;
            $model->country_id = Yii::app()->user->country ;
        }
         $this->dir = Yii::getPathOfAlias('application.components.views') .'/_agent_detail.php';

        
        
		$model->description = trim(strip_tags($box->content));
        if($this->position == "bottom")
            $this->render("enquiry_bottom", array(
                'model'=>$model,
                'box'=> $box,
                'property_id'=>$this->property_id,
                'agent_id'=>  $this->agent_id,
                'dir'=>$this->dir,
                'position'=>'bottom'
            ));
        else
            $this->render("enquiry_right", array(
                'model'=>$model,
                'box'=> $box,
                'property_id'=>$this->property_id,
                'agent_id'=>  $this->agent_id,
                'dir'=>$this->dir,
                'position'=>'right'
            ));
	}
}

?>