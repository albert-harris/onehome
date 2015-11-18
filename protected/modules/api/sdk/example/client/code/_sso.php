<?php
try
{
	//  STEP 1:  If we do not have an OAuth token yet, go get one
	if (empty($_GET["oauth_token"]))
	{
		$getAuthTokenParams = array(
			'xoauth_displayname' => 'Oauth test',
			'oauth_callback' => SITE_URL.'/sso.php');

		// get a request token
		$tokenResultParams = OAuthRequester::requestRequestToken(SFDOCTOR_CONSUMER_KEY, 0, $getAuthTokenParams);

		//  redirect to the 65doctor authorization page, they will redirect back
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
		    // Something wrong with the oauth_token.
		    // Could be:
		    // 1. Was already ok
		    // 2. We were not authorized
		    return;
		}
		
                $_SESSION['SFDOCTOR_TOKEN'] = $tokenResultParams;
              
		// make the resource owner requestrequest.
//		$request = new OAuthRequester($uriProfile, 'GET', $tokenResultParams);
//		$result = $request->doRequest(0);
//		if ($result['code'] == 200) {
//			echo '<pre>';
//                        print_r(json_decode($result['body']));
//                        echo '</pre>';
//                        exit;
//		}
//		else {
//			echo 'Error';
//		}
                
                header("Location: " . SITE_URL . "/profile.php");
	}
}
catch(OAuthException2 $e) {
	echo "OAuthException:  " . $e->getMessage();
	echo '<pre>';
        print_r($e);
        echo '</pre>';
}

//}

?>