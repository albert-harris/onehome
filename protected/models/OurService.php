<?php

/**
 * This is the model class for table "{{_our_service}}".
 *
 * The followings are the available columns in table '{{_our_service}}':
 * @property string $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $image
 * @property string $slug
 * @property string $parent_id
 * @property integer $display_order
 */
class OurService extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_our_service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('display_order', 'numerical', 'integerOnly'=>true),
			array('name, image, slug', 'length', 'max'=>255),
			array('parent_id', 'length', 'max'=>20),
			array('short_description, description', 'safe'),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, short_description, description, image, slug, parent_id, display_order', 'safe', 'on'=>'search'),
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
			'childs' => array(self::HAS_MANY, 'OurService', 'parent_id', 'order'=>'display_order ASC'),
            'parent' => array(self::BELONGS_TO, 'OurService', 'parent_id'),
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
			'short_description' => 'Short Description',
			'description' => 'Description',
			'image' => 'Image',
			'slug' => 'Slug',
			'parent_id' => 'Parent',
			'display_order' => 'Display Order',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('display_order',$this->display_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchCategories()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->addCondition('parent_id is NULL');
		$criteria->order = 'display_order';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchItems()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('parent_id', $this->parent_id);
		$criteria->order = 'display_order';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OurService the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
    public function behaviors()
    {
        return array(
			'sluggable' => array(
				'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
				'columns' => array('name'),
				'unique' => true,
				'update' => true,
			),
		);
    }  
    
	static public function getMainCategories() {
		$c = new CDbCriteria();
		$c->addCondition('parent_id is NULL');
		$c->order = 'display_order ASC';
		return static::model()->findAll($c);
	}
	
	static public function findBySlug($slug) {
		return static::model()->findByAttributes(array(
			'slug'=>$slug
		));
	}
	
	/*
	 * Return the resized image url
	 * 
	 * @author Lam Huynh
	 */
    public function getImageUrl($width=null, $height=null, $watermark=false) {
        $imgFile = $this->generateImagePath($width, $height, $watermark);
        if (!is_file($imgFile)) {
			// resize image
			$srcImg = $this->generateImagePath();
			ImageHelper::resize($srcImg, $imgFile, $width, $height, array('fit'=>false));
		}
		
        $imgUrl = $this->generateImageUrl($width, $height, $watermark);
        return is_file($imgFile) ? $imgUrl : null;
    }
    
	/*
	 * Generate the filename corresponding to the dimension
	 * Need to change the code when copy to another model
	 * 
	 * @author Lam Huynh
	 */
    protected function generateImagePath($width=null, $height=null, $watermark=false) {
        $paths = array(
            0 => Yii::getPathOfAlias('webroot'),
            1 => 'upload/our-service',
            2 => $this->id,
            3 => "{$width}x{$height}",
            4 => $this->image
        );
		if ($watermark)
			$paths[4] = 'w'.$paths[4];
        if (!$width && !$height)
            unset ($paths[3]);
        return implode('/', $paths);
    }
    
	/*
	 * Generate the image url corresponding to the dimension
	 * Need to change the code when copy to another model
	 * 
	 * @author Lam Huynh
	 */
    protected function generateImageUrl($width=null, $height=null, $watermark=false) {
        $paths = array(
            0 => Yii::app()->baseUrl,
            1 => 'upload/our-service',
            2 => $this->id,
            3 => "{$width}x{$height}",
            4 => $this->image
        );
		if ($watermark)
			$paths[4] = 'w'.$paths[4];
        if (!$width && !$height)
            unset ($paths[2]);
        return implode('/', $paths);
    }
	
	/*
	 * Save uploaded file from form submit
	 * Need to change the property 'imageFile' and 'large_image' 
	 *   when copy to another model.
	 * 
	 * @param CUploadedFile $imageFile
	 * @author Lam Huynh
	 */
 	public function saveImage() {
		if (!$this->imageFile)
			return;

		if ($this->image)
			$this->removeImage();
		$this->image = $this->imageFile->getName();
		$this->update('image');
		
		$savePath = $this->generateImagePath();
		if (!file_exists(dirname($savePath))) {
			mkdir(dirname($savePath), 0777, true);
		}
		$this->imageFile->saveAs($savePath);
	}
	
	/*
	 * @author Lam Huynh
	 */
	public function removeImage() {
		$dir = dirname($this->generateImagePath());
		if (file_exists($dir)) {
			FileHelper::removeDirectory($dir);
		}
	}
	
	public function moveUp() {
		$next = $this->getSibling(false);
		if ($next) {
			$oldOrder = $this->display_order;
			$this->display_order = $next->display_order;
			$next->display_order = $oldOrder;
			$this->save();
			$next->save();
		}
		
	}
	
	public function moveDown() {
		$prev = $this->getSibling();
		if ($prev) {
			$oldOrder = $this->display_order;
			$this->display_order = $prev->display_order;
			$prev->display_order = $oldOrder;
			$this->save();
			$prev->save();
		}
	}
	
	public function getSibling($next=true) {
		$c = new CDbCriteria();
		if (!$this->parent_id) {
			$c->addCondition('parent_id is null');
		} else {
			$c->compare('parent_id', $this->parent_id);
		}
		if ($next) {
			$c->addCondition('display_order > :odr');
			$c->order = 'display_order ASC';
		} else {
			$c->addCondition('display_order < :odr');
			$c->order = 'display_order DESC';
		}
		$c->params[':odr'] = $this->display_order;
		return ServiceCategory::model()->find($c);
	}
	
	static public function massUpdateDisplayOrder() {
		$c = new CDbCriteria();
		$c->order = 'parent_id ASC, display_order ASC';
		$models = static::model()->findAll($c);
		foreach($models as $k => $model) {
			$model->display_order = ($k+1)*10;
			$model->save();
		}
	}
}
