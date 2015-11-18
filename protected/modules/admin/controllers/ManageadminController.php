<?php

class ManageadminController extends AdminController
{	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users('create');
		$model->scenario = 'createAdmin';
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
                    $model->attributes=$_POST['Users'];
                     $model->status = $_POST['Users']['status'];
                    if($model->validate()){
                        $model->temp_password = $model->password_hash;
                        $model->created_date = date("Y-m-d H:i:s");
                        $model->role_id = ROLE_ADMIN; //save role for admin
                        $model->application_id = BE; //save user for back end
                        $model->save();
                        $model->password_hash = md5($model->password_hash);
                        $model->update();
                        $this->redirect(array('view','id'=>$model->id));
                    }
		}

		$this->render('create',array(
			'model'=>$model,'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->scenario = 'editAdmin';

		if(isset($_POST['Users']))
		{
                    $old_password = $model->password_hash;
                    $model->attributes=$_POST['Users'];
                    $model->status = $_POST['Users']['status'];
                    //echo $model->status;die();
                    if($model->validate()){
                        if(empty($model->password_hash) && empty($model->password_confirm)){
                            $model->password_hash = $old_password;
                        } else{
                            $model->temp_password = $model->password_hash;
                            $model->password_hash = md5($model->password_hash);
                        }
                        $model->update();
                        $this->redirect(array('view','id'=>$model->id));
                    }                    
                }
		$this->render('update',array(
			'model'=>$model,'actions' => $this->listActionsCanAccess,
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
         	if ($id != 2)
			if($model = $this->loadModel($id))
                        {
                            if($id==Yii::app()->user->id)
                                throw new CHttpException(400,'We can not delete this account.');

                            if($model->delete())
                                Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
		{
                    Yii::log('Invalid request. Please do not repeat this request again.');
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
            $model=new Users('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Users']))
                    $model->attributes=$_GET['Users'];
            $model->role_id=2;
            $this->render('index',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
		{
                    Yii::log('The requested page does not exist.');
                    throw new CHttpException(404,'The requested page does not exist.');
                }
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}                      
        
}
