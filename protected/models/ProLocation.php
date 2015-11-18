<?php

/**
 * This is the model class for table "{{_pro_location}}".
 *
 * The followings are the available columns in table '{{_pro_location}}':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $created_date
 */
class ProLocation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProLocation the static model class
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
		return '{{_pro_location}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('name, created_date', 'required'),
			array('name', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, status, created_date', 'safe'),
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
		$criteria->compare('t.name',$this->name,true);
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

    //Kvan -- May 23, 2014  anh dung fix add $aId=array()
    public static function getListDataLocation($aId=array()){
        $criteria = new CDbCriteria();
        $criteria->compare("t.status", STATUS_ACTIVE);
        if(count($aId)){
            $criteria->addInCondition("t.id", $aId);
        }
        $model = self::model()->findAll($criteria);
        if(count($model)>0){
            $tmp =array();
            foreach ($model as $item){
                if($item->id<10)  $tmp[$item->id] = "D0".$item->id . " ".$item->name ;
                else  $tmp[$item->id] =  "D".$item->id . " ".$item->name ;
            }
            return $tmp;
        } 
       return array();
//        return CHtml::listData($model, 'id', 'name');
    }
    
    
    public static function getNameWithDistrict($pk){        
        $str = '';
        $model = self::model()->findByPk($pk);
        if($model){
            if($model->id<10)  $str .= "D0".$model->id . " ".$model->name ;
                else  $str .=  "D".$model->id . " ".$model->name ;
        }
        return $str;
    }
    
    /**
     * <Jason>
     * @return type
     */
    public static function getListDataLocationSearch(){
        $model = self::model()->findAll(array('condition'=>'status = '.STATUS_ACTIVE));
        return CHtml::listData($model, 'id', 'id');
    }
    
    public static function getLocationName($id){
        $model = self::model()->findByPk($id);
        if (isset($model)) {
            return $model->name;
        }
        else{
            return '';
        }
    }
}