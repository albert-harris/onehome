<?php

class FloorController extends AdminController
{
	public function actionIndex()
	{
            try {
                $model = new ProMasterFloor('search');
                if(isset($_GET['ProMasterFloor'])){
                    $model->attributes=$_GET['ProMasterFloor'];
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
            if(isset($_POST['ProMasterFloor']))
            {
                $model->attributes = $_POST['ProMasterFloor'];
                $model->save();
                $this->redirect(array('index'));              
            } 
            //$model->beforeRender();
            $this->render('update',array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
	}
        public function actionCreate()
	{
            try {
                $model = new ProMasterFloor('create');
                if (isset($_POST['ProMasterFloor'])) {
                    $model->attributes = $_POST['ProMasterFloor'];                  
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
        public function actionView() {
            $this->render('view');
        }
        public function loadModel($id)
	{
            $model = ProMasterFloor::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}
}