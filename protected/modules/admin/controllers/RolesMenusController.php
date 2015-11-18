<?php

class RolesMenusController extends AdminController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
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
		$model=new RolesMenus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RolesMenus']))
		{
			$model->attributes=$_POST['RolesMenus'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionAddRoles()
    {
        $model= new RolesMenus('addRoles');

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'add_roles') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(isset($_POST['RolesMenus']))
        {
            $model->menu_id = $_POST['RolesMenus']['menu_id'];
            $model->role_id = $_POST['RolesMenus']['role_id'];
            $model->save();
            Yii::app()->end();

        }else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RolesMenus']))
		{
			$model->attributes=$_POST['RolesMenus'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionViewRoles($id)
    {
        $menus = Menus::model()->findByPk((int)$id);
        $model=new RolesMenus('search');
        $model->unsetAttributes();  // clear any default values
        $model->menu_id = (int)$id;
        if(isset($_GET['RolesMenus']))
            $model->attributes=$_GET['RolesMenus'];

        $this->render('viewRoles',array(
            'model'=>$model,
            'id'=>$id,
            'menus'=>$menus,
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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
		{
                    Yii::log('Invalid request. Please do not repeat this request again.');
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RolesMenus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RolesMenus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RolesMenus']))
			$model->attributes=$_GET['RolesMenus'];

		$this->render('admin',array(
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
		$model=RolesMenus::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='roles-menus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
