<?php

/**
 * @inheritdoc
 *
 * @author LH
 */
class ProAgent extends Users {
	
	public $limit=16;
	public $offset=0;
	public $sort='listing';
	public $key;
	public $total;
	
	/* register agent */
	public $uploadPhoto, $uploadNricFront, $uploadNricBack, 
		$uploadCertification, $updatedCea, $agreeTerm, $verifyCode;
	
	/*
	 * @var ProAgent[]
	 */
	public $items;
	
    public function attributeLabels() {
        return array(
			'title' => 'Salutation',
			'name_for_slug' => 'Business Name',
			'email_not_login' => 'Email',
			'phone' => 'Mobile No',
			'agent_cea' => 'CEA Registration Number',
			'location_id' => 'Districts',
			'uploadPhoto' => 'Upload photo',
			'uploadNricFront' => 'Upload NRIC (Front)',
			'uploadNricBack' => 'Upload NRIC (Back)',
			'uploadCertification' => 'Upload Verification Of agent\'s real estate certification',
		);
	}
	
	public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('limit, offset, sort, key', 'safe'),
			array('title, name_for_slug, phone, email_not_login, '
				. 'agent_cea, location_id, updatedCea, agreeTerm', 'required', 'on'=>'register',
				'message'=>'This is required field'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'register'),
			array('uploadPhoto, uploadNricFront, uploadNricBack', 'file', 'on'=>'register',
				'allowEmpty'=>true,
				'types'=> 'jpg,gif,png',
				'wrongType'=>'Only jpg,gif,png are allowed.',
				'maxSize' => ActiveRecord::getMaxFileSizeImage(), // 3MB
				'tooLarge' => 'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
			),
		);
	}
	
	public static function getFeaturedAgent() {
		$criteria = new CDbCriteria;
		$criteria->compare("role_id", ROLE_AGENT);
		$criteria->compare("status", STATUS_ACTIVE);
		$criteria->order = 'RAND()';
		$criteria->limit = 10;
		return self::model()->findAll($criteria);
	}
	
	public function searchAgent() {
		$criteria = new CDbCriteria;
		$criteria->select = 't.*';
		$criteria->compare("t.role_id", ROLE_AGENT);
		$criteria->compare("t.status", STATUS_ACTIVE);
		if ($this->key) {
			$criteria->addCondition('t.name_for_slug like :key OR t.phone LIKE :key');
			$criteria->params[':key'] = "%$this->key%";
		}
		$this->total = self::model()->count($criteria);

		$orders = array();
		$criteria->order = 't.created_date DESC';
		switch ($this->sort) {
			case 'name':
				$orders[] = 'name_for_slug';
				break;
			case 'listing':
				$criteria->join = 'LEFT JOIN {{_listing}} l ON l.user_id=t.id and l.status=1 and l.status_listing = 1';
				$criteria->group = 't.id';
				$orders[] = 'count(l.id) desc';
				break;
		}
		
		$orders[] = 't.created_date DESC';
		$criteria->order = implode(',', $orders);
//		$criteria->limit = $this->limit;
//		$criteria->offset = $this->offset;
		return $dataProvider=new CActiveDataProvider('ProAgent', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	}
	
	public function getListingCount() {
        $criteria = new CDbCriteria;
		$criteria->compare('user_id', $this->id);
        $criteria->compare('status', STATUS_ACTIVE);
        $criteria->compare('status_listing', STATUS_LISTING_ACTIVE);
        return Listing::model()->count($criteria);
	}
	
	public function getListingsDataProvider() {
        $criteria = new CDbCriteria;
		$criteria->compare('user_id', $this->id);
        $criteria->compare('status', STATUS_ACTIVE);
        $criteria->compare('status_listing', STATUS_LISTING_ACTIVE);
		
		return $dataProvider=new CActiveDataProvider('Listing', array(
			'criteria'=>$criteria,
//			'sort'=>array(
//				'defaultOrder'=>'date_listed DESC',
//			)
		));
	}
	
	static public function getForumLoginUrl($userId) {
		// check user is agent
		$forumUrl = trim(Yii::app()->params['forumUrl'], '/').'/ohlogin.php';
		$params = array('id' => $userId);
		return $forumUrl.'?'.http_build_query($params);
	}
	
	public function saveUploadFiles() {
		$this->saveUploadField('uploadPhoto', 'avatar');
		$this->saveUploadField('uploadNricFront', 'upload_nric_front');
		$this->saveUploadField('uploadNricBack', 'upload_nric_back');
		$this->saveUploadField('uploadCertification', 'upload_certification');
	}
	
	public function saveUploadField($formFieldName, $dbFieldName) {
		$file = $this->$formFieldName;
		if (!$file) return;

		$fileName = time() .'-'. (string)$file;
		$savePath = implode('/', array(Yii::getPathOfAlias('webroot'), static::$folderUpload, $this->id, $fileName));
		if (!file_exists(dirname($savePath))) {
			mkdir(dirname($savePath));
		}

		$file->saveAs($savePath);
		$this->$dbFieldName = $fileName;
		$this->update($dbFieldName);
	}
	
	public function getDistrictText() {
		return Yii::app()->format->formatEnum($this->location_id, ProLocation::getListDataLocation());
	}
}
