<?php

/**
 * This is the model class for table "{{_pro_engage_us}}".
 *
 * The followings are the available columns in table '{{_pro_engage_us}}':
 * @property integer $id
 * @property integer $transation_id
 * @property integer $listing_id
 * @property string $price
 * @property integer $status
 * @property string $list_on
 */
class ProEngageUs extends CActiveRecord
{
    public $termandcondition;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProEngageUs the static model class
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
		return '{{_pro_engage_us}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_id, listing_id, status', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>16),
			array('list_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('termandcondition','boolean','on'=>'engage'),
            array('price, transaction_id, listing_id', 'required', 'on'=>'engage'),
            array('termandcondition', 'compare', 'compareValue' => 1, 'message' => 'You need to agree to the Terms and Conditions of Property Info.' ,'on'=>'engage'),

			array('id, transation_id, listing_id, price, status, list_on, remark', 'safe'),
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
            'listing' => array(self::BELONGS_TO,'Listing','listing_id'),
            'transaction' => array(self::BELONGS_TO,'ProTransactions','transaction_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'transation_id' => 'Transation',
			'listing_id' => 'Listing',
			'price' => 'Price',
			'status' => 'Status',
			'list_on' => 'List On',
			'termandcondition' => 'Terms and Conditions',
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
		$criteria->compare('t.transation_id',$this->transation_id);
		$criteria->compare('t.listing_id',$this->listing_id);
		$criteria->compare('t.price',$this->price,true);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.list_on',$this->list_on,true);

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

    public static function getListEngage($needMore=array())
    {
        $criteria=new CDbCriteria;
//        $criteria->compare('t.transation_id', $transaction);
//        $criteria->compare('t.listing_id', $listing);
        $criteria->compare('t.user_id', Yii::app()->user->id);
        
        $pagination = array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            );
        if(isset($needMore['limit'])){
            $criteria->offset = 0; 
            $criteria->limit = $needMore['limit']; 
            $pagination = false;
        }
        
        return new CActiveDataProvider('ProEngageUs', array(
            'criteria'=>$criteria,
            'pagination'=>$pagination
        ));
    }
}