<?php

/**
 * Display service quick registration form
 *
 * @author Lam Huynh
 */
class ServiceFormWidget extends CWidget {

	public $serviceId;
	
	public function run() {
		$model = new ServiceRegistrationForm('quick-register');
		$this->render('service-form-widget', array('model'=>$model));
	}
	
}
