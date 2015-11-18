<?php

/**
 * This is the model class for table "{{_pro_call_log}}".
 *
 * The followings are the available columns in table '{{_pro_call_log}}':
 * @property integer $id
 * @property string $date
 * @property string $time_of_call
 * @property integer $received_by
 * @property string $description
 * @property integer $person_called
 * @property integer $transaction_id
 * @property integer $status
 */
class ProCallLog extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProCallLog the static model class
     */
    const CALL_TYPE_OTHER = 35;

    public static $ARR_PERSON_CALL_TYPE = array(
        ROLE_TENANT => 'Tenant',
        ROLE_LANDLORD => 'Landlord',
        ProCallLog::CALL_TYPE_OTHER => 'Others',
    );

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_pro_call_log}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('person_call_type,phone,date, received_by, description, person_called, transaction_id', 'required', 'on' => 'CreateCallsLog,UpdateCallsLog'),
            array('person_call_type,phone,id, date, time_of_call, received_by, description, person_called, transaction_id, status', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'transaction' => array(self::BELONGS_TO, 'ProTransactions', 'transaction_id'),
            'received' => array(self::BELONGS_TO, 'Users', 'received_by'),
            'person_call' => array(self::BELONGS_TO, 'Users', 'person_called'),
            'rTransactions' => array(self::BELONGS_TO, 'ProTransactions', 'transaction_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'date' => 'Date Time',
            'time_of_call' => 'Time Of Call',
            'received_by' => 'Received By',
            'description' => 'Description',
            'person_called' => 'Name',
            'person_call_type' => 'Person Call Type',
            'phone' => 'Mobile',
            'transaction_id' => 'Transaction',
            'status' => 'Status',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.time_of_call', $this->time_of_call, true);
        $criteria->compare('t.received_by', $this->received_by);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.person_called', $this->person_called);
        $criteria->compare('t.transaction_id', $this->transaction_id);
        $criteria->compare('t.status', $this->status);
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
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

    /**
     * @return CActiveDataProvider
     * <Jason>
     * <To get list call log for tencancy>
     */
    public static function getListCallLog($transaction_id,$role_id = NULL) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.transaction_id', $transaction_id);
        if(!empty($role_id)){
            $criteria->compare('t.person_call_type', $role_id);
        }
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = 'date ASC';

        return new CActiveDataProvider('ProCallLog', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    protected function beforeSave() {
        $this->date = MyFormat::InvoiceDateToDbDate($this->date);
        return parent::beforeSave();
    }

    //HTram August 18, 2015
    public static function getCallsLogByTransaction($transaction_id) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.transaction_id', $transaction_id);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = 'date ASC';

        $models = self::model()->findAll($criteria);
        if ($models) {
            return $models;
        }
        return;
    }

    //HTram August 18, 2015 
    //to do: use for show callslog at tenancy at FE
    public function searchFE() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.date', $this->date, true);
        $criteria->compare('t.time_of_call', $this->time_of_call, true);
        $criteria->compare('t.received_by', $this->received_by);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.person_called', $this->person_called);
        $criteria->compare('t.transaction_id', $this->transaction_id);
        $criteria->compare('t.status', $this->status);
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 8,
            ),
        ));
    }

}
