<?php

/**
 * This is the model class for table "{{_pro_transactions_bill_to}}".
 *
 * The followings are the available columns in table '{{_pro_transactions_bill_to}}':
 * @property string $id
 * @property string $transactions_id
 * @property integer $is_admin
 * @property integer $client_type_id
 * @property integer $bill_to_id
 * @property string $company_name
 * @property string $attn_to
 * @property string $commission_amount
 * @property string $commission_amount_gst
 * @property string $contact_no
 * @property string $billing_address
 * @property string $postal_code
 * @property integer $paying_to_external_co_broke
 * @property string $salesperson_name
 * @property string $nric_no
 */
class ProTransactionsBillTo extends CActiveRecord
{
    const TYPE_VENDOR_PURCHASER = 1;
    const TYPE_EXTERNAL_CO_BROKE = 2;
     
    /** model này dùng chung cho type = 1: Vendor & Purchaser, 2: External Co-broke
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{_pro_transactions_bill_to}}';
    }

    public function rules()
    {
        return array(
            array('company_name, salesperson_name,nric_no, contact_no,billing_address,postal_code', 
                'required', 'on'=>'AgentAddExternalCoBroke, AgentUpdateExternalCoBroke'),
            
            // Jan 21, 2015 Co-broke’s CEA No. should be optional
            array('company_name, salesperson_name, contact_no,billing_address,postal_code', 
                'required', 'on'=>'AgentAddExternalCoBrokeUnlisted, AgentUpdateExternalCoBrokeUnlisted'),
            // Jan 21, 2015 Co-broke’s CEA No. should be optional
            
            array('bill_to_id, attn_to, billing_address,postal_code, paying_to_external_co_broke', 
                'required', 'on'=>'CreateVendorPurchaser'),
            array('bill_to_id,company_name, attn_to,billing_address,postal_code, paying_to_external_co_broke', 
                'required', 'on'=>'CreateVendorPurchaserSolicitorSelected'),
            array('bill_to_id', 
                'required', 'on'=>'ExternalCoBrokeSelected'),
            array('company_name, attn_to, contact_no, billing_address', 'length', 'max'=>255),
            array('commission_amount, commission_amount_gst', 'length', 'max'=>18),
            array('postal_code, nric_no', 'length', 'max'=>50),
            array('salesperson_name', 'length', 'max'=>200),
            array('type, id, transactions_id, is_admin, client_type_id, bill_to_id, company_name, attn_to, commission_amount, commission_amount_gst, contact_no, billing_address, postal_code, paying_to_external_co_broke, salesperson_name, nric_no', 'safe'),
        );
    }

    public function relations()
    {
            return array(
            );
    }

    public function attributeLabels()
    {
        $res = array(
            'id' => 'ID',
            'transactions_id' => 'Transactions',
            'is_admin' => 'Is Admin',
            'client_type_id' => 'Client Type',
            'bill_to_id' => 'Bill To',
            'company_name' => 'Company Name',
            'attn_to' => 'Attn To',
			'commission_amount'=>'Commission Amount before GST',
			'commission_amount_gst'=>'Total Commission Amount after GST',
            'contact_no' => 'Contact No',
            'billing_address' => 'Billing Address',
            'postal_code' => 'Postal Code',
            'paying_to_external_co_broke' => 'Paying To External Co-Broke',
            'salesperson_name' => 'Salesperson Name',
            'nric_no' => 'CEA No',
//            'nric_no' => 'NRIC No',
        );
        
        return $res;
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.transactions_id',$this->transactions_id,true);
        $criteria->compare('t.is_admin',$this->is_admin);
        $criteria->compare('t.client_type_id',$this->client_type_id);
        $criteria->compare('t.bill_to_id',$this->bill_to_id);
        $criteria->compare('t.company_name',$this->company_name,true);
        $criteria->compare('t.attn_to',$this->attn_to,true);
        $criteria->compare('t.commission_amount',$this->commission_amount,true);
        $criteria->compare('t.commission_amount_gst',$this->commission_amount_gst,true);
        $criteria->compare('t.contact_no',$this->contact_no,true);
        $criteria->compare('t.billing_address',$this->billing_address,true);
        $criteria->compare('t.postal_code',$this->postal_code,true);
        $criteria->compare('t.paying_to_external_co_broke',$this->paying_to_external_co_broke);
        $criteria->compare('t.salesperson_name',$this->salesperson_name,true);
        $criteria->compare('t.nric_no',$this->nric_no,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public function defaultScope()
    {
            return array();
    }
    
    /**
     * @Author: ANH DUNG Mar 28, 2014
     * @Todo: search by transactions_id and type 1: Vendor & Purchaser, 2: External Co-broke
     * @Param: $transactions_id 
     * @Param: $type 1: Vendor & Purchaser, 2: External Co-broke
     * @Return: CActiveDataProvider
     */
    public static function searchByType($transactions_id, $type)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('t.transactions_id', $transactions_id);
        $criteria->compare('t.type', $type);

        return new CActiveDataProvider('ProTransactionsBillTo', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
        ));
    }      
    
    protected function beforeValidate() {
        $this->company_name = InputHelper::removeScriptTag($this->company_name);
        $this->attn_to = InputHelper::removeScriptTag($this->attn_to);
        $this->contact_no = InputHelper::removeScriptTag($this->contact_no);
        $this->billing_address = InputHelper::removeScriptTag($this->billing_address);
        $this->postal_code = InputHelper::removeScriptTag($this->postal_code);        
        $this->commission_amount = (float)str_replace(",", "", $this->commission_amount);
        $this->commission_amount_gst = (float)str_replace(",", "", $this->commission_amount_gst);
        
        return parent::beforeValidate();
    }
    
    /**
     * @Author: ANH DUNG Jul 09, 2014
     * @Todo: dùng để cập nhật cột bill_to cho type là external co broke
     * @Param: $mTransaction
     */    
    public static function UpdateBillTo($mTransaction){
        if($mBillTo = $mTransaction->rBillTo){
            $bill_to_id = ProTransactions::BILL_TO_EXTERNAL_CO_BROKE_COMMISSION;
            if($mBillTo->bill_to_id == ProTransactions::BILL_TO_EXTERNAL_CO_BROKE){
                $bill_to_id = ProTransactions::BILL_TO_EXTERNAL_CO_BROKE;
            }
            
            $criteria = new CDbCriteria();
            $criteria->compare('transactions_id', $mTransaction->id);
            $criteria->compare('type', ProTransactionsBillTo::TYPE_EXTERNAL_CO_BROKE);
            ProTransactionsBillTo::model()->updateAll(array('bill_to_id'=>$bill_to_id),
                    $criteria);
        }        
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: column: Commission Receivable from External Cobroke agent
     * @Param: $model model 
     */
    public static function SumReportExternalCobroke($mTransaction) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $mTransaction->id);
        $criteria->compare('t.type', ProTransactionsBillTo::TYPE_EXTERNAL_CO_BROKE);
        $criteria->compare('t.bill_to_id', ProTransactions::BILL_TO_EXTERNAL_CO_BROKE);
        $criteria->select = 'sum(t.commission_amount) as commission_amount';
        $criteria->group = 't.transactions_id';
        $model = self::model()->find($criteria);
        return $model->commission_amount;        
    }
    
    // if select bill_to_id == ProTransactions::BILL_TO_EXTERNAL_CO_BROKE
    public static function ResetVal($mBillTo){
        $mBillTo->attn_to = '';
        $mBillTo->commission_amount = 0;
        $mBillTo->commission_amount_gst = 0;
        $mBillTo->company_name = '';
        $mBillTo->contact_no = '';
        $mBillTo->billing_address = '';
        $mBillTo->postal_code = '';
        $mBillTo->paying_to_external_co_broke = 0;
    }
 
    /**
     * @Author: ANH DUNG Jul 16, 2014
     * @Todo: get “Commission Amount” của Transaction
     * @Param: $model model ProTransactionsBillTo::
     * @Return: number com
     */
    public static function getCommissionAmountTrans($model){
        $res = 0;
        if($model->type==ProTransactionsBillTo::TYPE_VENDOR_PURCHASER){
            $res = $model->commission_amount;
        }
        return $res;
    }
    
}