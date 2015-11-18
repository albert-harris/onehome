<?php

//$ch = curl_init() or die(curl_error());
////curl_setopt($ch, CURLOPT_POST,1);
////curl_setopt($ch, CURLOPT_POSTFIELDS,'a=a'); 
////curl_setopt($ch, CURLOPT_URL,"http://verzview.com/65verzview/api/test/api");
//curl_setopt($ch, CURLOPT_URL,"http://verzview.com/65verzview/test/index/");
////curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$rs= curl_exec($ch) or die(curl_error()); 
//
//echo '<pre>';
//print_r($rs);
//echo '</pre>';
//exit;
//exit;



//================================


include_once "../../library/OAuthStore.php";
include_once "../../library/OAuthRequester.php";

// Test of the OAuthStore2Leg 

$key = 'admin'; // fill with your public key 
$secret = '123456'; // fill with your secret key
//$url = "http://verzview.com/65api/api/test/api"; // fill with the url for the oauth service
$url = "http://verzview.com/65verzview/api/test/api/"; // fill with the url for the oauth service
//$urlLang = "http://verzview.com/65api/api/test/api?lang=en"; // 


//list api uri BEGIN
//$lang = '/lang/en';
//define('SFDOCTOR_HOST', 'http://verzview.com/65api');
define('SFDOCTOR_HOST', 'http://verzview.com/65verzview');

//set this language OR get default language of website
$params = array('lang'=>'vi');

//1.List Specialties
$urlListSpecialties = SFDOCTOR_HOST.'/api/specialty/';

//2. List Hostpitals
$urlListHospitals = SFDOCTOR_HOST.'/api/hospital/';

//3. List Insurances
$urlListInsurances = SFDOCTOR_HOST.'/api/insurance/';

//4. List timeslot of doctor
$urlListDoctorTimeslot = SFDOCTOR_HOST.'/api/doctor/timeslot/';
    $params = array('lang'=>'vi','id'=>'532'); //use this param to get all 
    $params = array('lang'=>'vi','id'=>'532','date'=>strtotime('2013-05-24'));//OR use this param to get by date in the below

//5. Search by params 
$urlSearchDoctor = SFDOCTOR_HOST.'/api/search/';
$params = array(
                'specialty'=>45,
                'hospital'=>'',
                'insurance'=>'',
                'appointment_today'=>'',
                'male_doctor'=>'',
                'female_doctor'=>'',
                'doctor_clinic'=>'',
            );
//list api uri END


$options = array('consumer_key' => $key, 'consumer_secret' => $secret);
$oinstance = OAuthStore::instance("2Leg", $options);


try
{
    $request = new OAuthRequester($urlSearchDoctor, 'GET', $params);
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
