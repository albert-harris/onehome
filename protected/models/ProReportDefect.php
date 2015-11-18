<?php

/**
 * This is the model class for table "{{_pro_report_defect}}".
 *
 * The followings are the available columns in table '{{_pro_report_defect}}':
 * @property integer $id
 * @property string $created_date
 * @property string $description
 * @property integer $location
 * @property string $photo
 * @property integer $status
 */
class ProReportDefect extends CActiveRecord {

    public static $AllowFile = 'jpg,jpeg,png';
    public static $folderUpload = 'upload/reportdefect';
    public static $aSize = array(
        '140x105' => array('width' => 140, 'height' => 105), // 
        '1024x768' => array('width' => 1024, 'height' => 768), // 
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProReportDefect the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_pro_report_defect}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('description, photo, location_text', 'required', 'on' => 'create'),
            array('description, location_text', 'required', 'on' => 'update'),
            array('status', 'required', 'on' => 'UpdateDefectStatus'),
            array('status,approved_date,remark', 'required', 'on' => 'UpdateDefectStatusComplete'),
            array('status', 'numerical', 'integerOnly' => true),
            array('photo', 'length', 'max' => 255),
            array('photo', 'file',
                'allowEmpty' => true,
                'types' => ProReportDefect::$AllowFile,
                'wrongType' => Yii::t('lang', "Only " . self::$AllowFile . " are allowed."),
            ),
            array('location_text, approved_by_progess,approved_by_complete,approved_date,remark,id, transaction_id, created_date, description, location_id, photo, status', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'rLocation' => array(self::BELONGS_TO, 'ProMasterLocationReportDefect', 'location_id'),
            'rTransactions' => array(self::BELONGS_TO, 'ProTransactions', 'transaction_id'),
            'rUserProgess' => array(self::BELONGS_TO, 'Users', 'approved_by_progess'),
            'rUserComplete' => array(self::BELONGS_TO, 'Users', 'approved_by_complete'),
        );
    }

    public static function GetViewLocation($model) {
        return $model->rLocation ? $model->rLocation->name : '';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'created_date' => 'Date/Time',
            'description' => 'Description',
            'location_id' => 'Location',
            'photo' => 'Uploaded Photos',
            'status' => 'Status',
            'approved_date' => 'Approved On',
            'approved_by_progess' => 'Approved By',
            'location_text' => 'Location',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.created_date', $this->created_date, true);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.transaction_id', $this->transaction_id);
        $criteria->compare('t.location', $this->location_id);
        $criteria->compare('t.photo', $this->photo, true);
        $criteria->compare('t.status', $this->status);
        $criteria->order = "t.id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
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

    public function defaultScope() {
        return array(
                //'condition'=>'',
        );
    }

    /**
     * @return CActiveDataProvider
     * <Jason>
     * <To get list document for tencancy>
     */
    public static function getListReport($transaction_id) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.transaction_id', $transaction_id);
//        $criteria->compare('t.user_id', Yii::app()->user->id);
        $criteria->order = 'created_date DESC';

        return new CActiveDataProvider('ProReportDefect', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public static function save_photo($model) {
        if (!is_null($model->photo)) {
            $model->photo = self::saveFile($model, 'photo', self::$folderUpload, 1);
            self::resizeImage($model, 'photo', self::$aSize);
            $model->update(array('photo'));
        }
        return $model->photo;
    }

    /**
     * Apr 11, 2014 - Jason
     * To do: save file
     * @param: $model model reportdefect
     * @param: $nameField ex: file_name
     * @param: $pathUpload ex: 'upload/reportdefect'
     * @return: name of image
     */
    public static function saveFile($model, $nameField, $pathUpload, $count) {
        if (is_null($model->$nameField))
            return '';
        $ext = $model->$nameField->getExtensionName();
        $fileName = MyFunctionCustom::slugify($model->$nameField->getName());
        $fileName = str_replace(strtolower($ext), '', $fileName);
        $fileName = trim($fileName, '-');
        $fileName = trim($fileName);
        $fileName = $fileName . '-' . time() . $count . '.' . $ext;

        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload . '/' . $model->id);
        $model->$nameField->saveAs($pathUpload . '/' . $model->id . '/' . $fileName);
        return $fileName;
    }

    /**
     * @Author: ANH DUNG Jul 25, 2014
     * @Todo: resize photo
     * @Param: $model, $fieldName, $aSize
     */
    public static function resizeImage($model, $fieldName, $aSize) {
        $ImageHelper = new ImageHelper();
        $ImageHelper->folder = '/' . self::$folderUpload . '/' . $model->id;
        $ImageHelper->file = $model->$fieldName;
        $ImageHelper->aRGB = array(0, 0, 0); //full black background
        $ImageHelper->thumbs = $aSize;
//        $ImageHelper->createFullImage = true;
        $ImageHelper->createThumbs();
    }

    public function beforeDelete() {
        try {
            self::removeFile($this, 'photo', self::$folderUpload);
            self::deleteImage($this);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }

        return parent::beforeDelete();
    }

    /**
     * @Author: Jason  Apr 11, 2014
     * @Todo: only remove file of report defect
     * @Param: $modelDel is model DeportDefect
     * @Param: $nameField field file in model report
     */
    public static function removeFile($modelDel, $nameField, $pathUpload) {
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = '/' . $pathUpload . '/' . $modelDel->id;
        $ImageProcessing->delete($ImageProcessing->folder . '/' . $modelDel->$nameField);

//        $ImageHelper = new ImageHelper();     
//        $ImageHelper->folder = '/'.$pathUpload;
//        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $modelRemove->$fieldName);        
//        foreach ( $aSize as $key => $value) {
//            $ImageHelper->deleteFile($ImageHelper->folder . '/' . $key . '/' . $modelRemove->$fieldName);
//        }           
        foreach (self::$aSize as $key => $value) {
            $ImageProcessing->deleteFile($ImageProcessing->folder . '/' . $key . '/' . $modelDel->$nameField);
        }
    }

    /*
     * @Author: Jason Apr 11, 2014
     * To do: delete photo
     */

    public static function deleteImage($model) {
        $model = self::model()->findByPk($model->id);
        if (is_null($model) || empty($model->photo))
            return;
        $ImageHelper = new ImageHelper();
        $ImageHelper->folder = '/' . self::$folderUpload . '/' . $model->id;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $model->photo);
    }

    protected function beforeSave() {
        if (!empty($this->approved_date) && strpos($this->approved_date, '/')) {
            $this->approved_date = MyFormat::dateConverDmyToYmd($this->approved_date);
        }
        return parent::beforeSave();
    }

    public function searchFE() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.created_date', $this->created_date, true);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.transaction_id', $this->transaction_id);
        $criteria->compare('t.location', $this->location_id);
        $criteria->compare('t.photo', $this->photo, true);
        $criteria->compare('t.status', $this->status);
        $criteria->order = "t.id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 4,
            ),
        ));
    }

}
