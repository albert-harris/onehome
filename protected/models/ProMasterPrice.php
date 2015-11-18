<?php

/**
 * This is the model class for table "{{_pro_master_price}}".
 *
 * The followings are the available columns in table '{{_pro_master_price}}':
 * @property integer $id
 * @property string $name
 * @property integer $value
 */
class ProMasterPrice extends CActiveRecord
{
    
    const PRICE_FOR_SALE = 1;
    const PRICE_FOR_RENT = 2;
    
    public function tableName()
    {
            return '{{_pro_master_price}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            return array(
//			array('name, value, type', 'required'),
                array('value', 'required'),
                array('value', 'numerical', 'integerOnly'=>true, 'min' => 0),
                array('name', 'length', 'max'=>250),
                array('id, name, value, type', 'safe'),
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
                    'value' => 'Value',
                    'type'  => 'Type'
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
            $criteria=new CDbCriteria;
            $criteria->compare('t.type', $this->type);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProMasterPrice the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
        
    //HThoa
    public static function getListMinimumPrice($default=""){
        $model = self::model()->findAll(array('condition' => 'type = '.MINIMUM_TYPE));
        if(empty($default))
            return CHtml::listData($model, 'value', 'name');
        else
            return CHtml::listData($model, 'name', 'name');
    }

    //HThoa
    public static function getListMaximumPrice($default=""){
        $model = self::model()->findAll(array('condition' => 'type = '.MAXIMUM_TYPE));
        if(empty($default))
            return CHtml::listData($model, 'value', 'name');
        else
            return CHtml::listData($model, 'name', 'name');
    }
    
    /**
     * @Author: ANH DUNG Jul 02, 2014
     * @Todo: get listoption search
     * @Param: $type
     */    
    public static function getListOption($type){
        $criteria = new CDbCriteria();
        $criteria->compare('t.type', $type);
        $criteria->order = 't.value';
        $models = self::model()->findAll($criteria);
        $aRes = array();
        foreach($models as $item){
            $aRes[round($item->value)] = MyFormat::formatPriceSign($item->value);
        }        
        return $aRes;   
    }
    
    
    
    
}
