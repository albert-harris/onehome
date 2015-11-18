<?php

/**
 * This is the model class for table "{{_fi_payment_voucher_detail}}".
 *
 * The followings are the available columns in table '{{_fi_payment_voucher_detail}}':
 * @property string $id
 * @property string $invoice_id
 * @property string $description
 * @property string $comm
 * @property string $gross_commission
 * @property string $amount
 */
class FiPaymentVoucherDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FiPaymentVoucherDetail the static model class
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
		return '{{_fi_payment_voucher_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transacion,invoice_no, invoice_id, description, comm, gross_commission, amount,client_type','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,transacion,invoice_no, invoice_id, description, comm, gross_commission, amount,client_type', 'safe'),
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
			'invoice_id' => 'Invoice',
			'description' => 'Description',
			'comm' => 'Comm',
			'gross_commission' => 'Gross Commission',
			'amount' => 'Amount',
			'client_type'=>'Client Type',
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
		$criteria->compare('t.invoice_id',$this->invoice_id,true);
		$criteria->compare('t.description',$this->description,true);
		$criteria->compare('t.comm',$this->comm,true);
		$criteria->compare('t.gross_commission',$this->gross_commission,true);
		$criteria->compare('t.amount',$this->amount,true);

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

	public static function saveDetailWithVoucherID($voucher_id,$data){
		if(is_array($data) && count($data)>0){
			FiPaymentVoucherDetail::model()->deleteAllByAttributes(array('voucher_id'=>$voucher_id));
			foreach($data as $itemDetail){
			 	$detail = new FiPaymentVoucherDetail();
			 	$detail->attributes = $itemDetail;
			 	if($detail->validate()){
			 		$detail->voucher_id   = $voucher_id;
			 		$detail->save();
			 	}
			}
		}
	}


	public static function getDataWithWithVoucherID($voucher_id,$type=null){
		$data = FiPaymentVoucherDetail::model()->findAllByAttributes(array('voucher_id'=>$voucher_id));
		$json = '';
		if($data && count($data)>0){
			foreach($data as $itemDetail){
				$attributes = $itemDetail->attributes;
				$json[]= json_encode($attributes);
			}
			if($type==null){
				if(count($json)>0){
					$json = implode(',',$json);
				}
			}
		}
                
		return $json;			
	}

	 protected function beforeSave() {
	 	$this->comm = str_replace(',','',trim($this->comm));
	 	$this->gross_commission = str_replace(',','',trim($this->gross_commission));
	 	$this->amount = str_replace(',','',trim($this->amount));

        return parent::beforeSave();
    }

}