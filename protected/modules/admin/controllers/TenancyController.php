<?php

class TenancyController extends AdminController
{

    /**
     * @Author: ANH DUNG Jul 29, 2014
     * @Todo: TENANCIES MANAGEMENT
     */       
    public function actionTenancies_new(){
//        Listing::UpdateIdAdminCreateCompanylisting();
        $this->pageTitle = "Tenancies New - ".Yii::app()->params['title'];
        $model = new ProTransactions();
        $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProTransactions']))
                    $model->attributes=$_GET['ProTransactions'];
        $this->render('Tenancies_new',array(
            'model'=>$model,
            'actions' => $this->listActionsCanAccess,
        ));
    }
    
    /**
     * @Author: ANH DUNG Jan 13, 2015
     * @Todo: TENANCIES DRAFT MANAGEMENT
     */       
    public function actionTenancies_draft(){
        $this->pageTitle = "Tenancies draft - ".Yii::app()->params['title'];
        $model = new ProTransactions();
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ProTransactions']))
                $model->attributes=$_GET['ProTransactions'];
        $this->render('Tenancies_draft',array(
            'model'=>$model,
            'actions' => $this->listActionsCanAccess,
        ));                
    }    
        
    /**
     * @Author: ANH DUNG Dec 02, 2014
     * @Todo: TENANCIES approve status
     */       
    public function actionApproveTenancy($id){
        $model = $this->loadModel($id);
        $this->layout='ajax';
        $model->scenario = "ApproveTenancy";
        if(isset($_POST['ProTransactions'])){
            $model->attributes=$_POST['ProTransactions'];
            $model->validate();
            if( !$model->hasErrors() ){
                if( $model->status == STATUS_TENANCY_APPROVE ){
                    ProTransactions::UpdateTenancyStatus($model, $model->status);
                }
                die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("pro-transactions-grid");</script>'); 
            }
        }
        $this->render('ApproveTenancy',array(
            'model'=>$model,
            'actions' => $this->listActionsCanAccess,
        ));
    }    
    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
            try{
            $this->render('view',array(
                    'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));     
            }

    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
//	public function actionCreate()
//	{
//                try
//                {
//		$model=new ProTransactions('create');
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['ProTransactions']))
//		{
//			$model->attributes=$_POST['ProTransactions'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
//		}
//
//		$this->render('create',array(
//			'model'=>$model, 'actions' => $this->listActionsCanAccess,
//		));
//                }
//                catch (Exception $e)
//                {
//                    Yii::log("Exception ".  print_r($e, true), 'error');
//                    throw  new CHttpException("Exception ".  print_r($e, true));     
//                }
//	}
//
//	/**
//	 * Updates a particular model.
//	 * If update is successful, the browser will be redirected to the 'view' page.
//	 * @param integer $id the ID of the model to be updated
//	 */
//	public function actionUpdate($id)
//	{
//                try
//                {
//		$model=$this->loadModel($id);
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['ProTransactions']))
//		{
//			$model->attributes=$_POST['ProTransactions'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
//		}
//
//		$this->render('update',array(
//			'model'=>$model, 'actions' => $this->listActionsCanAccess,
//		));
//                }
//                catch (Exception $e)
//                {
//                    Yii::log("Exception ".  print_r($e, true), 'error');
//                    throw  new CHttpException("Exception ".  print_r($e, true));     
//                }
//	}

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
            try
            {
            if(Yii::app()->request->isPostRequest)
            {
                    // we only allow deletion via POST request
                    if($model = $this->loadModel($id))
                    {
                        if($model->delete())
                            Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                    }

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
                throw new CHttpException(400,$e->getMessage());
            }
    }
    
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDeleteApproved($id)
    {
        try
        {
            if(Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                if($model = $this->loadModel($id))
                {
                    if($model->deleteApproved())
                        Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                }

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
            throw new CHttpException(400,$e->getMessage());
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        try
        {
            $this->pageTitle = "Tenancies - ".Yii::app()->params['title'];
            $model = new ProTransactions();
            $model->unsetAttributes();  // clear any default values
                if(isset($_GET['ProTransactions']))
                        $model->attributes=$_GET['ProTransactions'];
            $this->render('index',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
            try
            {
            $model=ProTransactions::model()->findByPk($id);
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

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        try
        {
        if(isset($_POST['ajax']) && $_POST['ajax']==='pro-transactions-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
        
        
    /**
     * @Author: ANH DUNG Jan 02, 2015
     * @Todo: Create Tenancy 
     * @param: $add_property: 1: ADD_EXISTING, 2: ADD_UNLISTED
     */
    public function actionCreateTenancy($add_property) {
        $this->pageTitle = "Record existing tenancy - ".Yii::app()->params['title'];
        try {
//            $mUser = Users::model()->findByPk(Yii::app()->user->id);
//            $mUser = new Users();
            $mTransactions = new ProTransactions();
            if(isset($_GET['user_id'])){ // Jan 02, 2014 For backend                
                $type = ProTransactions::FOR_RENT;
                $listing_id = 0;
                if(isset($_GET['listing_id'])){
                    $listing_id = $_GET['listing_id'];
                }
                // handle create new 
                if(!isset($_GET['id'])){
                    $needMore      = array('user_id'=>$_GET['user_id']);
                    $mTransactions = ProTransactions::CreateNewRecordTransaction($type, $listing_id, $needMore);
                    $this->redirect( array('createTenancy',
                        'add_property'=> $add_property,
                        'id'=>$mTransactions->id, // id transaction
                        'type'=>$type, // type rent, sale
                        'listing_id' => $listing_id, // id listing                        
                        'user_id'=> $mTransactions->user_id,
                    ));
                }else{
                    $mTransactions = ProTransactions::getByPk($_GET['id']);
                }
//                $this->ValidateLinkRecord($add_property, $listing_id); // OPEN IT
                ProTransactions::GetSomeInfoRecord($mTransactions, $add_property);
                ProTransactions::HandlePost($mTransactions);
            }
            
            $this->render('record/record_existing_tenancy',array(
//                'mUser'=>$mUser,
                'mTransactions'=>$mTransactions,
                'actions' => $this->listActionsCanAccess,
        ));
            
        } catch (Exception $exc) {            
//            echo $exc->getMessage();
            throw new CHttpException(404, 'Invalid Request');
        }
    }
    
    
            
    
    
    /** Jan 22, 2015 
     * 3. Move Inventory Photo
     */
    
    /**
     * @Author: ANH DUNG Aug 20, 2014
     * @Todo: view Inventory Photo of tenancies
     */
    public function actionInventoryPhoto($id)
    {
        try{
        $this->AjaxRemoveFileAll();
        $transaction_id = $id;
        $model = new ProInventoryPhoto();
        $model->transaction_id = $id;
        $aModelPhoto = ProInventoryPhoto::GetByUidAndTransactionId(0, $transaction_id);
        $this->render('InventoryPhoto/InventoryPhoto',array(
            'model'=>$model,
            'aModelPhoto'=>$aModelPhoto,
            'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
        
    /**
     * @Author: ANH DUNG Jul 25, 2014
     * @Todo: remove inventory photo
     * @Param: $id 
     * @note: cùng chức năng với actionAjaxRemoveFileAll ở EnquiryController ngoài cùng
     */
    public function AjaxRemoveFileAll(){
        if(isset($_GET['InventoryPhotoId'])){
            $model = ProInventoryPhoto::model()->findByPk($_GET['InventoryPhotoId']);
            if($model){
                if($model->user_id==Yii::app()->user->id){
                    $model->delete();
                }
            }
            die;
        }
    }
    
    /** Jan 22, 2015 
     * 4. Move Aircon Services
     */
    
    /**
     * @Author: ANH DUNG Feb 03, 2015
     * @Todo: update tenancy
     * @Param: $id
     * @sample link: /admin/tenancy/update/add_property/1/id/555/type/1/listing_id/0/user_id/266
     */
    public function actionUpdate($id)
    {
        try
        {
            $mTransactions = $this->loadModel($id);
            ProTransactions::CanUpdateTrans($mTransactions);
            if(isset($_GET['user_id'])){ // Jan 02, 2014 For backend
//                $this->ValidateLinkRecord($add_property, $listing_id); // OPEN IT
                $add_property = isset($_GET['add_property'])?$_GET['add_property']:$mTransactions->add_property;
//                ProTransactions::GetSomeInfoRecord($mTransactions, $add_property);
                ProTransactions::GetSomeInfoRecordWithNoOverideModel($mTransactions, $add_property);
                ProTransactions::HandlePost($mTransactions);
            }
            
            $this->render('update/record_existing_tenancy',array(
                    'mTransactions'=>$mTransactions, 'actions' => $this->listActionsCanAccess,
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
            
    
}
