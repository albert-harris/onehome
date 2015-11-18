<?php

include_once "../../library/OAuthStore.php";
include_once "../../library/OAuthRequester.php";

// Test of the OAuthStore2Leg 

$key = 'admin'; // fill with your public key 
$secret = '123456'; // fill with your secret key
//$uri = "http://verzview.com/65verzview/api/test/api/"; // fill with the url for the oauth service
define('SFDOCTOR_HOST', 'http://verzview.com/65verzview');

$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
$oinstance = OAuthStore::instance("2Leg", $options);
$method = 'GET';
$uri = SFDOCTOR_HOST.'/api/search/';
$params = array(
                'specialty'=>45,
                'hospital'=>'',
                'insurance'=>'',
                'appointment_today'=>'',
                'male_doctor'=>'',
                'female_doctor'=>'',
                'doctor_clinic'=>'',
            );

//set this language OR get default language of website
//$params = array('lang'=>'vi');
//
//if(!empty($_GET['action']))
//{
//    switch ($_GET['action']) {
//        case 'specialties':
//            $uri = SFDOCTOR_HOST.'/api/specialty/';    
//            $method = 'GET';
//            break;
//        
//        case 'hospitals':
//            $uri = SFDOCTOR_HOST.'/api/hospital/';    
//            $method = 'GET';
//            $params = null;
//            break;
//        
//        case 'insurances':
//            $uri = SFDOCTOR_HOST.'/api/insurance/';    
//            $method = 'GET';
//            $params = null;
//            $params = array('lang'=>'vi');
//            break;
//        
//        case 'timslots':
//            $uri = SFDOCTOR_HOST.'/api/doctor/timeslot/';    
//            $method = 'GET';
//            $params = array('lang'=>'vi','id'=>'532'); //use this param to get all 
//            $params = array('lang'=>'vi','id'=>'532','date'=>strtotime('2013-05-24'));//OR use this param to get by date in the below
//
//            break;
//        
//        case 'search':
//            $uri = SFDOCTOR_HOST.'/api/search/';  
//            $method = 'GET';
//            $params = array('lang'=>'vi');
//            $params = array(
//                'specialty'=>45,
//                'hospital'=>'',
//                'insurance'=>'',
//                'appointment_today'=>'',
//                'male_doctor'=>'',
//                'female_doctor'=>'',
//                'doctor_clinic'=>'',
//            );
//            break;
//
//        default:
//            break;
//    }
//}
//else
//{
//    echo '<pre>';
//    print_r('Invalid action');
//    echo '</pre>';
//    exit;
//}

try
{
    $request = new OAuthRequester($uri, $method, $params);
    $result = $request->doRequest();
  
    echo '<pre>';
    print_r(json_decode($result['body']));
    echo '</pre>';
    exit;
}
catch(OAuthException2 $e)
{
    echo '<pre>';
    print_r($e);
    echo '</pre>';
    exit;
}

?>
