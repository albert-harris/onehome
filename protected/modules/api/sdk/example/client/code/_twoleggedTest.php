<?php

include_once "../../library/OAuthStore.php";
include_once "../../library/OAuthRequester.php";

// Test of the OAuthStore2Leg 

$key = 'admin'; // fill with your public key 
$secret = '123456'; // fill with your secret key
//$uri = "http://verzview.com/65verzview/api/test/api/"; // fill with the url for the oauth service
define('SFDOCTOR_HOST', 'http://65doc.verzview.com');
//define('SFDOCTOR_HOST', 'http://code.local/65doctormultilang');

$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
$oinstance = OAuthStore::instance("2Leg", $options);


//set this language OR get default language of website
$params = array('lang'=>'vi');

if(!empty($_GET['action']))
{
    switch ($_GET['action']) {
        case 'countrycode':
            $uri = SFDOCTOR_HOST.'/api/countryCode/';    
            $method = 'GET';
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            break;
        
        case 'specialties':
            $uri = SFDOCTOR_HOST.'/api/specialty/';    
            $method = 'GET';
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            break;
        
        case 'hospitals':
            $uri = SFDOCTOR_HOST.'/api/hospital/';    
            $method = 'GET';
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            break;
        
        case 'insurances':
            $uri = SFDOCTOR_HOST.'/api/insurance/';    
            $method = 'GET';
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            break;
        
        case 'timslots':
            $uri = SFDOCTOR_HOST.'/api/doctor/timeslot/';    
            $method = 'GET';
            if(isset($_POST['doctor_id']))
            {
                if(!empty($_POST['date']))
                {
                    $date = strtotime($_POST['date']);
                    if(!checkdate(date('m',$date), date('d',$date), date('Y',$date)))
                    {
                        echo '<pre>';
                        print_r('Invalid date');
                        echo '</pre>';
                        exit;
                    }
                
                }
                $params = array('lang'=>$_POST['lang'],
                                'doctor_id'=>$_POST['doctor_id'],
                                'date'=>strtotime($_POST['date']));
            }
            else
            {
                $params = array('lang'=>'vi','doctor_id'=>'532'); //use this param to get all - id=>doctor_id
                $params = array('lang'=>'vi','doctor_id'=>'532','date'=>strtotime('2013-05-24'));//OR use this param to get by date in the below
            }
            
           
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            
            break;
            
        case 'timeslotsinrange':
            $uri = SFDOCTOR_HOST.'/api/doctor/timeslot/';    
            $method = 'GET';
            if(isset($_POST['doctor_id']))
            {
                $date_from = '';
                $date_to = '';
                if(!empty($_POST['date_from']))
                {
                    $date_from = strtotime($_POST['date_from']);
                    if(!checkdate(date('m',$date_from), date('d',$date_from), date('Y',$date_from)))
                    {
                        echo '<pre>';
                        print_r('Invalid date');
                        echo '</pre>';
                        exit;
                    }
                
                }
                if(!empty($_POST['date_to']))
                {
                    $date_to = strtotime($_POST['date_to']);
                    if(!checkdate(date('m',$date_to), date('d',$date_to), date('Y',$date_to)))
                    {
                        echo '<pre>';
                        print_r('Invalid date');
                        echo '</pre>';
                        exit;
                    }
                
                }
                
                $params = array('lang'=>$_POST['lang'],
                                'doctor_id'=>$_POST['doctor_id'],
                                'date_from'=>$date_from,
                                'date_to'=>$date_to);
            }
            else
            {
                $params = array('lang'=>'vi','doctor_id'=>'532'); //use this param to get all - id=>doctor_id
                $params = array('lang'=>'vi','doctor_id'=>'532','date_from'=>strtotime('2013-07-24'), 'date_to'=>strtotime('2013-08-24'));//OR use this param to get by date in the below
            }
            
           
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            
            break;
            
        case 'doctorInfo':
            $uri = SFDOCTOR_HOST.'/api/doctor/';    
            $method = 'GET';
            if(isset($_POST['doctor_id']))
            {                
                $params = array('lang'=>$_POST['lang'],
                                'doctor_id'=>$_POST['doctor_id']
                        );
            }
            else
            {
                $params = array('lang'=>'vi','doctor_id'=>'532');               
            }
            
           
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            
            break;
        
        case 'search':
            $uri = SFDOCTOR_HOST.'/api/search/';  
            $method = 'GET';
            if(isset($_POST['specialty']))
            {
                $date = '';
                $date_from = '';
                $date_to = '';
                
                if(!empty($_POST['date']))
                {
                    $date = strtotime($_POST['date']);
                    if(!checkdate(date('m',$date), date('d',$date), date('Y',$date)))
                    {
                        echo '<pre>';
                        print_r('Invalid date');
                        echo '</pre>';
                        exit;
                    }
                
                }
                
                if(!empty($_POST['date_from']))
                {
                    $date_from = strtotime($_POST['date_from']);
                    if(!checkdate(date('m',$date_from), date('d',$date_from), date('Y',$date_from)))
                    {
                        echo '<pre>';
                        print_r('Invalid date from');
                        echo '</pre>';
                        exit;
                    }
                
                }
                if(!empty($_POST['date_to']))
                {
                    $date_to = strtotime($_POST['date_to']);
                    if(!checkdate(date('m',$date_to), date('d',$date_to), date('Y',$date_to)))
                    {
                        echo '<pre>';
                        print_r('Invalid date to');
                        echo '</pre>';
                        exit;
                    }
                
                }
                
                $params = array(
                    'doctor_id'=>$_POST['doctor_id'],
                    'specialty'=>$_POST['specialty'],
                    'hospital'=>$_POST['hospital'],
                    'insurance'=>$_POST['insurance'],
                    'appointment_today'=>$_POST['appointment_today'],
                    'male_doctor'=>$_POST['male_doctor'],
                    'female_doctor'=>$_POST['female_doctor'],
                    'doctor_clinic'=>$_POST['doctor_clinic'],
                    
                    'date'=>$date,
                    'date_from'=>$date_from,
                    'date_to'=>$date_to,
                    
                    'lang'=>$_POST['lang'],
                );
            }
            else
            {
                $params = array('lang'=>'vi');
                $params = array(
                    'doctor_id'=>532,
                    'specialty'=>45,
                    'hospital'=>'',
                    'insurance'=>'',
                    'appointment_today'=>'',
                    'male_doctor'=>'',
                    'female_doctor'=>'',
                    'doctor_clinic'=>'',
                );
            }
            
            
            
            echo '<pre>'.$method.': '.$uri.'<br/>';
            print_r($params);
            echo '</pre>';
            break;

        default:
            break;
    }
}
else
{
    echo '<pre>';
    print_r('Invalid action');
    echo '</pre>';
    exit;
}

try
{
    
    $request = new OAuthRequester($uri, $method, $params);
    $result = $request->doRequest();
  
    echo '<pre>';
    print_r(json_decode($result['body']));
    echo '</pre>';    
}
catch(OAuthException2 $e)
{
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    exit;
}

?>
