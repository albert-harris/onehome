<?php

/**
 * This is the model class for table "{{_users_tokens}}".
 *
 * The followings are the available columns in table '{{_users_tokens}}':
 * @property string $id
 * @property string $user_id
 * @property string $token
 * @property string $last_login
 * @property integer $has_expired
 */
class UsersTokens extends CActiveRecord {
		
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_users_tokens}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, token', 'required'),
			array('has_expired', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			array('last_login, language, apns_device_token, gcm_device_token', 'safe'),
		 array('user_id,token,has_expired', 'required', 'on' => 'create, update'), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, token, last_login, has_expired', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
	
																						);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'user_id' => Yii::t('translation','User'),
			'token' => Yii::t('translation','Token'),
			'last_login' => Yii::t('translation','Last Login'),
			'has_expired' => Yii::t('translation','Has Expired'),
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
        
        public function checkToken($token)
        {
            $criteria = new CDbCriteria;
            $criteria->compare('t.token', $token);
            $criteria->compare('t.has_expired', 0);
            if (self::model()->count($criteria) > 0)
                return true;
            return false;
        }
        public function getByToken($user_id, $token)
        {
            $criteria = new CDbCriteria;
            $criteria->compare('t.user_id', $user_id);
            $criteria->compare('t.token', $token);
            $criteria->compare('t.has_expired', 0);
            return self::model()->find($criteria);
        }
        public function getLanguage($user_id, $token)
        {
            $criteria = new CDbCriteria;
            $criteria->compare('t.user_id', $user_id);
            $criteria->compare('t.token', $token);
            $criteria->compare('t.has_expired', 0);
            $model = self::model()->find($criteria);
            if($model && !empty($model->language))
            	return $model->language;
        	return '';
        }
        public function updateLanguage($user_id, $token, $lang)
        {
            $criteria = new CDbCriteria;
            $criteria->compare('user_id', $user_id);
            $criteria->compare('token', $token);
            $criteria->compare('has_expired', 0);
            self::model()->updateAll(array('language'=>$lang), $criteria);
        }
        public function getByUserID($user_id)//for apns
        {
            $criteria = new CDbCriteria;
            $criteria->select = 'DISTINCT t.apns_device_token, t.gcm_device_token';
            $criteria->compare('t.user_id', $user_id);
            $criteria->compare('t.has_expired', 0);
            $criteria->addCondition('t.apns_device_token <>"" OR t.gcm_device_token <> ""');
            $models = self::model()->findAll($criteria);
            if ($models)
                return $models; 
            return array();
        }
        
        
}
