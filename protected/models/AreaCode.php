<?php

/**
 * This is the model class for table "{{_area_code}}".
 *
 * The followings are the available columns in table '{{_area_code}}':
 * @property integer $id
 * @property string $area_name
 * @property string $area_code
 */
class AreaCode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AreaCode the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_area_code}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area_name', 'required'),
			array('area_name', 'length', 'max'=>100),
			array('area_code', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, area_name, area_code', 'safe', 'on'=>'search'),
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
			'area_name' => 'Area Name',
			'area_code' => 'Area Code',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.area_name',$this->area_name,true);
		$criteria->compare('t.area_code',$this->area_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
		));
	}

    /*
    public function activate()
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	*/

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}

    public static function loadArrArea()
    {
        $models=self::model()->findAll(array(
            'order'=>'area_name',
        ));
        return  CHtml::listData($models,'id','area_name');
    }

    /**
     * @param bool $hasEmpty
     * @return array
     * <Jason>
     * <pmhai90@gmail.com>
     */
    public static function getAreaCode($hasEmpty=false)
    {
        $models=self::model()->findAll(array(
            'order'=>'area_name',
        ));
        if($hasEmpty)
            $result = array(''=>'Not applicable');
        else
            $result = array();
        foreach($models as $model)
        {
            $result[$model->id] = $model->area_name.' (+'.$model->area_code.')';
        }
        return $result;
    }
    
    //Vnguyen	
    public static function GetAreaCodeById($id) {
        if(!empty($id)) {
                $code = AreaCode::model()->findByPk($id);
                if(!empty($code->area_code)) {
                        return $code->area_code;
                } else {
                        return '0';
                }
        } else {
                return '0';
        }
    }       
}