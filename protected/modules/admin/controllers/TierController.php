<?php

class TierController extends AdminController
{
	public function actionCreate()
	{
            try {
                $model = new ProTier('create');
                if (isset($_POST['ProTier'])) {
                    $model->attributes = $_POST['ProTier'];                  
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
                $model = new ProTier('search');
                if(isset($_GET['ProTier'])){
                    $model->attributes=$_GET['ProTier'];
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
            if(isset($_POST['ProTier']))
            {
                $model->attributes = $_POST['ProTier'];
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
            $model = ProTier::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
	}
}