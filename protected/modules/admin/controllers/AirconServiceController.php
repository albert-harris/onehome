<?php

class AirconServiceController extends AdminController
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
    public function actionCreate($id)
    {
        try
        {
            $model=new ProAirconService('create');
            $model->transaction_id = $id;
            $this->layout='ajax';
            if(isset($_POST['ProAirconService']))
            {
                $model->attributes=$_POST['ProAirconService'];
                $model->upload_service_documents  = CUploadedFile::getInstance($model,'upload_service_documents');
                if($model->save()){
                    ProAirconService::save_photo($model);
                    die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("pro-defect-grid");</script>'); 
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
        try{
            $model =ProAirconService::model()->findByPk($id);
            if(is_null($model))
            {
                throw new Exception('id not valid');
            }
            $old_upload_service_documents = $model->upload_service_documents;
            $model->scenario = 'updateTelemarketer';
            $model->schedule_date = MyFormat::dateConverYmdToDmy($model->schedule_date, "d/m/Y");
            $this->layout='ajax';
            if(isset($_POST['ProAirconService']))
            {
                $model->attributes=$_POST['ProAirconService'];
                $model->upload_service_documents  = CUploadedFile::getInstance($model,'upload_service_documents');
                if(is_null($model->upload_service_documents)){
                    $model->upload_service_documents = $old_upload_service_documents;
                }else{
                    $model->validate();
                    if( !$model->hasErrors() ){
                        $mOld = ProAirconService::model()->findByPk( $model->id );
                        ProAirconService::removeFile($mOld, 'upload_service_documents', ProAirconService::$folderUpload);
                        $model->upload_service_documents = ProAirconService::save_photo($model);
                    }
                }
                if($model->save()){
                    die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("pro-defect-grid");</script>'); 
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
     * @Author: ANH DUNG Oct 31, 2014
     * @Todo: Aircon Services
     * @Param: $id is transaction_id
     */

    public function actionIndex($id)
    {
        try{
            $model=new ProAirconService();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProAirconService']))
                    $model->attributes=$_GET['ProAirconService'];
            $model->transaction_id = $id;
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
            $model=ProAirconService::model()->findByPk($id);
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='pro-aircon-service-form')
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
}
