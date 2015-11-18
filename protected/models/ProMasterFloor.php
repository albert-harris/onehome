<?php

/**
 * This is the model class for table "{{_pro_master_floor}}".
 *
 * The followings are the available columns in table '{{_pro_master_floor}}':
 * @property integer $id
 * @property string $name
 */
class ProMasterFloor extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_pro_master_floor}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
//		array('name, value, type', 'required'),
                array('value', 'required'),
                array('value', 'numerical', 'min' => 0),
                array('name', 'length', 'max'=>250),
                array('id, name, value, type', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProMasterFloor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    //HThoa
    public static function getListDataFloor($key='value',$name='name') {
        $model = self::model()->findAll();
        return CHtml::listData($model, $key,$name);
    }

    //HThoa
    public static function getListMinimumFloor($default=""){
        $model = self::model()->findAll(array('condition' => 'type = '.MINIMUM_TYPE));
        if(empty($default))
            return CHtml::listData($model, 'value', 'name');
        else
            return CHtml::listData($model, 'name', 'name');
    }
    //HThoa
    public static function getListMaximumFloor($default=""){
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
    public static function getListOption(){
        $criteria = new CDbCriteria();
        $criteria->order = 't.value';
        $models = self::model()->findAll($criteria);
        $aRes = array();
        foreach($models as $item){
            $aRes[$item->value] = MyFormat::formatFloorSize($item->value);
        }        
        return $aRes;   
    }
    
    
}
