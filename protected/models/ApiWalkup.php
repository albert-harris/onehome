<?php

/**
 * This is the model class for table "{{_api_walkup}}".
 *
 * The followings are the available columns in table '{{_api_walkup}}':
 * @property string $id
 * @property string $walkup
 */
class ApiWalkup extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{_api_walkup}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('walkup', 'length', 'max'=>255),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('id, walkup', 'safe', 'on'=>'search'),
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
                    'walkup' => 'Walkup',
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

            $criteria->compare('id',$this->id,true);
            $criteria->compare('walkup',$this->walkup,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApiWalkup the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get text by $building_number
     * @Param: $building_number
     */
    public static function getByBuildingNumber($building_number) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.walkup", $building_number, true);
        return self::model()->find($criteria);
    }    
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get some value info. It's only map for table ApiPostcode
     * @Param: $postal_code
     * @Param: $key can be:
     *  postal code X(6): key = postal_code        
        building number X(7): key = building_number 
        street key X(7): key = street_key
        walkup indicator X(1): key = walkup_indicator
     */
    public static function getValueKeyByBuildingNumber($building_number, $key) {
        $res = '';
        $model = self::getByBuildingNumber($building_number);
        if($model){
            switch ($key) {
                case "postal_code":
                    $res = substr($model->walkup, 0, 6);
                break;
                case "building_number":
                    $res = substr($model->walkup, 6, 7);
                break;                
                case "street_key":
                    $res = substr($model->walkup, 13, 7);
                break;
                case "walkup_indicator":
                    $res = substr($model->walkup, 20, 1);
                break;
                default:
                    break;
            }
        }
        return $res;
    }    
    
}
