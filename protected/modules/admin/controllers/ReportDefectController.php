<?php

class ReportDefectController extends AdminController
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
        try{         
            $model=new ProReportDefect('create');
            $model->transaction_id = $id;
            $this->layout='ajax';
            $model->created_date = date("Y-m-d H:i:s");
            if(isset($_POST['ProReportDefect']))
            {
                $model->attributes=$_POST['ProReportDefect'];
                $model->photo  = CUploadedFile::getInstance($model,'photo');
                
                if($model->save()){
                    ProReportDefect::save_photo($model);
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
            $model =ProReportDefect::model()->findByPk($id);
            if(is_null($model))
            {
                throw new Exception('id not valid');
            }
            $model->scenario = 'update';
//            $model->created_date =  MyFormat::InvoiceDateDbDateToShowDate($model->created_date);
            $oldImage = $model->photo;
            
            $this->layout='ajax';
            if(isset($_POST['ProReportDefect']))
            {
                $model->attributes=$_POST['ProReportDefect'];
                $model->photo  = CUploadedFile::getInstance($model,'photo');
                
                if($model->save()){
                    if(!is_null($model->photo)){
                        ProReportDefect::save_photo($model);
                    }else{
                        $model->photo = $oldImage;
                        $model->update(array('photo'));
                    }
                    
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

    public function actionUpdateDefectStatus($id)
    {
        try{            
            $model =ProReportDefect::model()->findByPk($id);
            if(is_null($model))
            {
                throw new Exception('id not valid');
            }
            $model->scenario = 'UpdateDefectStatus';
            $this->layout='ajax';
            $cmsFormater = new CmsFormatter();
            $model->approved_date = $cmsFormater->formatDatePickerInput($model->approved_date);
            if(isset($_POST['ProReportDefect']))
            {
                $attUpdate = array('status');
                $model->attributes=$_POST['ProReportDefect'];
                if($model->status == CmsFormatter::COMPLETE_REPORT){
                    $model->approved_by_complete = Yii::app()->user->id;
                    $model->scenario = 'UpdateDefectStatusComplete';
                    $attUpdate[] = 'approved_by_complete';
                    $attUpdate[] = 'approved_date';
                    $attUpdate[] = 'remark';
                }elseif($model->status == CmsFormatter::PROGESS_REPORT){
                    $model->approved_by_progess = Yii::app()->user->id;
                    $attUpdate[] = 'approved_by_progess';
                }
                $model->validate();
                if(!$model->hasErrors()){
                    $model->update($attUpdate);
                    die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("pro-defect-grid");</script>'); 
                }
            }            
            $this->render('UpdateDefectStatus',array(
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

    /** Jan 22, 2015 
     * 2. Move Report Defect
     */
    public function actionIndex($id)
    {
        try{
            $model=new ProReportDefect();
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['ProReportDefect']))
                    $model->attributes=$_GET['ProReportDefect'];
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
            $model=ProReportDefect::model()->findByPk($id);
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='pro-report-defect-form')
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
