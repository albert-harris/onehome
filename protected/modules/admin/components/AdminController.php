<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends MainController
{

    /**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
     * Handle the ajax request. This process changes the status of member to 1 (mean active)
     * @param type $id the id of member need changed status to 1
     */
    public function actionAjaxActivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            
            $model = $this->loadModel($id);
            if(method_exists($model, 'activate'))
            {
                $model->activate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('Invalid request. Please do not repeat this request again.');
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
            
    }

    /**
     * Handle the ajax request. This process changes the status of member to 0 (mean deactive)
     * @param type $id the id of member need changed status to 0
     */
    public function actionAjaxDeactivate($id) {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            if(method_exists($model, 'deactivate'))
            {
                $model->deactivate();
            }
            Yii::app()->end();
        }
        else
        {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404,'The requested page does not exist.');
        }
            
    }

//    public function actionAjaxShow($id) {
//        if(Yii::app()->request->isPostRequest)
//        {
//            $model = $this->loadModel($id);
//            if(method_exists($model, 'activate'))
//            {
//                $model->showInMenu();
//            }
//            Yii::app()->end();
//        }
//        else
//        {
//            Yii::log('Invalid request. Please do not repeat this request again.');
//            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//        }            
//    }
//
//    public function actionAjaxNotShow($id) {
//        if(Yii::app()->request->isPostRequest)
//        {
//            $model = $this->loadModel($id);
//            if(method_exists($model, 'deactivate'))
//            {
//                $model->notShowInMenu();
//            }
//            Yii::app()->end();
//        }
//        else
//        {
//            Yii::log('Invalid request. Please do not repeat this request again.');
//            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//        }           
//    }
	
    /**
     * Need override
     * @param $id
     * @return null
     */
    public function loadModel($id)
    {
        return null;
    }
    
    public function accessRules()
    {                
//        echo Yii::app()->controller->id . ', ' . Yii::app()->controller->module->id;
//        $this->controllerRules(Yii::app()->controller->id, Yii::app()->controller->module->id);
//        die;
        return $this->controllerRules(Yii::app()->controller->id, Yii::app()->controller->module->id);
    }
    
    /**
     * DTOAN ghostkissboy12@gmail.com
     * 
     * set login cookie
     */
     public function init(){
            parent::init();

            if(isset(Yii::app()->user->id)){
                        $user = Users::model()->findByPk(Yii::app()->user->id);
                        if(empty($user) || Yii::app()->user->status ==0 ){
                            Yii::app()->user->logout();
                            $this->redirect(Yii::app()->createAbsoluteUrl('admin'));
                        }
          }             
    }   
    
    
    /*
      * Austin added date 9/7/2014
      * Show nofify message if it has
      */
    public function renderNotifyMessage()
    {
        if(Yii::app()->user->hasFlash('beFormAction'))
        {
            echo '<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
                . Yii::app()->user->getFlash('beFormAction') .
                '</div>';
        }

        if(Yii::app()->user->hasFlash('beFormError'))
        {
            echo '<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'
                . Yii::app()->user->getFlash('beFormError') .
                '</div>';
        }

    }

    /*
      * Austin added date 9/7/2014
      * Set notify message
      * type will get from enum NotificationType
      */
    public function setNotifyMessage($type, $message)
    {
        if ($type == NotificationType::Error)
            Yii::app()->user->setFlash('beFormError', $message);
        elseif($type == NotificationType::Success)
            Yii::app()->user->setFlash('beFormAction', $message);
    }
    
}