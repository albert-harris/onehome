<?php

/**
 * This is the model class for table "{{_pro_newsletter_mail}}".
 *
 * The followings are the available columns in table '{{_pro_newsletter_mail}}':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $subscriber_group_id
 * @property integer $newsletter_id
 * @property string $send_time
 */
class ProNewsletterMail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProNewsletterMail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_pro_newsletter_mail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subscriber_group_id, newsletter_id', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>256),
			array('send_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, subscriber_group_id, newsletter_id, send_time', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'subscriber_group_id' => 'Subscriber Group',
			'newsletter_id' => 'Newsletter',
			'send_time' => 'Send Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.subscriber_group_id',$this->subscriber_group_id);
		$criteria->compare('t.newsletter_id',$this->newsletter_id);
		$criteria->compare('t.send_time',$this->send_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

    /*
    public function activate()
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	*/

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
}