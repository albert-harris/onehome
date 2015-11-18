<?php

/**
 * This is the model class for table "{{_pro_master_bedroom}}".
 *
 * The followings are the available columns in table '{{_pro_master_bedroom}}':
 * @property integer $id
 * @property string $name
 */
class ProMasterBedroom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_pro_master_bedroom}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('name, value, type', 'required'),
			array('value', 'required'),
			array('name', 'length', 'max'=>250),
            array('value', 'numerical', 'min' => 0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, value, type', 'safe', 'on'=>'search'),
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
                        'type' => 'Type'
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProMasterBedroom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    
    public static function getListDataBedroomReport($key='value',$name='name'){
        $criteria=new CDbCriteria;
        $criteria->order = 'name ASC';
        $criteria->limit = 4;
        $model = self::model()->findAll($criteria);
        return CHtml::listData($model, $key,$name);
    }
    public static function getListDataBedroom($key='value',$name='name'){
        $model = self::model()->findAll();
        return CHtml::listData($model, $key,$name);
    }

    //HThoa
    public static function getListMinimumBedroom($default=""){
        $model = self::model()->findAll(array('condition' => 'type = '.MINIMUM_TYPE));
        if(empty($default))
            return CHtml::listData($model, 'value', 'name');
        else
            return CHtml::listData($model, 'name', 'name');
    }
    //HThoa
    public static function getListMaximumBedroom($default=""){
        $model = self::model()->findAll(array('condition' => 'type = '.MAXIMUM_TYPE));
        if(empty($default))
            return CHtml::listData($model, 'value', 'name');
        else
            return CHtml::listData($model, 'name', 'name');
    }
    
    /**
     * @Author: ANH DUNG Apr 08, 2014
     * @Todo: get list id by condition search at index. at Model Listing - function searchAtIndex()
     * use for: some model: ProMasterBathroom, ProMasterBedroom, ProMasterFloor
     * @Param: $nameModel name of class model
     * @Param: $value value search
     * @Param: $type MINIMUM_TYPE or MAXIMUM_TYPE
     * @Return: array CHtml::listData($model, 'id', 'id');
     */
    public static function getListIdSearch($nameModel, $value, $type){
        $criteria=new CDbCriteria;
        if($type==MINIMUM_TYPE){
            $criteria->addCondition("t.value >= ".$value);
        }else{ // MAXIMUM_TYPE
            $criteria->addCondition("t.value <= ".$value);
        }
        $model_ = call_user_func(array($nameModel, 'model'));
        return CHtml::listData($model_->findAll($criteria), 'id', 'id');
    }
    
    
    
}
