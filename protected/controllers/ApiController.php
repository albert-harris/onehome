<?php

/**
 * @author Lam Huynh
 */
class ApiController extends Controller {
	
	public function actionGetUserInfo($id) {
		$u = Users::model()->findByPk($id);
		if (!$u) exit('0');
		$data = array(
			'id' => $u->id,
			'username' => $u->nric_passportno_roc,
			'image' => $u->getAvatarUrl(90,90),
			'email' => $u->email,
			'fullname' => $u->name_for_slug,
		);
		echo json_encode($data);
	}
}
