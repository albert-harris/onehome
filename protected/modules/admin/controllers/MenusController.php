<?php

class MenusController extends AdminController
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	    $model = $this->loadModel($id);
        $roles = $model->rolesMenus;
        $sRoles = '';
        if(count($roles)>0){
            for($i=0; $i< count($roles); $i++)
            {
                if($roles[$i]->role){
                    $sRoles .= $roles[$i]->role->role_name.' ('.$roles[$i]->actions.')<br/> ';
                }
            }
            $sRoles = substr($sRoles, 0, -2);
        }

		$this->render('view',array(
			'model'=>$model,
            'sRoles'=>$sRoles, 'actions' => $this->listActionsCanAccess,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Menus;

        $aRolesDB = Roles::model()->findAll('application_id='.BE);
        $aRoles = array();
        $aSelectedRoles = array();
        $aRoleMenuActionExist = array();
        foreach($aRolesDB as $item)
        {
            $aRoles[$item['id']] = $item['role_name'];
        }

		if(isset($_POST['Menus']) && isset($_POST['actions']))
		{
                    //Check controller name, action name - PDQuang
//                    if($_POST['Menus']['module_name']==null)
//                    {
//                        $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Menus']['controller_name'], $_POST['actions']);
//                    }
//                    else {
//                        $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Menus']['controller_name'], $_POST['actions'], $_POST['Menus']['module_name']);
//                    }
//                    
//                    if(!$checkController)
//                    {
//                        Yii::log('Controller, Module or Actions is wrong!');
//                        throw new CHttpException('Controller, Module or Actions is wrong!');  
//                    }                        
                    
			$model->attributes=$_POST['Menus'];

            if(isset($_POST['roles']))
            {
                $i=0;
                foreach($_POST['roles'] as $roleID)
                {
                    $aSelectedRoles[] = $roleID;
                    $aRoleMenuActionExist[$roleID] = $_POST['actions'][$i] ;
                    $i++;
                }
             }

			$model->parent_id = (int)$model->parent_id;
			if($model->save())
            {
                if(isset($_POST['roles']))
                {
                    $index = 0;
                    foreach($_POST['roles'] as $roleID)
                    {
                        $mRolesMenus = new RolesMenus;
                        $mRolesMenus->role_id = $roleID;
                        $mRolesMenus->menu_id = $model->id;
                        $mRolesMenus->actions = $_POST['actions'][$index];
                        $mRolesMenus->save();
                    }
                 }

                $this->redirect(array('view','id'=>$model->id));

            }
		}

		$this->render('create',array(
			'model'=>$model,
            'aRoles'=>$aRoles,
            'aSelectedRoles'=>$aSelectedRoles,
            'aRoleMenuActionExist'=>$aRoleMenuActionExist,
                     'actions' => $this->listActionsCanAccess,
		));
	}
    
    public function actionGetactioncheckbox()
    {
        if(isset($_POST['controller']) && isset($_POST['module']))
        {
            $actions = ControllerActionsName::getActions($_POST['controller'],$_POST['module']);
            if($actions != null)
            {
                $array_action = array_map('trim',explode(",",trim($actions)));
                MyDebug::output($array_action);
            }
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
                
        $aRolesDB = Roles::model()->findAll('application_id='.BE);
        $aRoles = array();
        $aRoleID = array();//all roles of system
        $aSelectedRoles = array();
        foreach($aRolesDB as $item)
        {
            $aRoles[$item['id']] = $item['role_name'];
            $aRoleID[] = $item['id'];
        }

        $roleMenusExist = RolesMenus::model()->findAll('menu_id="'.$model->id.'"');

        $aRoleMenuIDExist = array();
        $aRoleMenuActionExist = array();

        foreach($roleMenusExist as $roleMenusExistItem)
        {
            $aRoleMenuIDExist[] = $roleMenusExistItem['role_id'];
            $aRoleMenuActionExist[$roleMenusExistItem['role_id']] = $roleMenusExistItem['actions'];

            $aSelectedRoles[] = $roleMenusExistItem['role_id'];
        }
        //
		if(isset($_POST['Menus']) && isset($_POST['actions']))
		{
                    //Check controller name, action name - PDQuang
//                    MyDebug::output($_POST['Menus']);MyDebug::output($_POST['actions']);
//                    if($_POST['Menus']['module_name']==null)
//                    {
//                        $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Menus']['controller_name'], $_POST['actions']);
//                    }
//                    else {
//                        $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Menus']['controller_name'], $_POST['actions'], $_POST['Menus']['module_name']);
//                    }
//                    
//                    if(!$checkController)
//                    {
//                        Yii::log('Controller, Module or Actions is wrong!');
//                        throw new CHttpException('Controller, Module or Actions is wrong!');  
//                    }
                    
			$model->attributes=$_POST['Menus'];

            $aSelectedRoles = array();
                $aRolesInput = array();
                if(isset($_POST['roles']))
                {
                    $i = 0;
                    foreach($_POST['roles'] as $roleID)
                    {
                        $aRolesInput[] = $roleID;
                        $aSelectedRoles[] = $roleID;

                        $aRoleMenuActionExist[$roleID] = $_POST['actions'][$i] ;
                        $i++;
                    }

                }
			if($model->save())
            {
                //RolesMenus::model()->deleteAll('menu_id="'.$model->id.'"');


                //check to delete if exitt or insert if it doesn't exist
                $index = 0;
                foreach($aRoleID as $iRoleID)
                {
                    if(in_array($iRoleID,$aRoleMenuIDExist) && !in_array($iRoleID,$aRolesInput))
                        RolesMenus::model()->deleteAll('menu_id="'.$model->id.'" AND role_id="'.$iRoleID.'"');

                    if(in_array($iRoleID,$aRolesInput)) //was check in form
                    {
                        if(!in_array($iRoleID,$aRoleMenuIDExist)) //no exist - create new
                        {
                            $mRolesMenus = new RolesMenus;
                            $mRolesMenus->role_id = $iRoleID;
                            $mRolesMenus->menu_id = $model->id;
                            $mRolesMenus->actions = $_POST['actions'][$index];
                            $mRolesMenus->save();
                        }
                        else //exist  update
                        {
                            $mRolesMenus = RolesMenus::model()->find('role_id='.$iRoleID.' AND menu_id='.$model->id);
                            $mRolesMenus->actions = $_POST['actions'][$index];
                            $mRolesMenus->save();
                        }

                    }
                    $index++;
                }
				$this->redirect(array('view','id'=>$model->id));
            }
		}

        /*echo "<pre>";
        print_r($aRoleMenuActionExist);
        echo "</pre>";
        exit;*/

		$this->render('update',array(
			'model'=>$model,
            'aRoles'=>$aRoles,
            'aSelectedRoles'=>$aSelectedRoles,
            'aRoleMenuActionExist'=>$aRoleMenuActionExist,
                     'actions' => $this->listActionsCanAccess,
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
            /*
                        $menus = Menus::model()->findAll();
                        $idChild = Menus::model()->findAllChild($id,$menus);
                        if(count($idChild)>0)
                            Menus::model()->deleteByPk($idChild);
            */
			$this->loadModel($id)->delete();
            RolesMenus::model()->deleteAll(array('condition'=>'menu_id = '.$id));

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
        $model=new Menus('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Menus']))
            $model->attributes=$_GET['Menus'];

        $this->render('admin',array(
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
		$model=Menus::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='menus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}       
        
        
}
