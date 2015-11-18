<?php

/**
 * This is the model class for table "{{_pro_aircon_service}}".
 *
 * The followings are the available columns in table '{{_pro_aircon_service}}':
 * @property string $id
 * @property string $transaction_id
 * @property string $user_id
 * @property string $schedule_date
 * @property string $schedule_time
 * @property integer $status
 * @property string $upload_service_documents
 * @property string $created_date
 */
class ProAirconService extends CActiveRecord {

    public static $AllowFile = 'doc,docx,xls,xlsx,pdf,jpg,jpeg,png';
    public static $folderUpload = 'upload/aircon_service';

    const INCOMPLETE = 0;
    const COMPLETE = 1;

    public static $STATUS_AIRCON = array(
        ProAirconService::INCOMPLETE => 'Incomplete',
        ProAirconService::COMPLETE => 'Completed'
    );

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_pro_aircon_service}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
//            array('schedule_date, schedule_time, status, upload_service_documents', 'required', 'on'=>'create'),
            array('transaction_id, schedule_date, schedule_time', 'required', 'on' => 'create, updateTelemarketer'),
            array('status', 'required', 'on' => 'UpdateStatus'),
            array('upload_service_documents', 'required', 'on' => 'UploadServiceDocument'),
            array('schedule_time', 'length', 'max' => 10),
            array('upload_service_documents', 'length', 'max' => 255),
            array('id, transaction_id, user_id, schedule_date, schedule_time, status, upload_service_documents, created_date', 'safe'),
            array('remark', 'safe'),
            array('upload_service_documents', 'file',
                'allowEmpty' => true,
                'types' => self::$AllowFile,
                'wrongType' => Yii::t('lang', "Only " . self::$AllowFile . " are allowed."),
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'rTransactions' => array(self::BELONGS_TO, 'ProTransactions', 'transaction_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'transaction_id' => 'Transaction',
            'user_id' => 'User',
            'schedule_date' => 'Schedule Date',
            'schedule_time' => 'Schedule Time',
            'status' => 'Status',
            'upload_service_documents' => 'Upload Service Documents',
            'created_date' => 'Created Date',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.transaction_id', $this->transaction_id, true);
        $criteria->compare('t.user_id', $this->user_id, true);
        $criteria->compare('t.schedule_date', $this->schedule_date, true);
        $criteria->compare('t.schedule_time', $this->schedule_time, true);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.upload_service_documents', $this->upload_service_documents, true);
        $criteria->compare('t.created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public function defaultScope() {
        return array(
                //'condition'=>'',
        );
    }

    protected function beforeSave() {
        if (strpos($this->schedule_date, '/')) {
            $this->schedule_date = MyFormat::dateConverDmyToYmd($this->schedule_date);
        }

        return parent::beforeSave();
    }

    /**
     * @Author: ANH DUNG Jul 08, 2014
     */
    public function searchFe() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.transaction_id', $this->transaction_id);
//        $criteria->compare('t.user_id', Yii::app()->user->id);
        $criteria->order = 'created_date DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    public static function save_photo($model) {
        if (!is_null($model->upload_service_documents)) {
            $model->upload_service_documents = self::saveFile($model, 'upload_service_documents', self::$folderUpload, 1);
            $model->update(array('upload_service_documents'));
        }
        return $model->upload_service_documents;
    }

    /**
     * Jul 08, 2014 - ANH DUNG
     * To do: save file
     * @param: $model model ProAirconService:
     * @param: $nameField ex: file_name
     * @param: $pathUpload ex: 'upload/aircon_service:'
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
        $fileName = $fileName . '-' . time() . ActiveRecord::randString() . '.' . $ext;

        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
//        $imageProcessing->createDirectoryByPath($pathUpload.'/'.$model->id);
//        $model->$nameField->saveAs($pathUpload.'/'.$model->id.'/'.$fileName);
        $model->$nameField->saveAs($pathUpload . '/' . $fileName);
        return $fileName;
    }

    public function beforeDelete() {
        try {
            ProAirconService::removeFile($this, 'upload_service_documents', ProAirconService::$folderUpload);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }

        return parent::beforeDelete();
    }

    /**
     * @Author: Jul 08, 2014 - ANH DUNG
     * @Todo: only remove file
     * @Param: $modelDel is model ProAirconService
     * @Param: $nameField field file in model: upload_service_documents
     * @Param: $pathUpload self::$folderUpload)
     */
    public static function removeFile($modelDel, $nameField, $pathUpload) {
        $ImageProcessing = new ImageProcessing();
//        $ImageProcessing->folder = '/'.$pathUpload.'/'.$modelDel->id;
        $ImageProcessing->folder = '/' . $pathUpload;
        $ImageProcessing->delete($ImageProcessing->folder . '/' . $modelDel->$nameField);
    }

    //HTram August 28, 2015
    public function searchAtTenancy() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.transaction_id', $this->transaction_id, true);
        $criteria->compare('t.user_id', $this->user_id, true);
        $criteria->compare('t.schedule_date', $this->schedule_date, true);
        $criteria->compare('t.schedule_time', $this->schedule_time, true);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.upload_service_documents', $this->upload_service_documents, true);
        $criteria->compare('t.created_date', $this->created_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 8,
            ),
        ));
    }

}
