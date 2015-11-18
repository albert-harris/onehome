<?php

class AjaxController extends AdminController
{
    public function accessRules()
    {
        return array(
            array('allow',   //allow authenticated user to perform actions
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                    'users'=>array('*'),
            ),            
        );
    }
    public $layout='/layouts/ajax';
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Todo: CompanyEditContact at grid
     * @Param: $id list id 1,2,3 ...
     */
    public function actionCompanyEditContact($id){
    try {
        $model = new Listing();
        $id = $this->FormatListId($id);
        $aModelListing = Listing::GetModelByListId($id);
        if(isset($_POST['Listing']) && is_array($_POST['Listing']['contact_name_no'])){
            Listing::UpdateModelByListId();
            die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("listing-company-grid");</script>'); 
        }
        $this->render('CompanyEditContact', array(
            'model' => $model,  
            'aModelListing' => $aModelListing,
            'actions' => $this->listActionsCanAccess,
        ));
        } catch (Exception $exc) {
            echo $exc->getMessage();
            die();
        }
    }
    
    public function FormatListId($id){
        $id = trim($id, '-');
        return $id = explode('-', $id);
    }
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Todo: CompanyEditContact at grid
     * @Param: $id list id 1,2,3 ...
     */
    public function actionCompanyUpdateDncExpiryDate($id){
        try {
            $id = $this->FormatListId($id);
            $dnc_expiry_date = MyFormat::dateConverDmyToYmdForSeach(isset($_GET['dnc_expiry_date'])?$_GET['dnc_expiry_date']:'');
            if(MyFormat::isValidDate($dnc_expiry_date))
                Listing::UpdateDncExpiryDateByListId($id, $dnc_expiry_date);
        } catch (Exception $ex) {
            echo $exc->getMessage();
            die();
        }
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Todo: CompanyEditContact at grid
     * @Param: $id list id 1,2,3 ...
     */
    public function actionCompanyDeleteListing($id){
        try {
            $id = $this->FormatListId($id);
            Listing::ChangeStatusDeleteByListId($id);
        } catch (Exception $ex) {
            echo $exc->getMessage();
            die();
        }
    }
    
    /**
     * @Author: ANH DUNG Aug 05, 2014
     * @Todo: CompanyEditContact at grid
     * @Param: $id list id 1,2,3 ...
     */
    public function actionCompanyListingMoveto($id){
        try {
            $id = $this->FormatListId($id);
            $company_listing_type = $_GET['company_listing_type'];
            Listing::ChangeTypeByListId($id, $company_listing_type);
        } catch (Exception $ex) {
            echo $exc->getMessage();
            die();
        }
    }
    
    
    // Feb 02, 2015 for delete tenant, landlord, vendor, purcharser
    /**
     * @Author: ANH DUNG Mar 28, 2014
     * @Todo: load model ProTransactionsVendorPurchaserDetail
     * @Param: $id is pk
     * @Return: model
     */
    public function loadModelVendorPurchaserDetail($id, $modelName='ProTransactionsVendorPurchaserDetail'){
    try
    {
        $model_ = call_user_func(array($modelName, 'model'));
        $model = $model_->findByPk($id);
        if($model===null)
        {
            Yii::log("The requested page does not exist.");
            throw new CHttpException(404,'The requested page does not exist.');
        }			
        return $model;
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    public function actionDeleteVendorPurchaser($id)
    {
        try
        {
            if(Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                if($model = $this->loadModelVendorPurchaserDetail($id))
                {
//                    $model->need_delete = 1;
//                    $model->update(array('need_delete'));
                    if($model->delete())
                        Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                }
            }
            else
            {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
            }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    // Feb 02, 2015 for delete tenant, landlord, vendor, purcharser
	public function actionRemoveModelImage($class, $field, $id) {
		$model = $class::model()->findByPk($id);
		if (!$model) die('0');
		
		$file = sprintf('%s/%s/%s/%s', Yii::getPathOfAlias('webroot'), $class::$folderUpload, $model->id, $model->$field);
		if (is_file($file))
			unlink($file);
		$model->$field = null;
		echo $model->update($field);
	}
    
}