<?php
if(!empty($_SESSION['SFDOCTOR_TOKEN']))
{
    try
    {
        $tokenResultParams = $_SESSION['SFDOCTOR_TOKEN'];
        
        $params= array();
        if(!empty($_POST['datetime']))
        {
            
//            $date = strtotime($params['datetime']);
//            if(!checkdate(date('m',$date), date('d',$date), date('Y',$date)))
//            {
//                echo '<pre>';
//                print_r('Invalid date');
//                echo '</pre>';
//                exit;
//            }
            $params['datetime'] = $_POST['datetime'];
        }
        else
        {
            $params['datetime'] ='';
        }
        
        if(!empty($_POST['address_id']))
        {
            $params['address_id'] = $_POST['address_id'];            
        }
        else
        {
            $params['address_id'] ='';
        }
        
        
        
        echo '<pre>POST: '.$uriMyTimeslots.'<br/>';
            print_r($params);
            echo '</pre>';
            
        $paramsSend = array_merge($tokenResultParams, $params);
        $request = new OAuthRequester($uriMyTimeslots, 'POST', $paramsSend);
      
        $result = $request->doRequest(0);
        if ($result['code'] == 200) {
            echo '<pre>';
            print_r(json_decode($result['body']));
            echo '</pre>';
            exit;
        }
        else {
                echo 'Error';
        }
    }
    catch(OAuthException2 $e) {
        echo '<pre>';
        print_r('Error. Maybe you must login with 65dotor account.');
        echo '</pre>';
        
        echo '<pre>';
        print_r($e->getMessage());
        echo '</pre>';
        
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        
        exit;
    }
    
}
else
{
    echo '<pre>';
    print_r('You must login with 65dotor account.');
    echo '</pre>';
    exit;
}

?>