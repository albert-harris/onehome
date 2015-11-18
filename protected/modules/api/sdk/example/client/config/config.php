<?php
ob_start();
include_once "../../library/OAuthStore.php";
include_once "../../library/SFSignature.php";
include_once "../../library/OAuthRequester.php";

define("SITE_URL", "http://code.local/sdk/example/client"); // 
//define("SITE_URL", "http://verzview.com/sdk/example/client"); // 


define("SFDOCTOR_CONSUMER_KEY", "7aa234432b1b30b3cc46f108fd98f3810519df3a6"); // 
define("SFDOCTOR_CONSUMER_SECRET", "506e474f77d7560ad0ff7ca49a231b1f"); // 

define("SFDOCTOR_OAUTH_HOST", "http://65doc.verzview.com/api");
define("SFDOCTOR_REQUEST_TOKEN_URL", SFDOCTOR_OAUTH_HOST . "/oauth/request_token");
define("SFDOCTOR_AUTHORIZE_URL", SFDOCTOR_OAUTH_HOST . "/oauth/authorize");
define("SFDOCTOR_ACCESS_TOKEN_URL", SFDOCTOR_OAUTH_HOST . "/oauth/access_token");

define('OAUTH_TMP_DIR', function_exists('sys_get_temp_dir') ? sys_get_temp_dir() : realpath($_ENV["TMP"]));

//request resource owner uri
$uriProfile = SFDOCTOR_OAUTH_HOST."/user/";
$uriMyAppointmentBookings = SFDOCTOR_OAUTH_HOST."/user/myAppointmentBookings/";
$uriMyDoctorAppoitment = SFDOCTOR_OAUTH_HOST."/user/myDoctorAppoitment/";
$uriCancelMyDoctorAppoitment = SFDOCTOR_OAUTH_HOST."/user/myDoctorAppoitment/";
$uriMyTimeslots = SFDOCTOR_OAUTH_HOST."/myTimeslot/index/";

$uriBookAppointment = SFDOCTOR_OAUTH_HOST."/appointment/book/";
$uriRequestAppointment = SFDOCTOR_OAUTH_HOST."/appointment/request/";


//  Init the OAuthStore
$options = array(
	'consumer_key' => SFDOCTOR_CONSUMER_KEY, 
	'consumer_secret' => SFDOCTOR_CONSUMER_SECRET,
	'server_uri' => SFDOCTOR_OAUTH_HOST,
	'request_token_uri' => SFDOCTOR_REQUEST_TOKEN_URL,
	'authorize_uri' => SFDOCTOR_AUTHORIZE_URL,
	'access_token_uri' => SFDOCTOR_ACCESS_TOKEN_URL
);
// Note: do not use "Session" storage in production. Prefer a database
// storage, such as MySQL.
OAuthStore::instance("Session", $options);
$id = 0;