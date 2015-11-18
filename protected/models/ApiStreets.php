<?php

/**
 * This is the model class for table "{{_api_streets}}".
 *
 * The followings are the available columns in table '{{_api_streets}}':
 * @property string $id
 * @property string $streets
 */
class ApiStreets extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_api_streets}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('streets', 'length', 'max'=>300),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('id, streets', 'safe', 'on'=>'search'),
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
                    'streets' => 'Streets',
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
            $criteria->compare('streets',$this->streets,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApiStreets the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get text by $street_key
     * @Param: $street_key
     */
    public static function getByStreetKey($street_key) {
        $criteria = new CDbCriteria();
        $criteria->compare("t.streets", $street_key, true);
        return self::model()->find($criteria);
    }    
    
    /**
     * @Author: ANH DUNG Oct 27, 2014
     * @Todo: get some value info. It's only map for table ApiPostcode
     * @Param: $postal_code
     * @Param: $key can be:
     *  street key X(7): key = street_key        
        street name X(32): key = street_name 
        filler X(7): key = filler
     */
    public static function getValueKeyByStreetKey($street_key, $key) {
        $res = '';
        $model = self::getByStreetKey($street_key);
        if($model){
            switch ($key) {
                case "street_key":
                    $res = substr($model->streets, 0, 7);
                break;
                case "street_name":
                    $res = substr($model->streets, 7, 32);
                break;                
                case "filler":
                    $res = substr($model->streets, 39, 6);
                break;
                default:
                    break;
            }
        }
        return $res;
    }        
    
}
