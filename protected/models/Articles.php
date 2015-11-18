<?php

/**
 * This is the model class for table "{{_articles}}".
 *
 * The followings are the available columns in table '{{_articles}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property string $first_char
 * @property integer $user_id
 * @property string $created_date
 * @property string $slug
 * @property integer $status
 */
class Articles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articles the static model class
	 */
    
         public static $articleStatus = array('0'=>'Unpublish', '1'=>'Publish');
         
         public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_articles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, user_id', 'required'),
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('url, slug', 'length', 'max'=>255),
			array('first_char', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, url, first_char, user_id, created_date, slug, status', 'safe', 'on'=>'search'),
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
                    //'adminDoctor' => array(self::BELONGS_TO, 'Users', 'user_id','condition'=>'adminDoctor.role_id='.ROLE_ADMIN.' OR adminDoctor.role_id='.ROLE_DOCTOR),
                    'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
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
			'url' => 'Url',
			'first_char' => 'First Char',
			'user_id' => 'Author',
			'created_date' => 'Created Date',
			'slug' => 'Slug',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('first_char',$this->first_char,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public static function loadUsers($emptyOption=false)
	{
                $users = Users::model()->findAll('role_id='.ROLE_ADMIN.' OR role_id='.ROLE_DOCTOR);
                //$users = Users::model()->findAll('role_id='.ROLE_DOCTOR);
		$_items = array();
		if($emptyOption)
			$_items[""]="";	
		foreach($users as $m)
			$_items[$m->id] =  $m->first_name .' '. $m->last_name;
		return $_items;		
	}
        
        protected function beforeSave()
	{
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                    $this->created_date = date('Y-m-d H:i:s');
                $this->first_char   = strtoupper(MyShareClass::getFirstChar($this->title));
            }
            return true;
        }
        
}