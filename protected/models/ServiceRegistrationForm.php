<?php

/**
 * @inheritdoc
 */
class ServiceRegistrationForm extends ServiceRegistration
{
	public $services = array();
	public $termAgree;
	public $fullname;
	
	public function rules()
	{
		$rules = array(
			array('property_type, room_type, room_size, 
				fullname, email, contact_no, time_contact, know_by',
				'required', 'on'=>'step1'),
			array('services', 'required', 'on'=>'step2'),
			array('email', 'email'),
//			array('termAgree', 'required', 'on'=>'step3', 'message'=>'You must agree with the Terms and Conditions'),
			array('services, property_type, room_type, room_size, fullname, email, contact_no, time_contact, know_by', 'safe'),
			
			array('services, salutation, property_type, room_type, room_size, fullname, email, contact_no, remark', 'required', 'on'=>'quick-register'),
		);
		return array_merge(parent::rules(), $rules);
	}
	
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), array(
			'fullname' => 'Your Name'
		));
	}
	
	public function getRegisteredServiceData() {
		$result = array();
		foreach($this->services as $sid) {
			$item = OurService::model()->findByPk($sid);
			if (!$item)
				continue;
			
			// item has no childs
			if (!$item->parent_id) {
				$result[$item->id] = array(
					'model' => $item,
					'childs' => array()
				);
				continue;
			}
			
			// child item
			if (!isset($result[$item->parent_id])) {
				$result[$item->parent_id] = array(
					'model' => $item->parent,
					'childs' => array()
				);
			}
			$result[$item->parent_id]['childs'][] = $item;
		}
		return $result;
	}
	
	public function save($runValidation = true, $attributes = null) {
		$transaction = Yii::app()->db->beginTransaction();		
		try {
			if (!parent::save($runValidation, $attributes)) {
				throw new CHttpException(500, 'Registration could not be saved.');
			}
			
			// remove items that has child
			$serviceIds = array_combine($this->services, $this->services);
			foreach($serviceIds as $sid) {
				$item = OurService::model()->findByPk($sid);
				if (!$item)
					throw new CHttpException(400, 'Request invalid.');
				if ($item->parent_id) {
					unset($serviceIds[$item->parent_id]);
				}
			}
			
			// save registered services
			foreach($serviceIds as $sid) {
				$m = new ServiceRegistrationItem();
				$m->service_id = $sid;
				$m->registration_id = $this->id;
				if (!$m->save()) {
					throw new CHttpException(500, 'Registration item could not be saved.');
				}
			}
			$transaction->commit();
		} catch (Exception $ex) {
			$transaction->rollBack();
			throw $ex;
		}
		return true;
	}
}
