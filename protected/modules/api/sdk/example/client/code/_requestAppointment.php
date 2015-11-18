<?php
if(!empty($_SESSION['SFDOCTOR_TOKEN']))
{
    try
    {
        $tokenResultParams = $_SESSION['SFDOCTOR_TOKEN'];
                
        $params = array();
        if(!empty($_POST['doctor_id']))
        {
            $params['doctor_id'] = $_POST['doctor_id'];
        }
        else{
            $params['doctor_id'] = '';
        }
        
        echo '<pre>POST: '.$uriRequestAppointment.'<br/>';
            print_r($params);
            echo '</pre>';
            
            
          
        $postParams = array_merge($params, $tokenResultParams);
        
        $request = new OAuthRequester($uriRequestAppointment, 'POST', $postParams);
      
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