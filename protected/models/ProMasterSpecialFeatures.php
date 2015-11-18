<?php

/**
 * This is the model class for table "{{_pro_master_special_features}}".
 *
 * The followings are the available columns in table '{{_pro_master_special_features}}':
 * @property string $id
 * @property string $name
 */
class ProMasterSpecialFeatures extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_pro_master_special_features}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProMasterSpecialFeatures the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    
    public static function getDropdownList($id='id',$name='name'){
        $model = self::model()->findAll();
        return CHtml::listData($model, $id,$name);
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     * @Todo: get list option
     * @Param: $model model 
     */
    public static function getListOption($aId) {
        if(!is_array($aId))
            return array();
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.id', $aId);
        $model = self::model()->findAll($criteria);
        return CHtml::listData($model, 'id','name');
    }
    

    //Kvan
    public static function getListData($default=""){
        $model = self::model()->findAll();
        if(empty($default))
            return CHtml::listData($model, 'value', 'name');
        else
            return CHtml::listData($model, 'name', 'name');
    }
    
    
}
