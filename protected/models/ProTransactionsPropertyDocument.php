<?php

/**
 * This is the model class for table "{{_pro_transactions_property_document}}".
 *
 * The followings are the available columns in table '{{_pro_transactions_property_document}}':
 * @property string $id
 * @property string $transactions_id
 * @property string $user_id
 * @property string $title
 * @property string $file_name
 */
class ProTransactionsPropertyDocument extends CActiveRecord {

    public static $AllowFile = 'doc,docx,pdf,jpg,jpeg,png';
    public static $folderUpload = 'upload/transactions/property_document';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{_pro_transactions_property_document}}';
    }

    public function rules() {
        return array(
            array('title', 'required', 'on' => 'UploadDocument, upload'),
            array('file_name', 'required', 'on' => 'upload'),
            array('title', 'length', 'max' => 300),
            array('id, transactions_id, user_id, title, file_name,order_no', 'safe'),
            array('file_name', 'file', 'on' => 'UploadDocument, upload',
                'allowEmpty' => true,
                'types' => ProTransactionsPropertyDocument::$AllowFile,
                'wrongType' => Yii::t('lang', "Only " . ProTransactionsPropertyDocument::$AllowFile . " are allowed."),
            ),
        );
    }

    public function relations() {
        return array(
            'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'transactions_id' => 'Transactions',
            'user_id' => 'User',
            'title' => 'Title',
            'file_name' => 'File Name',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.transactions_id', $this->transactions_id, true);
        $criteria->compare('t.user_id', $this->user_id, true);
        $criteria->compare('t.title', $this->title, true);
        $criteria->compare('t.file_name', $this->file_name, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    /**
     * @Author: ANH DUNG Apr 01, 2014
     * @Todo: validate file upload
     * @Param: $model model $mTransactions
     * $mPropertyDocument is $mTransactions->mPropertyDocument
     * @Return: $model after validate
     */
    public static function validateFile($model) {
        /**
         * Dtoan Fixbug
         * dong dong  $model->aModelPropertyDocument = array();
         * Ly do bien aModelPropertyDocument da co du lieu roi khi update.
         *  submit validte error se mat file khi update
         */
        //$model->aModelPropertyDocument = array();


        if (isset($model->aModelPropertyDocument) && count($model->aModelPropertyDocument) > 0) {
            $arrTmp = array();
            foreach ($model->aModelPropertyDocument as $fileTmp) {
                $arrTmp[$fileTmp->title] = $fileTmp;
            }
            $model->aModelPropertyDocument = $arrTmp;
        }



        if (isset($_POST['ProTransactionsPropertyDocument']['title']) && count($_POST['ProTransactionsPropertyDocument']['title'])) {
            foreach ($_POST['ProTransactionsPropertyDocument']['title'] as $key => $item) {

                /**
                 * Dtoan Fixbug
                 * Kiem tra file submit
                 */
                $checkFileExit = CUploadedFile::getInstance($model->mPropertyDocument, 'file_name[' . $key . ']');
                if ($checkFileExit) {
                    $mFile = new ProTransactionsPropertyDocument('UploadDocument');
                    $mFile->file_name = CUploadedFile::getInstance($model->mPropertyDocument, 'file_name[' . $key . ']');
                    $mFile->title = $item;
                    //                if(!is_null($mFile->file_name)){
                    $mFile->validate();
                    //                    if($mFile->hasErrors()){
                    //                        $model->addErrors ($mFile->getErrors());
                    //                        break;
                    //                    }
                    //                }           
                    $model->aModelPropertyDocument[$mFile->title] = $mFile;
                }
            }
        }
    }

    /**
     * @Author: ANH DUNG Apr 01, 2014
     * @Todo: save new record of property document
     * @Param: $model model transaction
     */
    public static function saveRecord($model) {
        self::deleteByTransactionId($model->id);
        if (isset($_POST['ProTransactionsPropertyDocument']['title']) && count($_POST['ProTransactionsPropertyDocument']['title'])) {
            $mPropertyDocument = $model->mPropertyDocument;
            foreach ($_POST['ProTransactionsPropertyDocument']['title'] as $key => $item) {
                $mFile = new ProTransactionsPropertyDocument('UploadDocument');
                $mFile->transactions_id = $model->id;
                $mFile->title = InputHelper::removeScriptTag($item);
                $mFile->order_no = $key;
                $mFile->file_name = CUploadedFile::getInstance($mPropertyDocument, 'file_name[' . $key . ']');

                if (!is_null($mFile->file_name)) {
                    $mFile->file_name = self::saveFile($mFile, 'file_name', self::$folderUpload, $key);
                }
                if (!empty($mFile->title) && !empty($mFile->file_name)) {
                    $mFile->save();
                }
            }
        }
    }

    /**
     * Apr 01, 2014 - ANH DUNG
     * To do: save file 
     * @param: $model transactions
     * @param: $nameField ex: file_name
     * @param: $pathUpload ex: 'upload/transactions/property_document';  
     * @param: $nameBase name to show if need (option)
     * public static $folderUpload='upload/products/';
     * @return: name of image
     */
    public static function saveFile($model, $nameField, $pathUpload, $count) {
        if (is_null($model->$nameField))
            return '';
        $ext = $model->$nameField->getExtensionName();
//        $nameBase = $model->$nameField->getName();
//        $nameBase = str_replace(strtolower($ext), '', $nameBase);
//        $nameBase = str_replace(strtoupper($ext), '', $nameBase);
//        $nameBase = trim($nameBase, '.');        
        $fileName = MyFunctionCustom::slugify($model->$nameField->getName());
        $fileName = str_replace(strtolower($ext), '', $fileName);
        $fileName = trim($fileName, '-');
        $fileName = trim($fileName);
//        $fileName = time().'_'.$fileName.'.'.$ext;
        $fileName = $fileName . '-' . time() . $count . '.' . $ext;
//        $fileName = $fileName.'.'.$ext;
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload . '/' . $model->transactions_id);
        $model->$nameField->saveAs($pathUpload . '/' . $model->transactions_id . '/' . $fileName);
        return $fileName;
    }

    // to get link download document
    public static function getLinkDownDocument($model) {
        return Yii::app()->createAbsoluteUrl('/') . "/" . self::$folderUpload . "/$model->transactions_id/$model->file_name";
    }

    /**
     * Apr 01, 2014 - ANH DUNG
     * To do: delete file  of Product
     * @param: $model ProTransactionsPropertyDocument
     * @param: $nameField ex: file_name
     * @param: $pathUpload ex: 'upload/transactions/property_document';  
     */
    public static function deleteOldFile($model, $nameField, $pathUpload) {
        $modelDel = self::model()->findByPk($model->id);
        if (is_null($modelDel) || empty($modelDel->$nameField))
            return;
        self::removeFile($modelDel);
    }

    /**
     * @Author: ANH DUNG  Apr 01, 2014
     * @Todo: only remove file of transaction
     * @Param: $modelDel is model ProTransactionsPropertyDocument     
     */
    public static function removeFile($modelDel) {
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = '/' . self::$folderUpload . '/' . $modelDel->transactions_id;
        $ImageProcessing->delete($ImageProcessing->folder . '/' . $modelDel->file_name);
    }

    protected function beforeDelete() {
        self::removeFile($this);
        return parent::beforeDelete();
    }

    // delete model and unlink file by $transactions_id
    public static function deleteByTransactionId($transactions_id) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.transactions_id', $transactions_id);
        if (isset($_POST['ProTransactionsPropertyDocument']['id']) && is_array($_POST['ProTransactionsPropertyDocument']['id'])) {
            $criteria->addNotInCondition('t.id', $_POST['ProTransactionsPropertyDocument']['id']);
        }
        $models = self::model()->findAll($criteria);
        if (count($models)) {
            foreach ($models as $item)
                $item->delete();
        }
    }

    /**
     * @Author: ANH DUNG Apr 01, 2014
     * @Todo: get array default 3 title The first three documents are auto-showed to be uploaded.
     * @param: $type ex is 1: for sale, 2: for rent
     * @Return: array
     */
    public static function getDefaultArrayForCreate($type) {
        $m1 = new ProTransactionsPropertyDocument();
        $m1->title = 'Option to Purchase';
        if ($type == ProTransactions::FOR_RENT)
            $m1->title = 'Tenancy Agreement';
        $m1->order_no = 0;
        $m2 = new ProTransactionsPropertyDocument();
        $m2->title = 'Service fee agreement';
        $m2->order_no = 1;
        $m3 = new ProTransactionsPropertyDocument();
        $m3->title = 'CEA Agreement';
        $m3->order_no = 2;

        return array($m1, $m2, $m3);
    }

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
    public static function getListDocument($transaction_id) {
        $criteria = new CDbCriteria;
//        $criteria->compare('t.user_id', Yii::app()->user->id);
        $criteria->compare('t.transactions_id', $transaction_id);
        $criteria->order = 'order_no ASC';

        return new CActiveDataProvider('ProTransactionsPropertyDocument', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
        ));
    }

    //HTram
    public static function getDocumentOfTransactionAndTitle($transaction_id, $title) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.transactions_id', $transaction_id);
        $criteria->compare('t.title', $title);
        $criteria->order = 'order_no ASC';

        $model = self::model()->find($criteria);
        if ($model) {
            return $model;
        }
        return;
    }

    //HTram
    public static function SaveFileDocument($mFile,$title,$key,$id_transaction) {
        $mFile->transactions_id = $id_transaction;
        $mFile->title = InputHelper::removeScriptTag($title);
        $mFile->order_no = $key;
        $mFile->file_name = CUploadedFile::getInstance($mFile, 'file_name[' . $key . ']');

        if (!is_null($mFile->file_name)) {
            $mFile->file_name = ProTransactionsPropertyDocument::saveFile($mFile, 'file_name', ProTransactionsPropertyDocument::$folderUpload, $key);
        }
        if (!empty($mFile->title) ) {
            $mFile->save();
            $response['code'] = true;
            $response['message'] = 'successfully';
        }
    }
    //HTram
    public static function getListDocumentByTransaction($transaction_id) {
        $criteria = new CDbCriteria;
        $criteria->compare('t.transactions_id', $transaction_id);
        $criteria->order = 'order_no ASC';
        $model = self::model()->findAll($criteria);
        if ($model) {
            return $model;
        }
        return;
       
    }

}
