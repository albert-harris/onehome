<?php

/**
 * This is the model class for table "{{_api_request_logs}}".
 *
 * The followings are the available columns in table '{{_api_request_logs}}':
 * @property string $id
 * @property string $method
 * @property string $content
 * @property string $created_date
 */
class ApiRequestLogs extends CActiveRecord {
		
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_api_request_logs}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_date', 'required'),
			array('method, content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, method, content, created_date', 'safe', 'on'=>'search'),
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
			'method' => Yii::t('translation','Method'),
			'content' => Yii::t('translation','Content'),
			'created_date' => Yii::t('translation','Created Date'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('method',$this->method,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created_date',$this->created_date,true);
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApiRequestLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return ApiRequestLogs::model()->count() + 1;
	}
        
        protected function beforeSave() {
            
            if(self::model()->count() > 200000)
                Yii::app()->db->createCommand("DELETE FROM `ecoin_api_request_logs` ORDER BY created_date ASC LIMIT 100000")->execute();
            return parent::beforeSave();
        }
}
