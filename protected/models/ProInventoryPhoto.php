<?php

/**
 * This is the model class for table "{{_pro_inventory_photo}}".
 *
 * The followings are the available columns in table '{{_pro_inventory_photo}}':
 * @property string $id
 * @property string $transaction_id
 * @property string $user_id
 * @property string $file_name
 * @property string $created_date
 */
class ProInventoryPhoto extends CActiveRecord
{
    public static $aSize = array(
        '160x160' => array('width' => 160, 'height' => 160), // 
        '320x320' => array('width' => 320, 'height' => 320), // 
        '80x80' => array('width' => 80, 'height' => 80), // 
    );
    public static $AllowFile = 'jpg,jpeg,png';
    public static $folderUpload='upload/inventory_photo';        

    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_inventory_photo}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, transaction_id, user_id, file_name, created_date', 'safe'),
            array('file_name', 'file','on'=>'file_upload',
                'allowEmpty'=>true,
                'types'=> self::$AllowFile,
                'wrongType'=>Yii::t('lang', "Only ".self::$AllowFile." are allowed."),
            ), 

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            return array(
                'rTransactions' => array(self::BELONGS_TO, 'ProTransactions', 'transaction_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'transaction_id' => 'Transaction',
                    'user_id' => 'User',
                    'file_name' => 'File Name',
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

            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.transaction_id',$this->transaction_id,true);
            $criteria->compare('t.user_id',$this->user_id,true);
            $criteria->compare('t.file_name',$this->file_name,true);
            $criteria->compare('t.created_date',$this->created_date,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
        'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
        ),
            ));
    }

    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }
    
    public static function SaveModel($model, $transaction_id, $ColumnNameFile){
        self::saveFile($model, $ColumnNameFile);
        $mFile = new ProInventoryPhoto();
//        $mFile->date_only = $model->date_only;
        $mFile->file_name = $model->file_name;
        $mFile->transaction_id = $transaction_id;
        $mFile->user_id = Yii::app()->user->id;
        if(isset($_GET['uid']))
            $mFile->user_id = $_GET['uid'];
        $mFile->file_name_slug = $model->file_name_slug;
        $mFile->save();
        $model->id = $mFile->id;
        self::resizeImage($model, $ColumnNameFile, ProInventoryPhoto::$aSize);        
        return $mFile->id;
    }
        
    /**
     * Jun 07, 2014 - ANH DUNG
     * To do: save file 
     * @param: $model is model ProGlobalEnquiry
     * @param: $fieldName file_name
     * @return: name of image upload/global_enquiry
     */
    public static function  saveFile($model, $fieldName)
    {
        if(is_null($model->$fieldName)) return '';
        $pathUpload = ProInventoryPhoto::$folderUpload;
        $ext = $model->$fieldName->getExtensionName();
        $file_name_slug = strtolower(MyFunctionCustom::slugify($model->$fieldName->getName()));
        $file_name_slug = str_replace(strtolower($ext), '', $file_name_slug);
        $model->file_name_slug = $file_name_slug;
        $fileName = date('Y-m-d');
        $uid = isset(Yii::app()->user->id)?Yii::app()->user->id:999999;
        $fileName = $uid.'-'.time().'-'.ActiveRecord::randString().'.'.$ext;
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
        $model->$fieldName->saveAs($pathUpload.'/'.$fileName);
        $model->$fieldName = $fileName;        
        return $fileName;
    }
    
    /**
     * @Author: ANH DUNG Jul 25, 2014
     * @Todo: resize photo
     * @Param: $model, $fieldName, $aSize
     */
    public static function resizeImage($model, $fieldName, $aSize) {
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.self::$folderUpload;
        $ImageHelper->file = $model->$fieldName;
        $ImageHelper->aRGB = array(0, 0, 0);//full black background
        $ImageHelper->thumbs = $aSize;
//        $ImageHelper->createFullImage = true;
        $ImageHelper->createThumbs();        
    }    
    
    public static function RemoveFileOnly($pk, $fieldName, $aSize) {
        $modelRemove = self::model()->findByPk($pk);
        if (is_null($modelRemove) || empty($modelRemove->$fieldName))
            return;
        $pathUpload = ProInventoryPhoto::$folderUpload;
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $modelRemove->$fieldName);        
        foreach ( $aSize as $key => $value) {
            $ImageHelper->deleteFile($ImageHelper->folder . '/' . $key . '/' . $modelRemove->$fieldName);
        }        
        
    }     
    
    protected function beforeDelete() {
        self::RemoveFileOnly($this->id, 'file_name', ProInventoryPhoto::$aSize);
        return parent::beforeDelete();
    }
    
    public static function deleteByXXXXX($enquiry_global_id){ // chưa biết là delete theo cái nào 
        $criteria = new CDbCriteria();
        $criteria->compare("t.enquiry_global_id", $enquiry_global_id);
        $models = self::model()->findAll($criteria);
        ProTransactions::deleteArrModel($models);
    }
    
    /**
     * @Author: ANH DUNG Jul 25, 2014
     * @Todo: get list model by transaction id and uid
     * @Param: $user_id, $transaction_id
     */
    public static function GetByUidAndTransactionId($user_id, $transaction_id){
        $criteria = new CDbCriteria();
//        $criteria->compare('t.user_id', $user_id);
        $criteria->compare('t.transaction_id', $transaction_id);
        $criteria->order = 't.id';
        return self::model()->findAll($criteria);
    }
    
        
}