<?php

class FurnishingIncludedController extends AdminController
{
	public function actionCreate()
	{
            try {
                $model = new ProMasterFurnishingIncluded('create');
                if (isset($_POST['ProMasterFurnishingIncluded'])) {
                    $model->attributes = $_POST['ProMasterFurnishingIncluded'];                  
                    if($model->save())
                        $this->redirect(array('index'));
                }
                $this->render('create', array(
                    'model' => $model,  
                    'actions' => $this->listActionsCanAccess,
                ));
            }catch (exception $e) {            
                Yii::log("Exception " . print_r($e, true), 'error');
                throw new CHttpException("Exception " . print_r($e->getMessage(), true));
            }
	}

	public function actionIndex()
	{
            try {
                $model = new ProMasterFurnishingIncluded('search');
                if(isset($_GET['ProMasterFurnishingIncluded'])){
                    $model->attributes=$_GET['ProMasterFurnishingIncluded'];
                }
                $this->render('index', array(
                    'model'     => $model,
                    'actions'   => $this->listActionsCanAccess,
                ));
            } catch (Exception $e) {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));
            }
	}

	public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            if(isset($_POST['ProMasterFurnishingIncluded']))
            {
                $model->attributes = $_POST['ProMasterFurnishingIncluded'];
                $model->save();
                $this->redirect(array('index'));              
            } 
            //$model->beforeRender();
            $this->render('update',array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
	}
        
        public function actionDelete($id)
	{
            try {
		if(Yii::app()->request->isPostRequest){
                    // we only allow deletion via POST request
                    if($model = $this->loadModel($id)){
                        if($model->delete()){
                            Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                        }                                
                    }
		} else {
                    Yii::log("Invalid request. Please do not repeat this request again.");
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
            } catch (Exception $e) {
                Yii::log("Exception ".  print_r($e, true), 'error');
                throw  new CHttpException("Exception ".  print_r($e, true));
            }
	}
        
        public function loadModel($id)
	{
            $model = ProMasterFurnishingIncluded::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}
}