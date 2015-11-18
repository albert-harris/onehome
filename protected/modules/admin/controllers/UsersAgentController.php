<?php

class UsersAgentController extends AdminController
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

        public static function buildArrTier($model, $tier_manager_id, $type_tier){
            $mFirstTier = new ProAgentTierManager();
            $mFirstTier->agent_id = 0;
            $mFirstTier->tier_manager_id = $tier_manager_id;
            $mFirstTier->type_tier = $type_tier;
            $model->aTierManager[] = $mFirstTier;
        }

        public function ajaxGetFirstTier($model){
            if(isset($_GET['first_tier_manager_id'])){
                $model->aTierManager = array();
                $this->buildArrTier($model,$_GET['first_tier_manager_id'], 1);
                $idSecond = ProAgentTierManager::getSecondTier($_GET['first_tier_manager_id']);                
                if(!empty($idSecond)){
                    $this->buildArrTier($model, $idSecond, 2);
                }
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
		$model=new Users('create_agent');
                $model->area_code_id = ActiveRecord::getDefaultAreaCode();
                $model->country_id = ActiveRecord::getDefaultAreaCode();
                $model->license = Yii::app()->params['company_license'];
                $model->agent_company_name = Yii::app()->params['company_name'];
                
                $this->ajaxGetFirstTier($model);
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
                        $model->role_id = ROLE_AGENT;
                        $model->temp_password =  $_POST['Users']['password_hash'];
                        $model->application_id = FE;
                        $model->avatar = CUploadedFile::getInstance($model, 'avatar');
                        $model->agent_company_logo = CUploadedFile::getInstance($model, 'agent_company_logo');
                        $model->validate();
                        if(!$model->hasErrors()){
                            $model->save();
                            $model->password_hash =  md5($_POST['Users']['password_hash']);
                            $model->scenario = NULL;
                            $model->update(array('password_hash'));
                            $model->save();
                            if (!is_null($model->avatar)) {
                                $model->avatar = Users::saveImage($model, 'avatar');
                                Users::resizeImage($model, 'avatar', Users::$aSize);
                                $model->update(array('avatar'));
                            }
                            if (!is_null($model->agent_company_logo)) {
                                $model->agent_company_logo = Users::saveImage($model, 'agent_company_logo');
                                Users::resizeImage($model, 'agent_company_logo', Users::$aSizeLogo);
                                $model->update(array('agent_company_logo'));
                            }
                            
                            ProAgentTierManager::saveAgentTier($model, isset($_POST['tier_id'])?$_POST['tier_id']:array());
                            ProAgentDistrict::saveAgentDistict($model, $model->ProAgentDistrict);
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

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            try
            {
		$model=$this->loadModel($id);
                $model->scenario = 'update_agent';
                $old_image = $model->avatar;
                $old_logo = $model->agent_company_logo;
                $oldPass = $model->password_hash;
                $model->aTierManager = $model->rAgentTierManager;
                $model->ProAgentDistrict = CHtml::listData($model->rAgentDistrict,'district_id','district_id');
		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
                        if(!isset($_POST['Users']['ProAgentDistrict']))
                            $model->ProAgentDistrict = array();
                        $model->avatar = CUploadedFile::getInstance($model, 'avatar');
                        $model->agent_company_logo = CUploadedFile::getInstance($model, 'agent_company_logo');
                        $model->validate();
                        if (!$model->hasErrors()) {
                            $model->role_id = ROLE_AGENT;
                            if(!empty($model->password_hash)){
                                $model->temp_password = $model->password_hash;
                                $model->password_hash = md5($model->password_hash);
                            }else{
                                $model->password_hash = $oldPass;
                            }
                            
                            // for avatar
                            if (!is_null($model->avatar)) {
                                Users::deleteImage($model, 'avatar', Users::$aSize);
                                $model->avatar = Users::saveImage($model, 'avatar');
                                Users::resizeImage($model, 'avatar', Users::$aSize);
                            } else{
                                $model->avatar = $old_image;
                            }
                            if(isset($_POST['delete_current_image']) && $_POST['delete_current_image']){
                                Users::deleteImage($model, 'avatar', Users::$aSize);
                                $model->avatar = '';
                            }
                            // for avatar
                            // for logo
                            if (!is_null($model->agent_company_logo)) {
                                Users::deleteImage($model, 'agent_company_logo', Users::$aSizeLogo);
                                $model->agent_company_logo = Users::saveImage($model, 'agent_company_logo');
                                Users::resizeImage($model, 'agent_company_logo', Users::$aSizeLogo);
                            } else{
                                $model->agent_company_logo = $old_logo;
                            }
                            if(isset($_POST['delete_current_logo']) && $_POST['delete_current_logo']){
                                Users::deleteImage($model, 'agent_company_logo', Users::$aSizeLogo);
                                $model->agent_company_logo = '';
                            }                          
                            // for logo
                            
                            $model->update();
                            ProAgentTierManager::saveAgentTier($model, isset($_POST['tier_id'])?$_POST['tier_id']:array());
                            ProAgentDistrict::saveAgentDistict($model, $model->ProAgentDistrict);
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
		$model=new Users('index_agent');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
                $model->role_id = ROLE_AGENT;
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
