<?php

class UsersRegisteredController extends AdminController
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

	public function actionCreate()
	{
            try
            {
		$model=new Users('create_register');

		if(isset($_POST['Users']))
		{
                    $model->attributes=$_POST['Users'];
                    $model->role_id = ROLE_REGISTER_MEMBER;
                    $model->temp_password =  $_POST['Users']['password_hash'];
                    $model->application_id = FE;
                    $model->validate();
                    if(!$model->hasErrors()){
                       $model->scenario = NULL;
                       $model->password_hash =  md5($_POST['Users']['password_hash']);
                        $model->save();
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

	public function actionUpdate($id)
	{
                try
                {
		$model=$this->loadModel($id);
                $model->scenario = 'update_register';
                $oldPass = $model->password_hash;

		if(isset($_POST['Users']))
		{
                    $model->attributes=$_POST['Users'];
                    $model->validate();
                    if(!$model->hasErrors()){
                        $model->role_id = ROLE_REGISTER_MEMBER;
                        if(!empty($model->password_hash)){
                            $model->temp_password = $model->password_hash;
                            $model->password_hash = md5($model->password_hash);
                        }else{
                            $model->password_hash = $oldPass;
                        }
                        $model->update();
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
		$model=new Users('index_register');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
                $model->role_id = ROLE_REGISTER_MEMBER;
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
		$model=Users::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
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
