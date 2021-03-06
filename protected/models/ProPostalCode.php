<?php

/**
 * This is the model class for table "{{_pro_postal_code}}".
 *
 * The followings are the available columns in table '{{_pro_postal_code}}':
 * @property integer $id
 * @property integer $postal_code
 * @property string $area
 * @property integer $status
 * @property string $created_date
 */
class ProPostalCode extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProPostalCode the static model class
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
		return '{{_pro_postal_code}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('postal_code, area, status, created_date', 'required'),
			array('postal_code, status', 'numerical', 'integerOnly'=>true),
			array('area', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, postal_code, area, status, created_date', 'safe', 'on'=>'search'),
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
			'postal_code' => 'Postal Code',
			'area' => 'Area',
			'status' => 'Status',
			'created_date' => 'Created Date',
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
		$criteria->compare('t.postal_code',$this->postal_code);
		$criteria->compare('t.area',$this->area,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.created_date',$this->created_date,true);

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

    public static function loadArrList()
    {
        $models= self::model()->findAll(array(
            'condition'=>'status ='.STATUS_ACTIVE,
            'order'=>'id',
        ));
        $arr = array();
        foreach($models as $model){
            $arr[$model->id] = '('.$model->postal_code.') '.$model->area;
        }
        return $arr;
    }
}