<?php

/**
 * This is the model class for table "{{_pro_listing_furnishing_included}}".
 *
 * The followings are the available columns in table '{{_pro_listing_furnishing_included}}':
 * @property string $id
 * @property integer $listing_id
 * @property integer $arr_furnishing_included_id
 */
class ProListingFurnishingIncluded extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_listing_furnishing_included}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('listing_id, furnishing_included_id', 'numerical', 'integerOnly'=>true),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('id, listing_id, furnishing_included_id', 'safe', 'on'=>'search'),
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
                    'listing_id' => 'Listing',
                    'furnishing_included_id' => 'Furnishing Included',
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
            $criteria->compare('listing_id',$this->listing_id);
            $criteria->compare('furnishing_included_id',$this->furnishing_included_id);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProListingFurnishingIncluded the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    /**
     * @Author: ANH DUNG May 23, 2014
     * @Todo: get unique listing by array id furnishing_included_id
     * $agent_id
     */    
    public static function getArrListingId($arr_furnishing_included_id){
        if(!is_array($arr_furnishing_included_id) || count($arr_furnishing_included_id)<1)
            return array();
        $criteria=new CDbCriteria;
        $criteria->addInCondition('t.furnishing_included_id', $arr_furnishing_included_id);
        $criteria->select = "t.listing_id";
        $criteria->group = "t.listing_id";
        return CHtml::listData(self::model()->findAll($criteria),'listing_id','listing_id');
    }    
}
