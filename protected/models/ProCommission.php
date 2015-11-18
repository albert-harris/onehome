<?php

/**
 * This is the model class for table "{{_pro_commission}}".
 *
 * The followings are the available columns in table '{{_pro_commission}}':
 * @property integer $id
 * @property string $name
 * @property integer $percent
 */
class ProCommission extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_commission}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
                array('name, percent, first_tier, second_tier', 'required'),
                array('percent,first_tier, second_tier', 'numerical'),
                array('name', 'length', 'max'=>250),
                array('id, name, percent, first_tier, second_tier,commission_received', 'safe'),
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
                    'name' => 'Designation',
                    'percent' => 'Commission Scheme',
                    'first_tier' => 'First Tier',
                    'second_tier' => 'Second Tier',
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
            $criteria->compare('percent',$this->percent);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }
    
    /**
     * @Author: ANH DUNG Apr 28, 2014
     * @Todo: get percent of first_tier, second_tier
     * @Param: $pk primary key
     * @Param: $nameField is first_tier, second_tier
     * @Return: number percent
     */
   public static function getPercent($pk, $nameField){
       $res = 0;
       $model = self::model()->findByPk($pk);
       if($model){
           $res = $model->$nameField;
       }
       return $res;
   }
    

    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @Author: ANH DUNG Apr 23, 2014
     * @Todo: get array for dropdown list
     */
    public static function getListData(){
        $model = self::model()->findAll();
        return CHtml::listData($model, 'id', 'name');
    }        
    public static function visibleDeleteIcon($id) {
        $users = Users::model()->find('commission_schema_id = "' . $id . '"');
        if (!empty($users)) {
            return false;
        } else {
            return true;
        }
    }
}
