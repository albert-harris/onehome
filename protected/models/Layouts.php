<?php

/**
 * This is the model class for table "{{_layouts}}".
 *
 * The followings are the available columns in table '{{_layouts}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $order
 * @property integer $status
 */
class Layouts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Layouts the static model class
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
		return '{{_layouts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('title, order, status', 'required'),
			array('order, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
                        array('content', 'safe'),
			array('id, title, content, order, status', 'safe', 'on'=>'search'),
		);
	}
        
        public function getAjaxAction()
        {
            return array('actionAjaxActivate', 'actionAjaxDeactivate');
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                        'pages' => array(self::HAS_MANY, 'Pages', 'layout_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'order' => 'Order',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
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
        
        public static function loadItems($emptyOption=false)
	{
		$_items = array();
		if($emptyOption)
			$_items[""]="";	
		$models=self::model()->findAll(array(
			'order'=>'id',
		));
		foreach($models as $model)
			$_items[$model->id]=$model->title;
		return $_items;		
	}
}