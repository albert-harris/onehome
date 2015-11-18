<?php

/**
 * This is the model class for table "{{_pro_listing_photos}}".
 *
 * The followings are the available columns in table '{{_pro_listing_photos}}':
 * @property string $id
 * @property integer $listing_id
 * @property integer $default
 * @property string $image
 * @property string $created_date
 */
class ProListingPhotos extends CActiveRecord
{
    protected $listingCount = 0;
    public static $AllowFile = 'jpg,jpeg,png';
    public static $szie =array(
        '77x47'=>array('width'=>77,'height'=>47),
        '120x96'=>array('width'=>120,'height'=>96),
        '268x162'=>array('width'=>268,'height'=>162),
        '633x390'=>array('width'=>633,'height'=>390),
        '1024x768'=>array('width'=>1024,'height'=>768),
    );
    
    const SIZE_WATER_MARK = '633x390';
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * for small size to put water mark
     * một số hình size nhỏ không đóng water mark vào được, phải resize từ hình đã đóng watermark
     */
    public static function GetSmallSizeToProcessWaterMark() {
        $AllSize = ProListingPhotos::$szie;
        unset($AllSize[ProListingPhotos::SIZE_WATER_MARK]);
        unset($AllSize['1024x768']);
        return $AllSize;
    }    

    public static $folderUpload= 'upload/listing';
    public $FileValidate;

    /**
    * @return string the associated database table name
    */
   public function tableName()
   {
           return '{{_pro_listing_photos}}';
   }

   /**
    * @return array validation rules for model attributes.
    */
   public function rules()
   {
       return array(
           array('listing_id, default', 'numerical', 'integerOnly'=>true),
           array('FileValidate', 'file',
               'allowEmpty' => true,
               'types' => ProListingPhotos::$AllowFile,
               'wrongType' => 'Only '. ProListingPhotos::$AllowFile.' are allowed.',
               'maxSize' => ActiveRecord::getMaxFileSize(), // 3MB
//                            'maxSize' => 5, // 3MB
               'tooLarge' => 'The file was larger than 10 MB. Please upload a smaller file.',
          ),  
           array('display_order,id, listing_id, default, image, created_date', 'safe'),
       );
   }

   /**
    * @return array relational rules.
    */
   public function relations()
   {
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
             'default' => 'Default',
             'image' => 'Image',
             'created_date' => 'Created Date',
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
        $criteria->compare('default',$this->default);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('created_date',$this->created_date,true);
        ProListingPhotos::AddConditionOrderPhoto($criteria);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                 'pageSize' => 50,
            ),
        ));
   }

   /**
    * Returns the static model of the specified AR class.
    * Please note that you should have this exact method in all your CActiveRecord descendants!
    * @param string $className active record class name.
    * @return ProListingPhotos the static model class
    */
   public static function model($className=__CLASS__)
   {
        return parent::model($className);
   }
    
    public static function removePhoto($model){        
        @unlink(YII_UPLOAD_DIR .'/listing/'.$model->listing_id .'/'.$model->image);
        foreach (ProListingPhotos::$szie as $k=>$v){
            @unlink(YII_UPLOAD_DIR .'/listing/'.$model->listing_id .'/'.$k.'/'.$model->image);
        }
    }
    
    /**
     * @Author: ANH DUNG Jan 16, 2015
     * @Todo: remove small photo to overide photo have water mark
     * @Param: $model model ProListingPhotos
     */
    public static function RemovePhotoListingSmall($model) {
        $SmallSize = ProListingPhotos::GetSmallSizeToProcessWaterMark();
        foreach ($SmallSize as $k=>$v){
            @unlink(YII_UPLOAD_DIR .'/listing/'.$model->listing_id .'/'.$k.'/'.$model->image);
        }
    }
    
    public static function checkLimitFileUpload($id){
        $totalImgupload = ProListingPhotos::model()->countByAttributes(array('listing_id'=>$id));   
        if($totalImgupload>=LIMIT_PHOTO_UPLOAD){
            return false;
        }
        return true;
    }
    
    public static function getPhotoByListing($id) {
        $criteria=new CDbCriteria;
        $criteria->compare('t.listing_id', $id);
//        $criteria->order = "t.default DESC";
        ProListingPhotos::AddConditionOrderPhoto($criteria);
        return self::model()->findAll($criteria);
    }
    
    public static function getListListingId() {
        $criteria=new CDbCriteria;
        $criteria->select = 't.listing_id, count(t.listing_id) AS listingCount';
        $criteria->group = 't.listing_id';
        $criteria->having = 'listingCount > 1';
        
        $model = self::model()->findAll($criteria);
		return CHtml::listData($model, 'listing_id', 'listing_id');
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: handle sort photo
     * @Param: $model is model Listing
     */
    public static function HandleSortPhoto($model) {
        $order=1;
        $sql='';
        $tableName = ProListingPhotos::model()->tableName();
        foreach ( $_POST['photo_display_order'] as $key=>$pk){
            $sql .= "UPDATE $tableName SET `display_order`=$order WHERE `id` = $pk AND `listing_id`=$model->id ;";
            $order++;
        }
        //UPDATE mytable SET (id, column_a, column_b) FROM VALUES ( (1, 12, 6), (2, 1, 45), (3, 56, 3), … );
        Yii::app()->db->createCommand($sql)->execute();
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: something
     * @Param: $criteria
     */
    public static function AddConditionOrderPhoto(&$criteria) {
        $criteria->order = "t.default DESC, t.display_order ASC";
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: get max display_order to handle upload multi photo
     * @Param: $listing_id 
     * @Return: Max of display_order
     */
    public static function GetMaxDisplayOrder($listing_id) {
        $criteria=new CDbCriteria;
        $criteria->compare('t.listing_id', $listing_id);
        $criteria->select = "MAX(t.display_order) as display_order";
        $model = self::model()->find($criteria);
        if($model->display_order)
            return $model->display_order;
        return 1;
    }
    
    /**
     * @Author: ANH DUNG Jan 20, 2015
     * @Todo: fix resize some photo small not have watermark
     * @Param: $model
     * run and done at 11h19 Jan 20, 2015
     */
    public static function FixWatermarkPhotoSmallSize() {
        return;
        $models = self::model()->findAll();
        foreach($models as $mFile){
            Listing::PutWarterMarkPhotoListing($mFile);
            Listing::ResizePhotoListingSmall($mFile);
        }
//        $mFile =  self::model()->findByPk(3);
//        Listing::ResizePhotoListingSmall($mFile);
        echo count($models);die;
    }
    
    public function getImageUrl($width=null, $height=null, $watermark=false) {
        $imgFile = $this->generateImagePath($width, $height, $watermark);
        if (!is_file($imgFile)) {
			// resize image
			$srcImg = $this->generateImagePath();
			$watermarkFile = $watermark ? Yii::getPathOfAlias('webroot') . '/upload/watermark.png' : null;
			ImageHelper::resize($srcImg, $imgFile, $width, $height, array('watermarkFile'=>$watermarkFile));
		}
		
        $imgUrl = $this->generateImageUrl($width, $height, $watermark);
        return is_file($imgFile) ? $imgUrl : null;
    }
    
    public function generateImagePath($width=null, $height=null, $watermark=false) {
        $paths = array(
            0 => Yii::getPathOfAlias('webroot'),
            1 => self::$folderUpload,
            2 => $this->listing_id,
            3 => "{$width}x{$height}",
            4 => $this->image
        );
		if ($watermark)
			$paths[4] = 'w'.$paths[4];
        if (!$width && !$height)
            unset ($paths[3]);
        return implode('/', $paths);
    }
    
    protected function generateImageUrl($width=null, $height=null, $watermark=false) {
        $paths = array(
            Yii::app()->baseUrl,
            self::$folderUpload,
            $this->listing_id,
            "{$width}x{$height}",
            $this->image
        );
		if ($watermark)
			$paths[4] = 'w'.$paths[4];
        if (!$width && !$height)
            unset ($paths[2]);
        return implode('/', $paths);
    }
}
