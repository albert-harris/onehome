<?php

/**
 * This is the model class for table "{{_categories_group}}".
 *
 * The followings are the available columns in table '{{_categories_group}}':
 * @property integer $id
 * @property string $nam
 */
class Memodule extends CActiveRecord
{
    public static $aSizeCover = array(
        '217x194' => array('width'=>217, 'height'=>194),
    );
    
    public $imageFile;
    public static $folderUpload = 'module'; 
    
    public static $MODULE_ITEM_PER_PAGE = array(12=>12, 24=>24, 36=>36);
    public static $MODULE_ITEM_SORT_BY_ASC = array( 'name.asc'=>'Name', 'order_at.asc'=>'Popularity');
    public static $MODULE_ITEM_SORT_BY_DESC = array( 'name.desc'=>'Name', 'order_at.desc'=>'Popularity');    
    public static $FE_DEFAULT_PAGE_SIZE = 12; 
    public static $FE_DEFAULT_SORT_ASC = 'name.asc'; 
    public static $FE_DEFAULT_SORT_DESC = 'name.desc';
    public static $aDir = array('asc'=>'.desc','desc'=>'.asc');
    public static $aDirectionSort = array('asc' ,'desc');
    public static $aClassIconSort = array('asc'=>'increase','desc'=>'decrease');
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategoriesGroup the static model class
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
		return '{{_me_module}}';
	}

    /**
     * <Jason>
     * <Email: pmhai90@gmail.com>
     */
     public static function saveImage($model) {
		if (is_null($model->imageFile))
			return '';
		$ext = $model->imageFile->getExtensionName();
		$fileName = time() . '.' . $ext;
		$imageProcessing = new ImageProcessing();
		$imageProcessing->createDirectoryByPath('/upload/admin/' . self::$folderUpload . '/' . $model->id);
		$model->imageFile->saveAs('upload/admin/' . self::$folderUpload . '/' . $model->id . '/' . $fileName);
		return $fileName;
	}
    
    /**
     * <Jason>
     * <Email: pmhai90@gmail.com>
     */
    public static function resizeCover($model)
    {
		$ImageProcessing = new ImageProcessing();
		$ImageProcessing->folder = '/upload/admin/' . self::$folderUpload . '/' . $model->id;
		$ImageProcessing->file = $model->cover;
		$ImageProcessing->thumbs = Memodule::$aSizeCover;
		$ImageProcessing->create_thumbs();
	}
    
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, order_at, cover, status, course_id, slug, short_description, description', 'safe'),
            array('imageFile', 'file', 'on'=>'create,update',
                'allowEmpty'=>true,
                'types'=> 'jpg,gif,png',
                'wrongType'=>'Only jpg,gif,png are allowed.',
                'maxSize' => ActiveRecord::getMaxFileSize(), // 5MB
                'tooLarge' => 'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
            ),
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
            'course' => array(self::BELONGS_TO, 'Mecourse', 'course_id'),
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
			'description' => 'Description',
			'short_description' => 'Short Description',
			'cover' => 'Cover Image',
			'course_id' => 'Course',
			'order_at' => 'Order',
		);
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('course_id',$this->course_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),            
		));
	}
        
    /**
    *<Jason>
    *<Email: pmhai90@gmail.com>
    */
    public static function getAllModuleByCourseId($course_id, $view_type='grid'){
        $criteria=new CDbCriteria;
        $criteria->compare('t.course_id', $course_id);
        $criteria->compare('t.status', STATUS_ACTIVE);
//        $criteria->order= 't.order_at ASC';

        $sort = new CSort();
        $attSort = array(
            'name' => 'name',
            'order_at' => 'order_at',
        );
        
        $sort->attributes = $attSort;
        $sort->defaultOrder = 'name asc';    
        if(isset($_GET['sort']))
        { // check valid $_GET['sort']
            $sSort = explode('.', $_GET['sort']);// $_GET['sort'] = name.desc
            if(count($sSort)==2){
                if(in_array($sSort[0], $attSort) && in_array($sSort[1], Memodule::$aDirectionSort)){
                    $sort->defaultOrder = implode(' ', $sSort);    
                }
            }
        }
        $pageSize = Memodule::$FE_DEFAULT_PAGE_SIZE;
        if(isset($_GET['pageSize']) && in_array($_GET['pageSize'], Memodule::$MODULE_ITEM_PER_PAGE)){
            $pageSize = $_GET['pageSize'];
        }
        
        return new CActiveDataProvider('Memodule', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> $pageSize,
            ),
            'sort' => $sort,
        ));     
        
//        if ($view_type == 'list') {
//            return new CActiveDataProvider('Memodule', array(
//                'criteria'=>$criteria,
//                'pagination'=>array(
//                    'pageSize'=> 4,
//                ),
//            ));            
//        }
//        else{
//            return new CActiveDataProvider('Memodule', array(
//                'criteria'=>$criteria,
//                'pagination'=>array(
//                    'pageSize'=> 9,
//                ),
//            ));
//        }
    }
       
    public function behaviors() {
        return array('sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('name'),
                'unique' => true,
                'update' => true,
            ),);
    }    
    
    /**
     * <Jason>
     * <Email: pmhai90@gmail.com>
     */
    public static function getAll(){
        $criteria = new CDbCriteria ();
		$criteria->compare ('t.status', STATUS_ACTIVE);  
		$criteria->order = "order_at ASC";
		
		$module = Memodule::model ()->findAll($criteria);
		return $module;         
    }    
    
    /**
     * <Jason>
     * <Email: pmhai90@gmail.com>
     */
    public static function getDropdownList(){
        return CHtml::listData( // listData helps in generating the data for <option> tags
            Memodule::model()->findAll(), // a list of model objects. This parameter
                     // can also be an array of associative arrays
                     // (e.g. results of CDbCommand::queryAll).
               'id', // the "value" attribute of the <option> tags, 
                     // here will be populated with id column values from program table 
               'name' // the display text of the <option> tag,
                     // here will be populated with program_name column values from table
            );       
    }

         
    /**
     * <Jason>
     * <Email: pmhai90@gmail.com>
     */
    public static function getByCourse($course_id){
        $criteria = new CDbCriteria ();
		$criteria->compare ('t.status', STATUS_ACTIVE);  
		$criteria->compare ('t.course_id', $course_id);  
		$criteria->order = "order_at ASC";
		
		$module = Memodule::model ()->findAll($criteria);
		return $module;         
    }    
    
    /**
     * <Jason>
     * <Email: pmhai90@gmail.com>
     */
    public static function findBySlug($slug){
        $criteria = new CDbCriteria ();
		$criteria->compare ('t.slug', $slug);  
		$module = Memodule::model ()->find($criteria);
		return $module;         
    }     
}