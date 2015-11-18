<?php

/**
 * This is the model class for table "{{_pro_master_furnished}}".
 *
 * The followings are the available columns in table '{{_pro_master_furnished}}':
 * @property integer $id
 * @property string $name
 * @property integer $value
 */
class ProMasterFurnished extends CActiveRecord
{
    // ANH DUNG MAR 13, 2015
    const VAL_Unfurnished = 1;
    const VAL_PartiallyFurnished = 2;
    const VAL_FullyFurnished = 3;
    const VAL_ToBeDiscussed = 5;
    
    const VAL_Bare = 6;
    const VAL_PartiallyFitted = 7;
    const VAL_FullyFitted = 8;
    
    const TYPE_NORMAL = 1;
    const TYPE_INDUSTRIAL = 2;
    
    /**
     * @Author: ANH DUNG Mar 13, 2015
     * @Todo: get array Furnished normal
     */
    public static function getFurnishedNormal() {
        return array(
            ProMasterFurnished::VAL_Unfurnished,
            ProMasterFurnished::VAL_PartiallyFurnished,
            ProMasterFurnished::VAL_FullyFurnished,
            ProMasterFurnished::VAL_ToBeDiscussed,
        );
    }
    
    /**
     * @Author: ANH DUNG Mar 13, 2015
     * @Todo: get array Furnished  For Commercial/ Industrial Properties, Condition should be Bare, Partially Fitted, Fully Fitted
     */
    public static function getFurnishedIndustrial() {
        return array(
            ProMasterFurnished::VAL_Bare,
            ProMasterFurnished::VAL_PartiallyFitted,
            ProMasterFurnished::VAL_FullyFitted,
        );
    }
    
    /**
     * @Author: ANH DUNG Mar 13, 2015
     * @Todo: get list option by type
     * @Param: $type 
     */
    public static function getListOption($type) {
        $criteria = new CDbCriteria();
        $criteria->order = 't.value';
        $aId = array();
        if( $type== ProMasterFurnished::TYPE_NORMAL){
            $aId = ProMasterFurnished::getFurnishedNormal();
        }elseif($type== ProMasterFurnished::TYPE_INDUSTRIAL){
            $aId = ProMasterFurnished::getFurnishedIndustrial();
        }
        $criteria->addInCondition('t.id', $aId);
        $models = self::model()->findAll($criteria);
        return Chtml::listData($models, 'id', 'name');
    }
    
    // ANH DUNG MAR 13, 2015
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_master_furnished}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('name,value', 'required'),
                    array('id, name, value', 'safe'),
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
                    'value' => 'Order Number',
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
            $criteria->compare('value',$this->value);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProMasterFurnished the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    //Kvan
    public static function getListData($default=""){
        $model = self::model()->findAll();
        if(empty($default))
            return CHtml::listData($model, 'value', 'name');
        else
            return CHtml::listData($model, 'name', 'name');       
    }
    
    public static function getInforFurnishedBYId($id,$field='name'){
        $model = ProMasterFurnished::model()->findByPk($id);
        if($model) return $model->$field;
    }
    
    
    
}
