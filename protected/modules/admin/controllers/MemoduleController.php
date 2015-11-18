<?php

class MemoduleController extends AdminController
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
	public function actionCreate()
	{
        try
        {
            $model = new Memodule('create');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Memodule'])) {
                $model->attributes = $_POST['Memodule'];
                $model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
                if ($model->validate()) {
                    $timestamp = time();
                    if (!is_null($model->imageFile)) {
                        $ext = $model->imageFile->getExtensionName();
                        $model->cover = $timestamp . '.' . $ext;
                    }
                    if ($model->save()) {
                        if (!is_null($model->imageFile)) {
                            $model->cover = Memodule::saveImage($model);
                            Memodule::resizeCover($model);
                            $model->update(array('cover'));
                        }
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }

            $this->render('create', array(
                'model' => $model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        try
        {
            $model = $this->loadModel($id);
            $model->scenario = 'update';
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            $old_image = $model->cover;
        
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Memodule'])) {
                $model->attributes = $_POST['Memodule'];
                $isEmptyFileInput = empty($_FILES["Memodule"]["name"]["imageFile"]);
                if (!$isEmptyFileInput) { //has file input
                    $model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
                }

                $model->status = $_POST['Memodule']['status'];

                if ($model->validate()) {
                    if (!is_null($model->imageFile)) {
                            $model->cover = Memodule::saveImage($model);
                            Memodule::resizeCover($model);
                            $model->update(array('cover'));
                    }
                    if ($model->update()) {
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }

            $this->render('update', array(
                'model' => $model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
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
	 * Manages all models.
	 */
	public function actionIndex()
	{
                try
                {
		$model=new Memodule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Memodule']))
			$model->attributes=$_GET['Memodule'];

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
		$model=Memodule::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='memodule-form')
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
