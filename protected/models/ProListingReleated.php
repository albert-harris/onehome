<?php

/**
 * This is the model class for table "{{_pro_listing_releated}}".
 *
 * The followings are the available columns in table '{{_pro_listing_releated}}':
 * @property integer $id
 * @property integer $listing_id
 */
class ProListingReleated extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_pro_listing_releated}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('listing_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, listing_id', 'safe', 'on'=>'search'),
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
		$criteria->compare('listing_id',$this->listing_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProListingReleated the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public static function saveListingReleatedWithListingid($model){
        
        //delete old listing
        ProListingReleated::model()->deleteAllByAttributes(array('listing_id'=>$model->id));
        //save listing
        if(!empty($model->listing_releated)){
            $dataJson = json_decode($model->listing_releated,true);
            if(is_array($dataJson) && count($dataJson)>0){
                foreach ($dataJson as $k=>$v){
                    $releated = new ProListingReleated();
                    $releated->listing_id = $model->id;
                    $releated->listing_releated = $v;
                    $releated->save();
                }
            }
        }
    }
    
}
