<?php

class ServiceCategoryController extends AdminController {

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new ServiceCategory('create');
		if (isset($_POST['ServiceCategory'])) {
			$model->attributes = $_POST['ServiceCategory'];
			$model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
			$model->display_order = 9999;
			if ($model->save()) {
				$model->saveImage();
				OurService::massUpdateDisplayOrder();
				$this->redirect(array('index'));
			}
		}

		$this->render('create', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);

		if (isset($_POST['ServiceCategory'])) {
			$model->attributes = $_POST['ServiceCategory'];
			$model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
			if ($model->save()) {
				$model->saveImage();
				OurService::massUpdateDisplayOrder();
				$this->redirect(array('index'));
			}
		}

		$this->render('update', array(
			'model' => $model, 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if ($model = $this->loadModel($id)) {
				$model->delete();
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		} else {
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex() {
		try {
			$model = new ServiceCategory('search');
			$model->unsetAttributes();  // clear any default values
			if (isset($_GET['ServiceCategory']))
				$model->attributes = $_GET['ServiceCategory'];

			$this->render('index', array(
				'model' => $model, 'actions' => $this->listActionsCanAccess,
			));
		} catch (Exception $e) {
			Yii::log("Exception " . print_r($e, true), 'error');
			throw new CHttpException("Exception " . print_r($e, true));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model = ServiceCategory::model()->findByPk($id);
		if ($model === null) {
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		try {
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'our-service-form') {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		} catch (Exception $e) {
			Yii::log("Exception " . print_r($e, true), 'error');
			throw new CHttpException("Exception " . print_r($e, true));
		}
	}

	public function actionUp($id) {
		$model = $this->loadModel($id);
		$model->moveUp();
		echo '1';
	}
	
	public function actionDown($id) {
		$model = $this->loadModel($id);
		$model->moveDown();
		echo '1';
	}
}
