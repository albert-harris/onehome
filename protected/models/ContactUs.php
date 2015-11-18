<?php

/**
 * This is the model class for table "{{_contact_us}}".
 *
 * The followings are the available columns in table '{{_contact_us}}':
 * @property integer $id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $phone
 * @property string $email
 * @property integer $country_id
 * @property string $website
 * @property string $comment
 */
class ContactUs extends CActiveRecord
{
    public $confirm_email;
    public $validacion;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ContactUs the static model class
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
            return '{{_contact_us}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title, first_name, last_name, company_name, phone, email, country_id, website', 'required'),
            array('country_id', 'numerical', 'integerOnly'=>true),
            array('title, first_name, last_name, company_name', 'length', 'max'=>50),
            array('phone', 'length', 'max'=>20),            
            array('email', 'length', 'max'=>100),
            array('email', 'email','checkMX'=>true),
                        array('website, comment', 'length', 'max'=>255),
            array('confirm_email', 'email','checkMX'=>true),
            array('confirm_email', 'required', 'on'=>'create'),
            array('confirm_email', 'compare', 'compareAttribute'=>'email', 'on'=>'create'),
            array('validacion',
                'application.extensions.recaptcha.EReCaptchaValidator',
                'privateKey'=>Yii::app()->params['reCaptcha']['privateKey'], 'on'=>'create'
            ),
            array('id, title, first_name, last_name, company_name, phone, email, country_id, website, comment', 'safe'),
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
        'country'=>array(self::BELONGS_TO, 'Country', 'country_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'title' => 'Title',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'company_name' => 'Company Name',
                    'phone' => 'Phone',
                    'email' => 'Email',
                    'country_id' => 'Country',
                    'website' => 'Website',
                    'comment' => 'Comment',
        'validacion'=>'Verification Code',
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
            $criteria->compare('t.title',$this->title,true);
            $criteria->compare('t.first_name',$this->first_name,true);
            $criteria->compare('t.last_name',$this->last_name,true);
            $criteria->compare('t.company_name',$this->company_name,true);
            $criteria->compare('t.phone',$this->phone,true);
            $criteria->compare('t.email',$this->email,true);
            $criteria->compare('t.country_id',$this->country_id);
            $criteria->compare('t.website',$this->website,true);
            $criteria->compare('t.comment',$this->comment,true);
    $criteria->compare('t.status',$this->status);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
        'sort'=>array(
            'defaultOrder'=>'t.id DESC',
        ),
            ));
    }

    public function attended()
    {
        $this->status = 1;
        $this->update();
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