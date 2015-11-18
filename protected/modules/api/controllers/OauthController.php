<?php

class OauthController extends Controller
{
    public $validTimeSpanMinute;//auth
    
    private $_identity;
    public $errorCodeLoginForm;
    
    public function init()
    {
        parent::init();
        $this->validTimeSpanMinute = 5;
    }
    
    /*
    * To obtain a requeset token
    */
    public function actionRequest_token()
    {
        $server = new OAuthServer();
        $token = $server->requestToken();
        exit();
    }

    /*
    * To obtain a access token
    */
    public function actionAccess_token()
    {
        $server = new OAuthServer();
        /* ----------------------------------------------------------------- */
        $x_auth_mode = $this->module->getParam('x_auth_mode');
        if($x_auth_mode == 'client_auth')
        {
            $username = $this->module->getParam('x_auth_username');
            $password = $this->module->getParam('x_auth_password');
            $model=new LoginForm;
            $arr = array(
                'username'=>$username,
                'password'=>$password,
            );

            $model->attributes=$arr;
	        if($model->validate() && $model->login())
	        {
                $user_id = Yii::app()->user->id;
                $result = $server->xauthAccessToken($user_id);
                echo $result;exit();
	        }
        }
        /* ----------------------------------------------------------------- */
        $server->accessToken();
        exit();
    }

    /*
    * User login authentication
    */
    public function actionAuthorize()
    {
        $isValid = false;
        //Login User
//        $user_id = Yii::app()->user->id;
//        $model=new LoginForm;
//		$errmsg = '';
        // To obtain OAuth store and OAuth Server object
        $server = new OAuthServer();  
        try  
        {
            if(empty($_GET['username']) || empty($_GET['ctime']) || empty($_GET['signature']))
            {
//                throw new CHttpException(401,'Missing parametter.');
                $this->redirectResponse($server, 'Missing parametter');  
            }            
            
            $mUser = Users::model()->find('email="'.$_GET['username'].'"');
            if(!$mUser)
            {
                $this->redirectResponse($server, 'Email is invalid');   
            }
            $user_id = $mUser->id;
            
            
                        $this->_identity=new ApiUserIdentity($_GET['username'],$mUser->password_hash);
                        
                        $this->_identity->authenticate();
                       
                        $this->errorCodeLoginForm = $this->_identity->errorCode;
                        
                        switch($this->_identity->errorCode)
                        {
                            case ApiUserIdentity::ERROR_NONE:
                                    if($this->checkSignature($_GET['username'], $_GET['ctime'], $mUser->password_hash, $_GET['signature']))
                                    {
                                        $isValid = true;
                                        $duration = 0; // 30 days
                                        Yii::app()->user->login($this->_identity,$duration);
                                    }
                                    else
                                    {
//                                        $result = array('error'=>'Invalid request.');
//                                        ApiModule::sendResponse($result); 
                                        $this->redirectResponse($server, 'Invalid request');  
                                    }
                                    break;
                            case UserIdentity::ERROR_USERNAME_INVALID:
                                    $this->redirectResponse($server, 'Email is invalid');  
                                    break;
                                
                            case UserIdentity::ERROR_USERNAME_BLOCKED:
                                    $this->redirectResponse($server, 'Account is inactive'); 
                                    break;
                            case UserIdentity::ERROR_STATUS_WAIT_ACTIVE_CODE:   
                                    $this->redirectResponse($server, 'Account is not verified');  
                                    break;
                         
                            case UserIdentity::ERROR_PASSWORD_INVALID:
                                    $this->redirectResponse($server, 'Wrong password');  
                                    break;
                        }       
            
            // Check the current request contains a valid request token 
            // Returns an array containing consumer key, consumer secret, token, token secret And token type.  
            $rs = $server->authorizeVerify($user_id);

            if($isValid)
            {              
//                $oauth_callback = $server->getCallbackUrl();
//                $result = array('error'=>'Callback: '.$oauth_callback);
//                ApiModule::sendResponse($result);  
                
                $authorized = True;                
                $server->authorizeFinish($authorized, $user_id);
            }
            else
            {                
                $result = array('error'=>'Wrong username or password');
                ApiModule::sendResponse($result);  
            }
        }  
        catch (OAuthException $e)  
        {  
            $errmsg =  $e->getMessage();
            throw new CHttpException(401,$errmsg);
            // The request does not contain token, Display allows the user to input token To validate the page 
            // ** Your code **  
        }  
        catch (OAuthException2 $e)  
        {  
            $errmsg =  $e->getMessage();
            // Requested an error token 
            // ** Your code **  
            throw new CHttpException(401,$errmsg);
        }  

//        $data = array(
//            'rs'=>$rs,
//            'model'=>$model,
//            'errmsg'=>$errmsg
//        );
//        $this->render('Authorize',$data);
    }
    
    /*
    * User login authentication
    */
    public function actionAuthorize_BK()//3legged - password invisible to client
    {
        //Login User
        $user_id = Yii::app()->user->id;
//        $model=new LoginForm;
//		$errmsg = '';
        // To obtain OAuth store and OAuth Server object
        $server = new OAuthServer();  
        try  
        {  
            // Check the current request contains a valid request token 
            // Returns an array containing consumer key, consumer secret, token, token secret And token type.  
            $rs = $server->authorizeVerify($user_id);

            // Not allowed to jump are not logged in
            if(!empty($user_id))
            {                               
                
                $authorized = True;
                
                $server->authorizeFinish($authorized, $user_id);
                    
//                $data = array(
//                    'errmsg'=>'Are you allow'
//                );
//                $this->render('Authorize',$data);

                //When the application_type for system You can not be authorized by the user
//                if($rs['application_type'] == 'system')
//                {
//                    $authorized = True;
//                    $server->authorizeFinish($authorized, $user_id);
//                }
//
//                if ($_SERVER['REQUEST_METHOD'] == 'POST')  
//                {  
//                    
//                    // Determine whether the user clicked on the "allow" Button (or you can custom other identification)  
//                    $authorized = True;  
//                
//                    // Set up token Certification status (has been certified or not certified)  
//                    // If there are oauth_callback Parameters redirected to the customer (consumer side) address 
//                    $verifier = $server->authorizeFinish($authorized, $user_id);  
//                
//                    // If you do not oauth_callback Parameters, display certification results
//                    // ** Your code **  
////                    echo $verifier;die;
//                    echo '<pre>';
//                    print_r('xxx');
//                    echo '</pre>';
//                    exit;
//                }  
//                else  
//                {  
//                    echo 'Error';  
//                }  
            }
            else
            {                
                $pos = strpos(Yii::app()->request->requestUri,Yii::app()->baseUrl.'/');
                if ($pos !== false) {
                    $currentURI = substr_replace(Yii::app()->request->requestUri,'',$pos,strlen(Yii::app()->baseUrl.'/'));
                }
                
                $this->redirect(Yii::app()->createAbsoluteUrl('member/site/chooselogin').'?returnUrl='.urlencode($currentURI));
            }
        }  
        catch (OAuthException $e)  
        {  
            $errmsg =  $e->getMessage();
            throw new CHttpException(401,$errmsg);
            // The request does not contain token, Display allows the user to input token To validate the page 
            // ** Your code **  
        }  
        catch (OAuthException2 $e)  
        {  
            $errmsg =  $e->getMessage();
            // Requested an error token 
            // ** Your code **  
            throw new CHttpException(401,$errmsg);
        }  

//        $data = array(
//            'rs'=>$rs,
//            'model'=>$model,
//            'errmsg'=>$errmsg
//        );
//        $this->render('Authorize',$data);
    }
    
    
    /**
     * IN CASE OF:
     * password visible to client side
     */
    
    public function checkSignature($client_username, $client_ctime, $server_password, $client_signature)
    {    
        date_default_timezone_set('Asia/Singapore');  
        $aData = array('username'=>$client_username, 'ctime'=>$client_ctime);
        $server_signature = $this->getSignature($aData, $server_password);
        
        $server_ctime = strtotime(date('Y-m-d H:i:s'));
        
        if($server_signature == $client_signature && ($server_ctime - $client_ctime) < ($this->validTimeSpanMinute * 60))
            return true;
       return false;
        
    }
    
    /**
     * 
     * IN CASE OF:
     * password visible to client side
     * 
     * @param type $aData array of username, ctime
     * @param type $password
     * @return type
     *
     */
    public function getSignature($aData, $password)
    {
        $aData['ctime'] = (int)$aData['ctime'];
        return hash_hmac('sha1', json_encode($aData), $password);
    }
    
    /**
     * 
     * IN CASE OF:
     * password visible to client side
     */
    public function redirectResponse($oAuthServer, $errormsg)
    {
//        $result = array('error'=>'In rederectResponse');
//                ApiModule::sendResponse($result);
                
        $oauth_callback = $oAuthServer->getCallbackUrl();
//        echo '<pre>';
//        print_r($oauth_callback);
//        echo '</pre>';
//        exit;
        header("Location: ".$oauth_callback.'?error='.$errormsg);
//        header("Location: " . $oauth_callback);
    }
}
