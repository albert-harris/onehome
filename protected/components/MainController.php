<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MainController extends CController
{
    protected $listActionsCanAccess;   
    
    //check controller access rules - PDQuang
    protected function checkControllerRules($controller, $module=null, $application)
    {
        $accessArray = array();
        //user roles
        $user_actions = UsersActions::model()->findAll("controller like '$controller' and module like '$module'");
        
        if($user_actions)
        {
            foreach($user_actions as $key => $user_action)
            {
                $array_action = array_map('trim',explode(",",trim($user_action->actions)));
                $accessArray[] = array($user_action->type,
                                        'actions'=>$array_action,
                                        'users'=>array($user_action->user->username),                                        
                                    );                
            }
        }
        
        //menu roles
        $menu = Menus::model()->find(array('condition' => "controller_name like '$controller' and module_name like '$module' and application_id = $application", 
                                    'order' => 'desc'));        
        if($menu)
        {
            $roles_menu = RolesMenus::model()->findAll("menu_id = $menu->id");
            foreach($roles_menu as $key => $role_menu)
            {
                $array_action = array_map('trim',explode(",",trim($role_menu->actions)));
                $accessArray[] = array('allow',
                                        'actions'=>$array_action,
                                        'users'=>array('@'),
                                        'expression'=>'Yii::app()->user->role_id == '.$role_menu->role_id
                                    );                
            }
        }
        $accessArray[] = array('deny', 
        );

        return $accessArray;
    }
    
    //new check controller access rules - PDQuang
    protected function controllerRules($controller, $module=null)
    {
        $accessArray = array();
        $controller_model = Controllers::model()->find("controller_name like '$controller' and module_name like '$module'");
        //var_dump($controller_model);
        if(!$controller_model)
        {
            echo 'denied';
            return array(array('deny'));
            
        }
        
        //user roles
//        $actions_user = ActionsUsers::model()->findAll(array('condition' => "controller_id = $controller_model->id  and can_access like 'allow'",
//                                                     'order' => 'controller_id desc'));
        // ANH DUNG CLOSE JAN 29, 2015
        
        // ANH DUNG ADD JAN 29, 2015
        $criteria = new CDbCriteria();
        $criteria->compare("t.controller_id", $controller_model->id );
        $criteria->compare("t.user_id", Yii::app()->user->id );
        $criteria->compare("t.can_access", "allow", true );
        $criteria->order = "t.controller_id desc";
        $actions_user = ActionsUsers::model()->findAll($criteria);
        // ANH DUNG ADD JAN 29, 2015
        
//        if($actions_user)
//        {
            foreach($actions_user as $key => $user_action)
            {                
                if($user_action->user){
                        $array_action = array_map('trim',explode(",",trim($user_action->actions)));
                        $accessArray[] = array($user_action->can_access,
                                                        'actions'=>$array_action,
                                                        'users'=>array($user_action->user->username),                                        
                                                );                
                }else
                   $user_action->delete(); // delete data not valid 										
            }
//        }
        
        //menu roles ANH DUNG FIX Oct 07, 2014
        $criteria = new CDbCriteria();
        $criteria->compare('controller_id', $controller_model->id);
        $criteria->compare('can_access', 'allow');
        $criteria->compare('roles_id', Yii::app()->user->role_id);
        $actions_role = ActionsRoles::model()->findAll($criteria);
//        $actions_role = ActionsRoles::model()->findAll(array('condition' => "controller_id = $controller_model->id  and can_access LIKE 'allow'",
//                                                                                                                'order' => 'controller_id desc'));   
//      //menu roles ANH DUNG FIX Oct 07, 2014
        
        if($actions_role)
        {            
            foreach($actions_role as $key => $action_role)
            {
                $array_action = array_map('trim',explode(",",trim($action_role->actions)));
                $accessArray[] = array('allow',
                                        'actions'=>$array_action,
                                        'users'=>array('@'),
//                                        'expression'=>'Yii::app()->user->role_id == '.$action_role->roles_id
                                    );                
            }
        }
        
//        $accessArray[] = array('deny'); // ANH DUNG CLOSE JAN 29, 2015
        $accessArray[] = array('deny', 'users'=>array('*'));// ANH DUNG ADD JAN 29, 2015
        return $accessArray;
    }
    
    function init() {
        $this->setActionsAccess();
        parent::init();
    }
    
    protected function setActionsAccess()
    {
        if(isset(Yii::app()->user->role_id))
            $this->listActionsCanAccess = ControllerActionsName::getListActionsCanAccess($this->accessRules(), Yii::app()->user->role_id);
    }
    
    /**
     * @return array action filters
     */
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
            );
    }

    protected function checkControllerAccessRules($controller,$application)
    {
        if(empty($controller))
        {
            $accessArray = array();
            $accessArray[] = array('deny',  // deny all users to perform 'index' and 'view' actions
                'users'=>array('*'),
            );
        }
        else
        {
            $menu = Menus::model()->findAll(array('condition'=>'controller_name = "'.$controller.'" AND application_id ='.$application));
            if(!empty($menu))
            {
                $list_menu_id='';
                for($i=0; $i< count($menu);++$i)
                {
                    $v = $menu[$i];
                    if ($i == (count($menu) - 1))
                        $list_menu_id .= $v->id;
                    else
                        $list_menu_id .= $v->id.',';
                }
                //echo $list_menu_id;
                $list_menu = $list_menu_id;
                $list_menu_id = explode(",", $list_menu_id);
                $criteria = new CDbCriteria;
                $criteria->addInCondition('t.menu_id', $list_menu_id, 'AND');
                $criteria->group = 't.role_id';
                $menu_role = RolesMenus::model()->findAll($criteria);
                $accessArray = array();
                /*
                $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                    'actions'=>array('index','view'),
                    'users'=>array('*')
                );
                print_r($accessArray);
                */
                if(!empty($menu_role))
                {
                    for($i=0; $i< count($menu_role);++$i)
                    {
                        $v = $menu_role[$i];
                        //echo $v->role_id;
                        $menuOfRole = RolesMenus::model()->findAll('menu_id IN ('.$list_menu.') AND role_id='.$v->role_id);
                        $action_name = '';
                        for($t=0; $t < count($menuOfRole);++$t)
                        {
                            $w = $menuOfRole[$t];
                            if ($t === (count($menuOfRole) - 1))
                                $action_name .= $w->actions;
                            else{
                                if(!empty($w->actions)){
                                    $action_name .= $w->actions.",";
                                }
                            }
                        }
                        $action_name = explode(",", trim($action_name));
                        $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                            'actions'=>$action_name,
                            'users'=>array('@'),
                            'expression'=>'isset($user->role_id) && (Yii::app()->user->role_id == '.$v->role_id.')'
                        );

                    }
                    $accessArray[] = array('deny',  // deny all users to perform 'index' and 'view' actions
                        'users'=>array('*'),
                    );
                    //print_r($accessArray);
                } else
                {
                    $accessArray = array();
                    $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                        'users'=>array('*'),
                    );
                }
            }else
            {
                $accessArray = array();
                $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                    'users'=>array('*'),
                );
            }
        }
        //print_r($accessArray);
        return $accessArray;
    }
    

    public function beforeRender($view) {
		parent::beforeRender($view);
        if(isset (Yii::app()->user->id)){    
            $mUser = Users::model()->findByPk(Yii::app()->user->id);                        
            if(is_null($mUser) || $mUser->status==STATUS_INACTIVE){                            
                Yii::app()->user->logout();
                Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/login'));
            }
        }
        return true;        
    }
    
   protected function wrapcontent($url, $datatopost, $ns) {
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, $datatopost);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8', 
                        'Content-Length: ' . strlen($datatopost)// . $ns
        ));
        $result = curl_exec($soap_do);
        curl_close($soap_do);
	return $result;
    }
    
    public function getSilverPrice()
    {
        
        $postData = '<?xml version="1.0" encoding="utf-8"?>
                <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                  <soap:Body>
                    <GetCurrentSilverPrice xmlns="http://freewebservicesx.com/">
                      <UserName>fsv.austin@gmail.com</UserName>
                      <Password>Password600</Password>
                    </GetCurrentSilverPrice>
                  </soap:Body>
                </soap:Envelope>';
        $url = 'http://www.freewebservicesx.com/GetSilverPrice.asmx';
        $ns = 'SOAPAction: "http://freewebservicesx.com/GetCurrentSilverPrice"';
        $result = $this->wrapcontent($url, $postData, $ns);
        $parser = new XmlToArrayParser($result);
        $domArr = $parser->array;
        return $domArr['soap:Envelope']['soap:Body']['GetCurrentSilverPriceResponse']['GetCurrentSilverPriceResult'];
    }     
    
}

?>