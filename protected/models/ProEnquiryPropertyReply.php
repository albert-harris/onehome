<?php

/**
 * This is the model class for table "{{_pro_enquiry_property_reply}}".
 *
 * The followings are the available columns in table '{{_pro_enquiry_property_reply}}':
 * @property integer $id
 * @property integer $enquiry_property_id
 * @property string $subject
 * @property string $message
 * @property string $created_date
 */
class ProEnquiryPropertyReply extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProEnquiryPropertyReply the static model class
	 */

    public $email_to;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_pro_enquiry_property_reply}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, message, email_to', 'required'),
			array('enquiry_property_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, enquiry_property_id, subject, message, created_date, email_to', 'safe', 'on'=>'search'),
            array('id, enquiry_property_id, subject, message, created_date, email_to', 'safe'),
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
			'enquiry_property_id' => 'Enquiry Property',
			'subject' => 'Subject',
            'email_to' => 'To',
			'message' => 'Message',
			'created_date' => 'Created Date',
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
		$criteria->compare('t.enquiry_property_id',$this->enquiry_property_id);
		$criteria->compare('t.subject',$this->subject,true);
        $criteria->compare('t.email_to',$this->email_to,true);
		$criteria->compare('t.message',$this->message,true);
		$criteria->compare('t.created_date',$this->created_date,true);

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