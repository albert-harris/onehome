<?php
if(!empty($_SESSION['SFDOCTOR_TOKEN']))
{
    try
    {
        echo '<pre>GET: '.$uriMyDoctorAppoitment.'<br/>';
            print_r('');
            echo '</pre>';
            
        $tokenResultParams = $_SESSION['SFDOCTOR_TOKEN'];
        $request = new OAuthRequester($uriMyDoctorAppoitment, 'GET', $tokenResultParams);
      
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