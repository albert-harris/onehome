<?php

include_once "../../library/OAuthStore.php";
include_once "../../library/OAuthRequester.php";

define("SFDOCTOR_CONSUMER_KEY", "admin"); // 
define("SFDOCTOR_CONSUMER_SECRET", "123456"); // 

define("SFDOCTOR_OAUTH_HOST", "http://verzview.com/65verzview/api");
define("SFDOCTOR_REQUEST_TOKEN_URL", SFDOCTOR_OAUTH_HOST . "/oauth/request_token");
define("SFDOCTOR_AUTHORIZE_URL", SFDOCTOR_OAUTH_HOST . "/oauth/authorize");
define("SFDOCTOR_ACCESS_TOKEN_URL", SFDOCTOR_OAUTH_HOST . "/oauth/access_token");

define('OAUTH_TMP_DIR', function_exists('sys_get_temp_dir') ? sys_get_temp_dir() : realpath($_ENV["TMP"]));

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
try
{
	//  STEP 1:  If we do not have an OAuth token yet, go get one
	if (empty($_GET["oauth_token"]))
	{
            
		$getAuthTokenParams = array(
			'xoauth_displayname' => 'Oauth test',
			'oauth_callback' => 'http://code.local/sdk/example/client/threelegged.php');

		// get a request token
		$tokenResultParams = OAuthRequester::requestRequestToken(SFDOCTOR_CONSUMER_KEY, 0, $getAuthTokenParams);

		//  redirect to the google authorization page, they will redirect back
		header("Location: " . SFDOCTOR_AUTHORIZE_URL . "?oauth_token=" . $tokenResultParams['token']);
	}
	else 
        {
		//  STEP 2:  Get an access token
		$oauthToken = $_GET["oauth_token"];
		
		// echo "oauth_verifier = '" . $oauthVerifier . "'<br/>";
		$tokenResultParams = $_GET;
		
		try {
		    OAuthRequester::requestAccessToken(SFDOCTOR_CONSUMER_KEY, $oauthToken, 0, 'POST', $_GET);
		}
		catch (OAuthException2 $e)
		{
                    echo '<pre>';
                    print_r($e);
                    echo '</pre>';
                    exit;
		    // Something wrong with the oauth_token.
		    // Could be:
		    // 1. Was already ok
		    // 2. We were not authorized
		    return;
		}
		
		// make the resource owner requestrequest.
		$request = new OAuthRequester("http://verzview.com/65verzview/api/user/test", 'POST', $tokenResultParams);
		$result = $request->doRequest(0);
		if ($result['code'] == 200) {
			var_dump($result['body']);
		}
		else {
			echo 'Error';
		}
	}
}
catch(OAuthException2 $e) {
	echo "OAuthException:  " . $e->getMessage();
	echo '<pre>';
        print_r($e);
        echo '</pre>';
        exit;
}
?>