<?php

/**
 * This is the model class for table "{{_fi_payment_voucher}}".
 *
 * The followings are the available columns in table '{{_fi_payment_voucher}}':
 * @property string $id
 * @property string $voucher_no
 * @property integer $pay_to
 * @property string $user_id
 * @property string $user_name
 * @property string $user_billing_address
 * @property string $user_postal_code
 * @property string $total_amount
 * @property integer $status
 * @property string $created_date
 */
class FiPaymentVoucher extends CActiveRecord
{
    public $MAX_ID;
    
    const FI_PAYTO_SELLER = 1;
    const FI_PAYTO_CO_BROKE = 3;
    const FI_PAYTO_SALESPERSON = 6;
    const FI_PAYTO_OTHER = 5;
    
    const FI_PAYTO_PURCHASER = 7;
    const FI_PAYTO_LANDLORD = 8;
    const FI_PAYTO_TENANT = 9;
    
    public static $STATUS_PAY_TO = array(
        FiPaymentVoucher::FI_PAYTO_SELLER =>'Vendor', // Replace Seller with Vendor. 
        FiPaymentVoucher::FI_PAYTO_CO_BROKE=>'Co-broke',
        FiPaymentVoucher::FI_PAYTO_SALESPERSON=>'Salesperson',
        FiPaymentVoucher::FI_PAYTO_PURCHASER=>'Purchaser',
        FiPaymentVoucher::FI_PAYTO_LANDLORD=>'Landlord',
        FiPaymentVoucher::FI_PAYTO_TENANT=>'Tenant',
        FiPaymentVoucher::FI_PAYTO_OTHER=>'Others',
    );    
    const LENGTH_TRANS_NO=8;

    // ANH DUNG SEP 12, 2014
    public $month_paid;
    public $year_paid;
    public $count_record;
    // ANH DUNG SEP 12, 2014

    const PAYMENT_MODE_CASH = 1;
    const PAYMENT_MODE_CHEQUE = 2;
    const PAYMENT_MODE_OCBC_GIRO = 3;

    public static $ARR_PAYMENT_MODE = array(
        FiPaymentVoucher::PAYMENT_MODE_CASH => "Cash",
        FiPaymentVoucher::PAYMENT_MODE_CHEQUE => "Cheque",
        FiPaymentVoucher::PAYMENT_MODE_OCBC_GIRO => "OCBC Giro",
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return FiPaymentVoucher the static model class
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
            return '{{_fi_payment_voucher}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('payment_mode, pay_to,created_date,user_name', 'required','on'=>'create_voucher,update_voucher'),
            array('pay_to, status', 'numerical', 'integerOnly'=>true),
            array('voucher_no', 'length', 'max'=>30),
            array('user_id', 'length', 'max'=>11),
            array('user_name', 'length', 'max'=>200),
            array('user_billing_address', 'length', 'max'=>300),
            array('user_postal_code', 'length', 'max'=>100),
            array('total_amount', 'length', 'max'=>16),
            array('nric,cheque_number, payment_mode, id, voucher_no, pay_to, user_id, user_name, user_billing_address, user_postal_code, total_amount, status, created_date', 'safe'),
            array('date_paid,bank_reference_no', 'safe'),
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
        'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
        'rDetail' => array(self::HAS_MANY, 'FiInvoiceDetail', 'invoice_id',
            'order'=>'rDetail.id ASC',
        ),
    );

    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'voucher_no' => 'PV No#',
            'pay_to' => 'Pay To',
            'user_id' => 'User',
            'user_name' => 'Name',
            'user_billing_address' => 'Billing Address',
            'user_postal_code' => 'Postal Code',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
            'created_date' => 'Paid Date#',
            'nric' => 'NRIC',
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

            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.voucher_no',trim($this->voucher_no),true);
            $criteria->compare('t.pay_to',$this->pay_to);
            $criteria->compare('t.user_id',trim($this->user_id),true);
            $criteria->compare('t.user_name',trim($this->user_name),true);
            $criteria->compare('t.user_billing_address',trim($this->user_billing_address),true);
            $criteria->compare('t.user_postal_code',trim($this->user_postal_code),true);
            $criteria->compare('t.total_amount',$this->total_amount,true);
            $criteria->compare('t.status',$this->status);
            $criteria->compare('t.created_date',$this->created_date,true);
            $criteria->order = 't.id desc';
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


    public static function converData($data){
            $json = '';
            if(is_array($data)&&count($data)>0){
                     foreach ($data as $key => $value) {
                            $json[]= json_encode($value);
                    }	
                    if(count($json)>0){
                            $json = implode(',',$json);
                    }		
            }
            return $json;		
    }

    protected function beforeSave() {
        if($this->isNewRecord){
            $this->voucher_no = MyFormat::getNextId('FiPaymentVoucher','PV','voucher_no',FiPaymentVoucher::LENGTH_TRANS_NO);
            $this->created_by = Yii::app()->user->id;
        }
        
        if(!empty($this->date_paid) && strpos($this->date_paid, '/')){
            $this->date_paid = MyFormat::dateConverDmyToYmd($this->date_paid);
        }
        $this->total_amount = str_replace(',','',trim($this->total_amount));
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Sep 22, 2014
     * @Todo: something
     * @Param: $model
    */
    public static function CanUpdate($model) {
        // ANH DUNG CLOSE MAR 02. 2015
//        if(Yii::app()->user->role_id != ROLE_ADMIN){
//            if(Yii::app()->user->id != $model->user_id){
//                return false;
//            }
//        }
        return true;
    }     

    public static function getStatus($status){
    	$data =FiPaymentVoucher::$STATUS_PAY_TO;
    	if(isset($data[$status])){
    		return $data[$status];
    	} 
    }

}