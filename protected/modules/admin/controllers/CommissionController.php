<?php

class CommissionController extends AdminController
{
	public function actionIndex()
	{
            try {
                $model = new ProCommission('search');
                if(isset($_GET['ProCommission'])){
                    $model->attributes=$_GET['ProCommission'];
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
        
        public function actionCreate()
	{
            try {
                $model = new ProCommission('create');
                if (isset($_POST['ProCommission'])) {
                    $model->attributes = $_POST['ProCommission'];                  
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
        
        public function actionView($id) {
            try {
                $model = ProCommission::model()->findByPk($id);
                $this->render('view', array(
                    'model'     => $model,
                    'actions'   => $this->listActionsCanAccess,
                ));
            } catch (Exception $exc) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
        
        public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            if(isset($_POST['ProCommission']))
            {
                $model->attributes = $_POST['ProCommission'];
                $model->save();
                $this->redirect(array('index'));              
            } 
            //$model->beforeRender();
            $this->render('update',array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
	}
        
        public function loadModel($id)
	{
            $model = ProCommission::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}
}