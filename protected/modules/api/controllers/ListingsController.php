<?php
class ListingsController extends ApiController
{   
    public function actionIndex()
    {
        //===================all api that require login have the same=================
        $result = ApiModule::$defaultResponse;
        $this->checkRequest();        
        $q = $this->q;
        $this->checkRequiredParams($q, array('token','page'));
        $this->checkToken();//same as login session
        //==================
        //CODE HERE

        // $page = isset($q->page) ? $q->page : NULL;
        // $keyword = !empty($q->keyword) ? $q->keyword : '';
        // $type = !empty($q->type) ? $q->type : NULL;
        // $category_id = !empty($q->category_id) ? $q->category_id : NULL;
        // $time = !empty($q->time) ? $q->time : NULL;

        //===========sample response===========
        $result = ApiModule::$defaultSuccessResponse;        
        $result['message'] = Yii::t('systemmsg','OK type your message here');//always need
        // $result['list'] = Stores::model()->getMerchantForShopAPI($page, $keyword, $type, $category_id, $time, $result);
        ApiModule::sendResponse($result); 
    }
    
	public function actionSearch() {
		$this->checkRequest();        
		$q = $this->q;
		$this->checkRequiredParams($q, array('token', 'user_id', 'status', 'type', 'page'));
		$this->checkToken();//same as login session

		$criteria = new CDbCriteria;
        $criteria->compare('user_id', $q->user_id);
        $criteria->compare('status_listing', $q->status);
        $criteria->compare('listing_type', $q->type);
		$criteria->limit = 20;
		$criteria->order = 'property_name_or_address ASC';
		$models = Listing::model()->findAll($criteria);
		$items = array();
		foreach ($models as $model) {
			$items[] = array(
				'property_name_or_address' => $model->property_name_or_address,
				'tenure' => Listing::getViewDetailTenure($model),
			);
		}

		$result = ApiModule::$defaultSuccessResponse;        
		$result['list'] = $items;
		$result['message'] = Yii::t('systemmsg','Query success');//always need
		ApiModule::sendResponse($result); 
 	}
	
}
