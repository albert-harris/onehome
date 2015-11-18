<?php

class ListingcompanyController extends AdminController
{
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
    public function actionCreate($company_listing_type)
    {
        try
        {
        $model=new Listing('CreateListingCompany');
        $model->user_id = Yii::app()->user->id;         
        $model->company_listing_type = $company_listing_type; 
        $model->company_listing_status = Listing::STATUS_COMPANY_AVAILABLE;

        if(isset($_POST['Listing']))
        {
            $model->attributes=$_POST['Listing'];
            $model->validate();                    
            if(!$model->hasErrors()){
                Listing::SaveCompanyListing($model);
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('create',array(
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
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
    try
    {
        $model=$this->loadModel($id);
        if(!Listing::CanUpdateCompanyListing($model)){
            $this->redirect(array('index'));
        }
            
        $model->scenario = 'UpdateListingCompany';
        $cmsFormater = new CmsFormatter();
        $model->dnc_expiry_date = $cmsFormater->formatDatePickerInput($model->dnc_expiry_date);
        if(isset($_POST['Listing']))
        {
            $model->attributes=$_POST['Listing'];
            $model->validate();    
            if(!$model->hasErrors()){
                Listing::SaveCompanyListing($model);
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('update',array(
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
     * Manages all models.
     */
    public function actionIndex()
    {
        try
        {
        $model=new Listing('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Listing']))
                $model->attributes=$_GET['Listing'];

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
            $model=Listing::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='listing-company-form')
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
     * @Author: ANH DUNG Aug 07, 2014
     */
    public function actionExport()
    {
        ExportExcel::ListingCompany();
    }
    
	/**
     * Render popup dialog to change Telemarketer of listings
	 * 
	 * @author Lam Huynh
     */
    public function actionUpdateTelemarketer($id){
        $model = new Listing();
        $id = explode('-', trim($id, '-'));
        $aModelListing = Listing::GetModelByListId($id);
        if (isset($_POST['Listing'])){
            Listing::massUpdateTelemarketer($_POST['Listing']);
            die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("listing-company-grid");</script>'); 
        }
		
        $this->renderPartial('update-telemarketer', array(
            'model' => $model,  
            'aModelListing' => $aModelListing,
            'actions' => $this->listActionsCanAccess,
        ));
    }
	
	public function actionTcAgreement() {
        $model=new CompanyListingAgreement('search');
        $model->unsetAttributes();  // clear any default values

        $this->render('agreement',array(
            'model'=>$model, 'actions' => $this->listActionsCanAccess,
        ));		
	}
}
