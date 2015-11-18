<?php

/**
 * @author Lam Huynh
 */
class AgentController extends Controller {

	public function actions() {
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}

	public function actionView($slug) {
		$model = ProAgent::findBySlug($slug);
		$model->view_count++;
		$model->update('view_count');

		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/1-col';
		$this->pageTitle = $model->name_for_slug . ' - ' . Yii::app()->params['title'];
		$this->render('view', array(
			'model' => $model
		));
	}

	public function actionIndex() {
		$data = array();
		$session = Yii::app()->session['agent-search'];
		if (is_array($session)) {
			$data = $session;
		}
		if ($_GET) {
			$data = array_merge($data, $_GET);
		}
		Yii::app()->session['agent-search'] = $data;

		$model = new ProAgent();
		$model->attributes = $data;

		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/1-col';
		$this->autosetSeoData('ourteam');
		$this->render('index', array(
			'model' => $model
		));
	}

	public function actionDisplayAgents() {
		$model = new ProAgent();
		$data = array();
		$session = Yii::app()->session['agent-search'];
		if (is_array($session)) {
			$data = $session;
		}
		if ($_GET) {
			$data = array_merge($data, $_GET);
		}

		Yii::app()->session['agent-search'] = $data;
		$model->attributes = $data;

		Yii::app()->theme = 'onehome';
		$this->renderPartial('_agent-listing', array(
			'model' => $model
		));
	}

	public function actionFieldClick($id, $field) {
		$agent = ProAgent::model()->findByPk($id);
		if (!$agent || !in_array($field, array('phone', 'email')))
			throw new CHttpException(403, 'Permission denied.');
		$f = $field . '_click';
		$agent->$f += 1;
		$agent->update($f);
		echo $agent->$f;
	}

	public function actionRegister() {
		$model = new ProAgent('register');
//		$model = ProAgent::model()->findByPk(1254);	// test
//		$model->scenario = 'register';
		
		if (isset($_POST['ProAgent'])) {
			$model->attributes = $_POST['ProAgent'];
			$model->uploadPhoto=CUploadedFile::getInstance($model,'uploadPhoto');
			$model->uploadNricFront=CUploadedFile::getInstance($model,'uploadNricFront');
			$model->uploadNricBack=CUploadedFile::getInstance($model,'uploadNricBack');
			$model->uploadCertification=CUploadedFile::getInstance($model,'uploadCertification');
			list($model->first_name, $model->last_name) = explode(' ', $model->name_for_slug);
			$model->status = STATUS_INACTIVE;
			$model->role_id = ROLE_AGENT;
			
			if ($model->save()) {
				$model->saveUploadFiles();
				SendEmail::agentRegistrationToAdmin($model);
				SendEmail::agentRegistrationToUser($model);
				$this->redirect(array('thankyou'));
			}
		}
		
		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/2-col-left';
		$this->render('register', array(
			'model' => $model
		));
	}

	public function actionThankyou() {
		Yii::app()->theme = 'onehome';
		$this->layout = '/layouts/onehome/1-col';
		$this->pageTitle = 'Thank you - ' . Yii::app()->params['title'];
		$this->render('thankyou');
	}
	
	protected function getTabCssClass($tab) {
		$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'agent';
		return $tab==$activeTab ? 'active' : '';
	}
}
