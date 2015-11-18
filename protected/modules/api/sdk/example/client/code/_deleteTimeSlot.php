<?php
if(!empty($_SESSION['SFDOCTOR_TOKEN']))
{
    try
    {
        $tokenResultParams = $_SESSION['SFDOCTOR_TOKEN'];
        $params= array();
        if(!empty($_POST['appt_id']))
        {
            $params['id']= $_POST['appt_id'];
        }
        else{
            $params['id']='';
        }
        echo '<pre>DELETE: '.$uriMyTimeslots.'<br/>';
            print_r($params);
            echo '</pre>';
            
        $tokenResultParams['id'] = $params['id'];//id to delte
        
        $request = new OAuthRequester($uriMyTimeslots, 'DELETE', $tokenResultParams);
      
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