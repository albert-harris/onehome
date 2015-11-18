<?php

/**
 * This is the model class for table "{{_fi_invoice_detail}}".
 *
 * The followings are the available columns in table '{{_fi_invoice_detail}}':
 * @property string $id
 * @property string $invoice_id
 * @property string $amount
 * @property string $property_type_id
 * @property string $unit_from
 * @property string $unit_to
 * @property string $house_blk_no
 * @property string $street_name
 * @property string $postal_code
 */
class FiInvoiceDetail extends CActiveRecord
{	
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_fi_invoice_detail}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('property_type_id, unit_from, unit_to, house_blk_no,street_name', 'required', 'on'=>"AddProperty"),
            array('amount', 'numerical', 'tooSmall'=>"Amount shouldn't be zero", 'min' => 1, 'on'=>"validate_detail"),
            array('amount', 'length', 'max'=>16),
            array('unit_from, unit_to', 'length', 'max'=>50),
            array('house_blk_no', 'length', 'max'=>300),
            array('street_name', 'length', 'max'=>200),
            array('postal_code', 'length', 'max'=>100),
            array('description, id, invoice_id, amount, property_type_id, unit_from, unit_to, house_blk_no, street_name, postal_code', 'safe'),
            array('buiding_name', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(                
            'rPropertyType' => array(self::BELONGS_TO, 'ProPropertyType', 'property_type_id'),
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
            'amount' => 'Amount',
            'property_type_id' => 'Property Type',
            'unit_from' => 'Unit',
            'unit_to' => 'Unit',
            'house_blk_no' => 'House/Blk No',
            'street_name' => 'Street Name',
            'postal_code' => 'Postal Code',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            // Warning:  Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.invoice_id',$this->invoice_id,true);
            $criteria->compare('t.amount',$this->amount,true);
            $criteria->compare('t.property_type_id',$this->property_type_id,true);
            $criteria->compare('t.unit_from',$this->unit_from,true);
            $criteria->compare('t.unit_to',$this->unit_to,true);
            $criteria->compare('t.house_blk_no',$this->house_blk_no,true);
            $criteria->compare('t.street_name',$this->street_name,true);
            $criteria->compare('t.postal_code',$this->postal_code,true);

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
    
    /**
     * @Author: ANH DUNG Sep 11, 2014
     * @Todo: fnBuildDescription
     * @Param: $model model FiInvoiceDetail
     * @Return: string desc
     */
    public static function fnBuildDescription($model){
//        if(empty($model->id)) return ''; // remove at Oct 21, 2014
//        $model = self::model()->findByPk($model->id); // remove at Oct 21, 2014
        $res = '';
        if(is_null($model->rPropertyType)) return '';
        $property_name = $model->rPropertyType?$model->rPropertyType->name:'';
        if(!empty($property_name))
            $res .= "$property_name, ";
        
        if(!empty($model->unit_from))
            $res .= "$model->unit_from ";
        
        if(!empty($model->unit_to))
            $res .= " - $model->unit_to";
        
        if(!empty($model->house_blk_no))
            $res .= ", $model->house_blk_no";
        
        if(!empty($model->street_name))
            $res .= ", $model->street_name";
        
        if(!empty($model->buiding_name))
            $res .= ", $model->buiding_name";
        
        if(!empty($model->postal_code))
            $res .= ", $model->postal_code";
        
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: fnBuildDescription for print invoice
     * @Param: $model model FiInvoiceDetail
     * @Return: string desc
     */
    public static function fnBuildDescriptionPrint($model){
        $res = '';
        if(is_null($model->rPropertyType)) return '';
        $property_name = $model->rPropertyType?$model->rPropertyType->name:'';
        
        if(!empty($model->house_blk_no))
            $res .= "$model->house_blk_no";
        if(!empty($model->street_name))
            $res .= ", $model->street_name";
        if(!empty($model->unit_from))
            $res .= "$model->unit_from ";        
        if(!empty($model->unit_to))
            $res .= " - $model->unit_to";
        if(!empty($model->buiding_name))
            $res .= ", $model->buiding_name";
        
        $res .= ", Singapore";
        
        if(!empty($model->postal_code))
            $res .= ", $model->postal_code";
        
        return $res;
    }
    
    protected function beforeSave() {
        $this->description = FiInvoiceDetail::fnBuildDescription($this);
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Sep 11, 2014
     * @Todo: cập nhật invoice_id cho mảng invoice_id_detail
     * @Param: $aId array id detail
     */
    public static function fnUpdateInvoiceId($aId, $invoice_id){
        if(count($aId)<1) return ;
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $aId);
        self::model()->updateAll(array('invoice_id'=>$invoice_id),
                    $criteria);        
    }
    
    /**
     * @Author: ANH DUNG Sep 11, 2014
     * @Todo: cập nhật amount cho mảng invoice_id_detail
     * @Param: $model model FiInvoiceDetail
     */    
    public static function fnUpdateAmount($model){
        $sql='';
        $tableName = self::model()->tableName();
        if(isset($_POST['FiInvoiceDetail']['id']) && is_array($_POST['FiInvoiceDetail']['id'])  && count($_POST['FiInvoiceDetail']['id'])){
            foreach($_POST['FiInvoiceDetail']['id'] as $key=>$pk){
                $amount = isset($_POST['FiInvoiceDetail']['amount'][$key])?$_POST['FiInvoiceDetail']['amount'][$key]:0;
                $amount_gst = self::getAmountGstOfDetail($amount);
                if($pk){
                    $sql .= "UPDATE $tableName SET "
                        . " `amount`=\"$amount\", "
                        . " `amount_gst`=\"$amount_gst\" "
                        . "WHERE `id`=$pk ;";
                }
            }
        }
        if(trim($sql)!='')
            Yii::app()->db->createCommand($sql)->execute();
    }
    
    public static function DeleteByInvoiceId($invoice_id){
        $criteria = new CDbCriteria();
        $criteria->compare("invoice_id", $invoice_id);
        self::model()->deleteAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Oct 21, 2014
     * @Todo: getAmountGstOfDetail
     * @Param: $amount
     */
    public static function getAmountGstOfDetail($amount) {
        $gst = Yii::app()->params['gst'];
        $amount_gst = ($amount*$gst*1)/100;
        return $amount_gst*1+$amount*1;
    }
    
    /**
     * @Author: ANH DUNG Sep 11, 2014
     * @Todo: xóa mảng những id dc remove dưới giao diện
     * @Param: $model model FiInvoice
     */
    public static function deleteDetail($model){
        if(!is_array($_POST['FiInvoiceDetail']['id']) || count($_POST['FiInvoiceDetail']['id'])<1) return;
        $criteria = new CDbCriteria();
        $criteria->addNotInCondition("id", $_POST['FiInvoiceDetail']['id']);
        $criteria->compare("invoice_id", $model->id);
        self::model()->deleteAll($criteria);
    }    
    
    /**
     * @Author: ANH DUNG Oct 23, 2014
     * @Todo: get one property by invoice id,
     * chỗ này đang xử lý tạm, vi không biết có cho tạo multil property trong 1 invoice không
     * sẽ trả về 1 model detail với id asc
     * @Param: $invoice_id
     */
    public static function GetOneInvoiceDetail($invoice_id) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.invoice_id", $invoice_id);
        $criteria->order = "t.id";
        return self::model()->find($criteria);
    }
    
}