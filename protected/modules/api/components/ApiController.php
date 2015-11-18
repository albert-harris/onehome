<?php
/**
 * @author bb qbao <quocbao1087@gmail.com>
 * @copyright (c) 2013, Quoc Bao
 */
class ApiController extends CController
{
    public $layout='/layouts/column2';
    // public $language_id;//use this in controller
    // public $_lang_id;
    public $lang = 'en';
    
    public $consumer_key;
    
    protected $method;
    protected $params;
    protected $q;
    
    public function init()
    {
        parent::init();
        Yii::app()->theme = "yiicore";
        // $this->setLanguage(Languages::model()->getDefaultLang());//set default system language
        $this->module->oauth_init();
        $this->consumer_key = $this->module->getParam('oauth_consumer_key');
        $this->_parseParams();
    }
    public function setLanguage($lang)
    {
        if(in_array($lang, array('en','zh_cn')))
        {
            $this->lang = $lang;
            $app = Yii::app();
            $app->language = $this->lang;

            ApiModule::$defaultResponse = array('status'=>0,
                                        'code'=>400,
                                        // 'message'=>Yii::t('systemmsg','Invalid request. Please check your http verb, action url and param')
                                        'message'=>Yii::t('systemmsg','Invalid request')
                                        );
            ApiModule::$defaultSuccessResponse =  array('status'=>1,
                                        'code'=>200,
                                        'message'=>Yii::t('systemmsg','Success')
                                        );  
        }
    }

    public function setDefaultLangOfUser($mUser, $lang = NULL)
    {
        if(empty($lang) && !empty($mUser->default_lang))
            $this->setLanguage($mUser->default_lang);
        else if(!empty($lang))
        {
            $mUser->default_lang = $lang;
            $mUser->update(array('default_lang'));
            $this->setLanguage($mUser->default_lang);
        }
        else{
            $mUser->default_lang = $this->lang;
            $mUser->update(array('default_lang'));
        }

    }

    public function dataProviderToArray($DataProvider) {
        if(is_object($DataProvider)) {
            $result = array();
            $data = $DataProvider->data;
            foreach($data as $item){
                $result[] = $item->attributes;
            }
            return $result;
        }
    }
    
    private function _parseParams() 
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == "PUT" || $this->method == "DELETE") {
            parse_str(file_get_contents('php://input'), $this->params);
            $GLOBALS["_{$this->method}"] = $this->params;
            // Add these request vars into _REQUEST, mimicing default behavior, PUT/DELETE will override existing COOKIE/GET vars
            $this->params = $this->params + $_REQUEST;
        } else if ($this->method == "GET") {
            $this->params = $_GET;
        } else if ($this->method == "POST") {
            $this->params = $_POST;
        }
    }
    
    protected function hanldeRequestMethod($id)
    {
        switch($this->method){
            case 'GET': 
                if($id === null)
                    $this->_list();
                else
                    $this->_details($id);
                break;
            case 'POST': $this->_create() ; break;
            case 'PUT': $this->_update($id) ; break;
            case 'DELETE': $this->_delete($id) ; break;
        }
    }
    
    public function log()
    {
        if(false)
            return true;
        
        $model = new ApiRequestLogs();
        
        $dataType = 'Text';
        if(is_array($this->params))
            $dataType = 'Array';
        
        if(isset($_SERVER['REQUEST_URI']))
            $requestURI = $_SERVER['REQUEST_URI'];
        else
            $requestURI='';
        
        $model->method = $_SERVER['REQUEST_METHOD']. ' - '.$requestURI;
        
        if(is_array($this->params))
            $model->content = json_encode($this->params);
        else
            $model->content = $this->params;
        $model->created_date = date('Y-m-d H:i:s');
        $model->save();
    }
    
    
    public function checkRequest()
    {
        $this->log();//ok
        $method = $_SERVER['REQUEST_METHOD'];
        if(!isset($this->params['q']))
        {
            $result = ApiModule::$defaultResponse;
            $result['message'] = 'Missing q as a param. Ex: user/loginFirstTime?q={"username":"0909456789"}';
            ApiModule::sendResponse($result);
        }
        else{
           $q = json_decode($this->params['q'], true);
           if(!is_array($q))
           {
               $result = ApiModule::$defaultResponse;
               $result['message'] = 'Invalid JSON encode format';
               ApiModule::sendResponse($result);
           }
        }
        $this->q = json_decode($this->params['q']);
        if(isset($this->q->lang))
            $this->setLanguage($this->q->lang);
    }
    
    public function checkRequiredParams($q, $arrayOfFieldNames)
    {
        $arrayOfInvalidFields = array();
        $isValid = true;
        if(!is_array($q))
        {
            foreach ($arrayOfFieldNames as $f)
            {
                if(!isset($q->$f))
                {
                    $isValid = false;
                    $arrayOfInvalidFields[] = $f;
                }
            }
        }
        else
        {
            foreach ($arrayOfFieldNames as $f)
            {
                if(!isset($q[$f]))
                {
                    $isValid = false;
                    $arrayOfInvalidFields[] = $f;
                }
            }
        }
        
        if(!$isValid)
        {
            $result['message'] = 'Missing param. Reference in record';
            $result['record'] = json_encode($arrayOfInvalidFields);
            ApiModule::sendResponse($result);
        }
    }
    
    public function checkToken($token = null)
    {
        $result = ApiModule::$defaultResponse;
        if($token === null)
            $token = $this->q->token;
        if(!UsersTokens::model()->checkToken($token))
        {
            $result['message'] = 'Token is invalid or expired';
            ApiModule::sendResponse($result);
        }
    }
    
}