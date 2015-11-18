<?php

/**
 * @author Lam Huynh
 */
class ServiceController extends Controller {
	
	public function actionIndex() {
		$this->redirect('step1');
	}
	
	public function actionStep1() {
		$model = new ServiceRegistrationForm('step1');
		$lastId = Yii::app()->session['last-service-id'];
		if ($lastId && !in_array($lastId, $model->services)) {
			$s = OurService::model()->findByPk($lastId);
			if ($s) {
				if ($s->childs) {
					foreach($s->childs as $c) {
						$model->services[] = $c->id;
					}
				} else {
					$model->services[] = $s->id;
				}
			}
			unset(Yii::app()->session['last-service-id']);
		}
		$this->_setFormData($model);
		$this->_saveFormData($model);
		
		if (Yii::app()->request->isPostRequest 
			&& $model->validate()) {
			$this->redirect(array('step2'));
		}

		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/1-col';
		$this->pageTitle = 'Get Started - ' . Yii::app()->params['title'];
		$this->render('step1', array(
			'model' => $model
		));
	}
	
	public function actionStep2() {
		$model = new ServiceRegistrationForm('step2');
		$this->_setFormData($model);
		$this->_saveFormData($model);
		
		if (Yii::app()->request->isPostRequest 
			&& $model->validate()) {
			$this->redirect(array('step3'));
		}

		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/1-col';
		$this->pageTitle = 'Services - ' . Yii::app()->params['title'];
		$this->render('step2', array(
			'model' => $model
		));
	}
	
	public function actionStep3() {
		$model = new ServiceRegistrationForm('step3');
		$this->_setFormData($model);
		$this->_saveFormData($model);
		
		if (Yii::app()->request->isPostRequest) {
			$model->scenario = 'step1';
			$model->clearErrors();
			if (!$model->validate()) {
				$this->redirect(array('step1'));
			}
			
			$model->scenario = 'step2';
			$model->clearErrors();
			if (!$model->validate())
				$this->redirect(array('step2'));
			
			$model->scenario = 'step3';
			$model->clearErrors();
			if ($model->save()) {
				SendEmail::serviceRegistrationAdmin($model);
				SendEmail::serviceRegistrationUser($model);
				unset(Yii::app()->session['service-reg']);
				$this->redirect(array('thankyou'));
			}
		}

		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/1-col';
		$this->pageTitle = 'Confirmation - ' . Yii::app()->params['title'];
		$this->render('step3', array(
			'model' => $model
		));
	}
	
	public function actionThankyou() {
		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/1-col';
		$this->pageTitle = 'Thank you - ' . Yii::app()->params['title'];
		$this->render('thankyou');
	}
	
	private function _setFormData($model) {
		$data = array();
		// apply session data
		$session = Yii::app()->session['service-reg'];
		if (is_array($session)) {
			$data = $session;
		}
		
		// apply form data
		if (isset($_POST['ServiceRegistrationForm'])) {
			$data = array_merge($data, $_POST['ServiceRegistrationForm']);
		}
		
		$model->attributes = $data;
		$model->services = array_filter($model->services);
		$model->created_at = date('Y-m-d H:i:s');
	}

	private function _saveFormData($model) {
		$data = $model->attributes;
		$data['services'] = $model->services;
		Yii::app()->session['service-reg'] = $data;
	}

	public function actionQuickRegister() {
		if (!isset($_POST['ServiceRegistrationForm'])) {
			throw new CHttpException('400', 'Request invalid');
		}
		
		$model = new ServiceRegistrationForm('quick-register');
		$model->attributes = $_POST['ServiceRegistrationForm'];
		if ($model->save()) {
			SendEmail::serviceRegistrationAdmin2($model);
			$this->redirect(array('thankyou'));
		} else {
			throw new CHttpException('400', 'Request invalid');
		}	
	}
	
}
