<?php
/**
 * @author bb qbao <quocbao1087@gmail.com>
 * @copyright (c) 2013, Quoc Bao
 */
class ApiModule extends CWebModule
{

    private $_version = "0.1beta";
    //oauth Current validation mechanism by uid，If you want to get the current user id Use ApiModule::getUid();
    static private $_uid;
    static private $_oauth;
    private $_debug = false;
    public $db_dsn;
    
    public $connectionString,$username,$password,$server,$database;
    
    public static $defaultResponse = array('status'=>0,
                                    'code'=>400,
                                    'message'=>'Invalid request. Please check your http verb, action url and param'
                                    );
    public static $defaultSuccessResponse = array('status'=>1,
                                    'code'=>200,
                                    'message'=>'Success'
                                    );
    public static function setDefaultSuccessResponse($result = NULL)
    {
        if(!$result)
            return self::$defaultSuccessResponse;
        else
        {
            $arr = self::$defaultSuccessResponse;
            foreach ($result as $k=>$v)
            {
                if(isset($arr[$k]))
                {
                    $result[$k] = self::$defaultSuccessResponse[$k];
                }
            }
            return $result;
        }
    }
    public static function setDefaultUnSuccessResponse($result = NULL)
    {
        if(!$result)
            return self::$defaultResponse;
        else
        {
            $arr = self::$defaultResponse;
            foreach ($result as $k=>$v)
            {
                if(isset($arr[$k]))
                {
                    $result[$k] = self::$defaultResponse[$k];
                }
            }
            return $result;
        }
    }
    
    public function init()
    {
        Yii::app()->homeUrl = array('/api');

        $api_url = Yii::app()->createAbsoluteUrl('/api');

        define('SUB_DOMAIN_api',$api_url);

        // Set up CHttpException Processing action
        Yii::app()->errorHandler->errorAction = "api/default/error";

        // import the module-level models and components
        $this->setImport(array(
                'api.models.*',
                'api.components.*',
        ));
    }
    /*
    * Initialization oauth Package
    */
    public function oauth_init()
    {
        Yii::import('application.modules.api.vendors.*');

        require_once("oauth-php/library/OAuthServer.php");
        require_once("oauth-php/library/OAuthStore.php");
        
        #require_once("oauth-php/init.php");

//        $options = array(
//                'dsn'=>$this->connectionString,
//                'username'=>$this->username,
//                'password'=>$this->password
//        );
//        OAuthStore::instance('PDO', $options);
        
        $options = array('server' => $this->server, 
                        'username' => $this->username,
                        'password' => $this->password,  
                        'database' => $this->database);
        OAuthStore::instance('MySQL', $options);
    }    

    public function beforeControllerAction($controller, $action)
    {
        
        
        if(parent::beforeControllerAction($controller, $action))
        {                    
            $aDevController = array('oauth','default','client','session','test','site');//not need to authenticate
            $aPublicController = array('users','listings');//two-legged
            
            $this->oauth_init();
            
            if(!in_array($controller->id,$aDevController))
            {             
//                $oauth_version = $this->getParam('oauth_version');
                
//                $msg = 'consumerkey'. $this->consumer_key;
//			throw new CHttpException(401,$msg);
//                    exit();
                    
                if(in_array($controller->id,$aPublicController))//two-legged
                {
                    $this->authentication();
                }
                else//resource owner - three-legged
                {
                    $this->authorization();
                }                
        
            }
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    public function authentication()
    {
        if (OAuthRequestVerifier::requestIsSigned())
        {
//            $data = OAuthRequestLogger::getAllHeaders();
//            self::d($data);
//            exit();
            try
            {
                $req = new OAuthRequestVerifier();
                $user_id = $req->verify(false);
                
                // If we have an user_id, then login as that user (for this request)
                if ($user_id)
                {
                    self::setUid($user_id);
                    //This is oauth Access
                    self::$_oauth = true;
                        // **** Add your own code here ****              
                }
                else
                {
                    
                }
            }
            catch (OAuthException $e)
            {
                $msg = $e->getMessage();
                throw new CHttpException(401,$msg);
                exit();
            }
        }
        else
        {
            $msg = "Can't verify request, missing oauth_consumer_key or oauth_token";
			throw new CHttpException(401,$msg);
            exit();

        }
    }
    
    public function authorization()
    {        
            
//        $data = $_REQUEST;
//        $data = OAuthRequestLogger::getAllHeaders();
//        $data = $_SERVER;
//        $data = $_ENV;
//        $headers = array_merge($_ENV, $_SERVER);
//        $retarr = array();
//        foreach ($headers as $key => $val) {
//				//we need this header
//				if (strpos(strtolower($key), 'content-type') !== FALSE)
//					continue;
//				if (strtoupper(substr($key, 0, 5)) != "HTTP_")
//					unset($headers[$key]);
//					$headers[$key] = 'xxxxxxxxxxxxxxxxx';
//			}
                        
                        
//        Normalize this array to Cased-Like-This structure.
//		foreach ($headers AS $key => $value) {
//			$key = preg_replace('/^HTTP_/i', '', $key);
//			$key = str_replace(
//					" ",
//					"-",
//					ucwords(strtolower(str_replace(array("-", "_"), " ", $key)))
//				);
//			$retarr[$key] = $value;
//		}
//		ksort($retarr);
                
//        self::d($data);
//        exit();
        
       
        if (OAuthRequestVerifier::requestIsSigned())
        {
//            $data = $_SERVER;
//            self::d($data);
//            exit();
            try
            {
                $req = new OAuthRequestVerifier();
                $user_id = $req->verify();
                
                // If we have an user_id, then login as that user (for this request)
                if ($user_id)
                {
                    self::setUid($user_id);
                    //This is oauth Access
                    self::$_oauth = true;
                        // **** Add your own code here ****              
                }
                else
                {
                    
                }
            }
            catch (OAuthException $e)
            {
                $msg = $e->getMessage();
                throw new CHttpException(401,$msg);
                exit();
            }
        }
        else
        {
//            $data = $_REQUEST;
//            $data = OAuthRequestLogger::getAllHeaders();
//            $data = $_SERVER;
//            self::d($data);
//            exit();
            $msg = "Can't verify request, missing oauth_consumer_key or oauth_token";
			throw new CHttpException(401,$msg);
            exit();

        }
    }
    
    public static function json_encode_unicode($data) {
        if (defined('JSON_UNESCAPED_UNICODE')) {
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        return preg_replace_callback('/(?<!\\\\)\\\\u([0-9a-f]{4})/i',
            function ($m) {
                $d = pack("H*", $m[1]);
                $r = mb_convert_encoding($d, "UTF8", "UTF-16BE");
                return $r!=="?" && $r!=="" ? $r : $m[0];
            }, json_encode($data)
        );
    }

    /*
    * api Output data output json Format.
    */
    public static function sendResponse($data)
    {
        // $str = "無效請求";
        // $data = array("msg"=>$str);
        
        echo self::json_encode_unicode($data);
        exit;
    }

    public static function setUid($uid)
    {
        if(empty($uid))
        {
            $msg =  "authorization failed, missing login user id.";
			throw new CHttpException(401,$msg);
            exit();
        }
        //Signed in as yii user 
        self::$_uid = $uid;
    }

    public static function getUid()
    {
        return self::$_uid;
    }

    public function getParam($name,$default = '')
    {
        $req = new OAuthRequestVerifier();
        $value = $req->getParam($name);

        if(empty($value))
        {
                $value = Yii::app()->request->getParam($name,$default); 
        }
        return $value;
    }
}
