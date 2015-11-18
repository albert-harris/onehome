<?php

/**
 * This is the model class for table "{{_api_building}}".
 *
 * The followings are the available columns in table '{{_api_building}}':
 * @property string $id
 * @property string $building
 */
class ApiBuilding extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_api_building}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('building', 'length', 'max'=>255),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('id, building', 'safe', 'on'=>'search'),
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
                    'building' => 'Building',
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
            $criteria->compare('building',$this->building,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApiBuilding the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    /**
     * @Author: ANH DUNG Mar 05, 2015
     * @Todo: get some value info. It's only map for table ApiBuilding
     * @Param: $model model ApiBuilding
     * @Param: $key can be:
     *  building key X(6): key = building_key
        building name X(45): key = building_name
        type flag X(1): key = type_flag 
     */
    public static function getValueKeyFromModel($model, $key) {
        $res = '';
        if($model){
            switch ($key) {
                case "building_key":
                    $res = substr($model->building, 0, 6);// lay tu vi tri 0 va lay 6 ky tu
                break;
                case "building_name":
                    $res = substr($model->building, 6, 45);// lay tu vi tri 6 va lay 45 ky tu
                break;
                case "type_flag":
                    $res = substr($model->building, 51, 1);
                break;
                default:
                    break;
            }
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Mar 05, 2015
     * @Todo: update long_street and lat_street table building 
     * @Param: $model model ApiBuilding
     * @Param: $aRes array result from curl respone
     */
    public static function UpdateLongLat($model, $aRes) {
        if(isset($aRes['long_street'])){
            $model->long_street = $aRes['long_street'];
            $model->lat_street = $aRes['lat_street'];
            $model->update(array('long_street', 'lat_street'));
        }
    }
    
    
}
