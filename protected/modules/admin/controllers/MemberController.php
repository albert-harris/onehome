<?php

class MemberController extends AdminController
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}


    /*
     * Export to excel
     */
    public function actionExportExcel() {
        $model=new Member('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Member']))
            $model->attributes=$_GET['Member'];

        $this->widget('application.extensions.phpexcel.EExcelView', array(
            'dataProvider' => $model->search(),
            'title' => 'Member',
            'autoWidth' => true,
            'columns' => array(
                'username',
                'title',
                'first_name',
                'last_name',
                'email',
                'phone',
                'company_name',
                'address',
                'birthday',
                'gender',
                'created_time',
                'last_update_time',
                'last_update_by',
                'last_login',
                'last_login_ip',
                'status:status',
            ),
        ));
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Member('create');
        $_POST['isRegister'] = true;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Member']))
		{
			$model->attributes=$_POST['Member'];
            $model->password = md5($model->password);
            $model->password_repeat = md5($model->password_repeat);
            $model->created_time = date('Y-m-d H:m:s');
            $model->birthday = $_POST['Member']['birthday'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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
        $prePassword = $model->password;
        $model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Member']))
		{
			$model->attributes=$_POST['Member'];
            if(empty($model->password))
            {
                $model->password = $prePassword;
                $model->password_repeat = $prePassword;
            }
            else
            {
                $model->password = md5($model->password);
                $model->password_repeat = md5($model->password_repeat);
            }
            $model->birthday = $_POST['Member']['birthday'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
                    Yii::log('Invalid request. Please do not repeat this request again.');
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Member('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Member']))
			$model->attributes=$_GET['Member'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Member::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='member-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
