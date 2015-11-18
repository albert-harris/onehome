<?php

/**
 * This is the model class for table "{{_fi_invoice_receipt}}".
 *
 * The followings are the available columns in table '{{_fi_invoice_receipt}}':
 * @property string $id
 * @property string $invoice_id
 * @property string $created_date
 * @property string $receipt_name
 * @property string $receipt_nric
 * @property string $receipt_contact_no
 * @property string $receipt_date_paid
 */
class FiInvoiceReceipt extends CActiveRecord
{
    public $MAX_ID;
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_fi_invoice_receipt}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('payment_mode, receipt_name, receipt_nric, receipt_contact_no, receipt_date_paid', 'required', 'on'=>'GenerateReceipt'),
            array('receipt_name', 'length', 'max'=>200),
            array('receipt_nric, receipt_contact_no', 'length', 'max'=>100),
            array('cheque_number, payment_mode, id, invoice_id, created_date, receipt_name, receipt_nric, receipt_contact_no, receipt_date_paid', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rInvoice' => array(self::BELONGS_TO, 'FiInvoice', 'invoice_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'invoice_id' => 'Invoice',
                    'created_date' => 'Created Date',
                    'receipt_name' => 'Name',
                    'receipt_nric' => 'Nric',
                    'receipt_contact_no' => 'Contact No',
                    'receipt_date_paid' => 'Date Paid',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            $criteria=new CDbCriteria;
            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.invoice_id',$this->invoice_id,true);
            $criteria->compare('t.created_date',$this->created_date,true);
            $criteria->compare('t.receipt_name',$this->receipt_name,true);
            $criteria->compare('t.receipt_nric',$this->receipt_nric,true);
            $criteria->compare('t.receipt_contact_no',$this->receipt_contact_no,true);
            $criteria->compare('t.receipt_date_paid',$this->receipt_date_paid,true);

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
    
    protected function beforeSave() {
        if($this->isNewRecord){
            $prefix_code_invoice = "REC".date('y').date('m');
            $this->receipt_no = MyFormat::getNextId('FiInvoiceReceipt',$prefix_code_invoice,'receipt_no',ProTransactions::LENGTH_TRANS_NO);
            $this->created_by = Yii::app()->user->id;
        }
        if(!empty($this->receipt_date_paid) && strpos($this->receipt_date_paid, '/')){
            $this->receipt_date_paid = MyFormat::dateConverDmyToYmd($this->receipt_date_paid);
        }
        return parent::beforeSave();
    }
    
    protected function afterSave() {
        FiInvoice::UpdateFieldInvoice($this->rInvoice, 'date_paid', $this->receipt_date_paid);
        return parent::afterSave();
    }
    
    /**
     * @Author: ANH DUNG Sep 22, 2014
     * @Todo: something
     * @Param: $model
    */
    public static function CanUpdate($model) {
        if(Yii::app()->user->role_id != ROLE_ADMIN){
            if(Yii::app()->user->id != $model->user_id){
                return false;
            }
        }
        return true;
    }
    
    public static function DeleteByInvoiceId($invoice_id){
        $criteria = new CDbCriteria();
        $criteria->compare("invoice_id", $invoice_id);
        self::model()->deleteAll($criteria);
    }
}