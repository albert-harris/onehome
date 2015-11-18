<?php

/**
 * This is the model class for table "{{_pro_enquiry_property}}".
 *
 * The followings are the available columns in table '{{_pro_enquiry_property}}':
 * @property integer $id
 * @property integer $property_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $country_id
 * @property string $created_id
 */
class ProEnquiryProperty extends CActiveRecord {

    public $get_update;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProEnquiryProperty the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_pro_enquiry_property}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email, phone, country_id,description', 'required'),
            // Feb 05, 2015 => Remove all term and conditions of send enquiry of property
//            array('get_update', 'compare', 'compareValue' => 1, 'message' => 'Please check Terms & Conditions.'),
            array('name', 'length', 'max' => 50),
            array('email', 'length', 'max' => 100),
            array('email', 'email'),
            array('phone', 'length', 'max' => 20),
			array('phone', 'match', 'not' => false, 'pattern' => '/^\(?([0-9\+]{1,4})\)?\d{1,15}$/', 'message' => '{attribute} is not valid'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, property_id, name, email, phone, country_id, created_date, get_update, description, status', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'areaCode' => array(self::BELONGS_TO, 'AreaCode', 'country_id'),
            'listing' => array(self::BELONGS_TO, 'Listing', 'property_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'property_id' => 'Property',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'country_id' => 'Country',
            'description' => 'Description',
            'status' => 'Status',
            'created_date' => 'Created Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('listing');
        $criteria->compare('t.id', $this->id);
        $criteria->compare('listing.property_name_or_address', $this->property_id, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('t.phone', $this->phone, true);
        $criteria->compare('t.country_id', $this->country_id);
        $criteria->compare('t.created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'id' => 'DESC'
                ),
            ),
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
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

    public function defaultScope() {
        return array(
                //'condition'=>'',
        );
    }

    public static function getAllByUserId($user_id) {
        $criteria = new CDbCriteria;
        $criteria->with = array('listing');
        $criteria->compare('listing.user_id', $user_id);

        return new CActiveDataProvider('ProEnquiryProperty', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
            'sort' => array(
                'defaultOrder' => 't.created_date DESC'
            ),
        ));
    }

    public static function getItemById($id) {
        return self::model()->findByPk($id);
    }

    public static function getTotalWithUser($userID) {
        $arrListing = CHtml::listData(Listing::model()->findAllByAttributes(array('user_id' => $userID)), 'id', 'id');
        if (count($arrListing) > 0) {
            $criteria = new CDbCriteria;
            $criteria->compare('property_id', $arrListing);
            $criteria->compare('status', ENQUIRY_PROPERTY_NEW);
            $total = ProEnquiryProperty::model()->count($criteria);
            return $total;
        }
        return 0;
    }

}
