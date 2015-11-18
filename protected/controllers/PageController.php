<?php

/**
 * @author PHAM DUY TOAN
 * Email :ghostkissboy12@gmail.com
 * 
 * page default : dung khi file khong co file trung voi ten slug
 * $model : obj  cua cms duoc lay tu trong model Pages ung voi slug dang co
 */
class PageController extends Controller {

	protected $cmsPage;

	public function actionIndex($slug) {
		$model = Pages::model()->findByAttributes(array('slug' => $slug));
		if ($model) {
			$this->pageTitle = $model->title_tag;
			$this->setMetaKeywords($model->meta_keywords);
			$this->setMetaDescription($model->meta_desc);
		}

		if (in_array($slug, array('for-rent', 'for-sale'))) {
			/* display content for page/for-rent and page/for-sale */
			Yii::app()->theme = 'onehome';
			$this->layout = '/layouts/onehome/2-col-left';
			$this->render('for-rent-sale', array(
				'isSale' =>
				$slug == 'for-sale'
			));
		} else {
			$this->getPage(trim($slug));
		}
	}

	/*
	 * render cms page
	 */
	public function getPage($slug) {
		$defaultPage = '/protected/views/page/default.php';
		if (!file_exists(Yii::getPathOfAlias("webroot") . $defaultPage))
			die("Please add file deault.php on path " . $defaultPage);

		$page = 'default';
		$model = Pages::model()->findByAttributes(array('slug' => $slug));
		if ($model) {
			$this->cmsPage = $model;
			if ($model->page_slug == 'contact-us') {
				$this->getContact($model);
			} else {
				$action = $model->page_slug;
				$checkPage = '/protected/views/page/' . $action . '.php';
				if (!file_exists(Yii::getPathOfAlias("webroot") . $checkPage))
					$page = 'default';
				else
					$page = $action;

				$this->render($page, array('model' => $model));
			}
		} else
			throw new CHttpException(404, 'The requested page does not exist.');
	}

	public function getContact($datacms) {
		$model = new ContactForm();
		if (isset($_POST['ContactForm'])) {
			die();
			$model->attributes = $_POST['ContactForm'];
			$model->email = trim($model->email);
			if ($model->validate()) {
//                $email_to = Yii::app()->params['adminEmail'];
				$email_to = "htram2205@gmail.com";
				SendEmail::sendMailContact($model, $email_to);
				Yii::app()->user->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->redirect(Yii::app()->createAbsoluteUrl('page/contact-us'));
			}
		}
		$this->render('contact-us', array('model' => $model));
	}

	public function actions() {
		return array(
			'captcha' => array(
				'class' => 'CaptchaExtendedAction',
			),
		);
	}

	public function getAllAction() {
		$criteria = new CDbCriteria;
		$result = Pages::model()->findAll($criteria);
		if ($result)
			return CHtml::listData($result, 'slug', 'slug');
		return array();
	}

}
