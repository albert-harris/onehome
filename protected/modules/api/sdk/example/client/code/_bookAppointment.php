<?php

if (!empty($_SESSION['SFDOCTOR_TOKEN'])) {
    try {
	$tokenResultParams = $_SESSION['SFDOCTOR_TOKEN'];

	$params = array();
	if (!empty($_POST['id'])) {
	    $params['id'] = $_POST['id'];
	    $params['doctor_id'] = $_POST['doctor_id'];
	    $params['i_am_the_patient'] = $_POST['i_am_the_patient']; //boolean
	    $params['patient_name'] = $_POST['patient_name']; //required if i_am_the_patient is false
	    $params['use_my_contact'] = $_POST['use_my_contact']; //boolean
	    $params['country_code'] = $_POST['country_code']; //required if use_my_contact is false
	    $params['patient_mobile'] = $_POST['patient_mobile']; //required if use_my_contact is false
	    $params['patient_email'] = $_POST['patient_email']; //required if use_my_contact is false
	    $params['i_am_a_new_patient'] = $_POST['i_am_a_new_patient']; //boolean
	    $params['note_to_doctor'] = $_POST['note_to_doctor']; //boolean
	} else {
	    $params['id'] = '';
	    $params['doctor_id'] = '';
	    $params['i_am_the_patient'] = ''; //boolean
	    $params['patient_name'] = ''; //required if i_am_the_patient is false
	    $params['use_my_contact'] = ''; //boolean
	    $params['country_code'] = ''; //required if use_my_contact is false
	    $params['patient_mobile'] = ''; //required if use_my_contact is false
	    $params['patient_email'] = ''; //required if use_my_contact is false
	    $params['i_am_a_new_patient'] = ''; //boolean
	    $params['note_to_doctor'] = ''; //boolean
	}

	
	$postParams = array_merge($params, $tokenResultParams);

	$request = new OAuthRequester($uriBookAppointment, 'POST', $postParams);

	$result = $request->doRequest(0);
	if ($result['code'] == 200) {
	    echo '<pre>';
	    print_r(json_decode($result['body']));
	    echo '</pre>';
	    exit;
	} else {
	    echo 'Error';
	}
    } catch (OAuthException2 $e) {
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
} else {
    echo '<pre>';
    print_r('You must login with 65dotor account.');
    echo '</pre>';
    exit;
}
?>