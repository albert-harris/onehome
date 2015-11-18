<?php

/**
 * This is the model class for table "{{_pro_enquiry_global_file}}".
 *
 * The followings are the available columns in table '{{_pro_enquiry_global_file}}':
 * @property integer $id
 * @property string $enquiry_global_id
 * @property string $file_name
 * @property integer $type
 * @property string $created_date
 */
class ProEnquiryGlobalFile extends CActiveRecord
{
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
        $aDate = explode('-', $model->date_only);
        $pathUpload = ProGlobalEnquiry::$folderUpload."/$aDate[0]/$aDate[1]/$aDate[2]";
        $ext = $model->$fieldName->getExtensionName();
        $file_name_slug = strtolower(MyFunctionCustom::slugify($model->$fieldName->getName()));
        $file_name_slug = str_replace(strtolower($ext), '', $file_name_slug);
        $model->file_name_slug = $file_name_slug;
        $fileName = date('Y-m-d');
        $fileName = time().'-'.ActiveRecord::randString().'.'.$ext;
        $imageProcessing = new ImageProcessing();
        $imageProcessing->createDirectoryByPath($pathUpload);
        $model->$fieldName->saveAs($pathUpload.'/'.$fileName);
        $model->$fieldName = $fileName;
        
        return $fileName;
    }
    
    public static function RemoveFileOnly($pk, $fieldName) {
        $modelRemove = self::model()->findByPk($pk);
        if (is_null($modelRemove) || empty($modelRemove->$fieldName))
            return;
        $aDate = explode('-', $modelRemove->date_only);
        $pathUpload = ProGlobalEnquiry::$folderUpload."/$aDate[0]/$aDate[1]/$aDate[2]";
        $ImageHelper = new ImageHelper();     
        $ImageHelper->folder = '/'.$pathUpload;
        $ImageHelper->deleteFile($ImageHelper->folder . '/' . $modelRemove->$fieldName);
    }     
    
    protected function beforeDelete() {
        self::RemoveFileOnly($this->id, 'file_name');
        return parent::beforeDelete();
    }
    
    public static function deleteByGlobalEnquiryId($enquiry_global_id){
        $criteria = new CDbCriteria();
        $criteria->compare("t.enquiry_global_id", $enquiry_global_id);
        $models = self::model()->findAll($criteria);
        ProTransactions::deleteArrModel($models);
    }    
        
    /**
     * @Author: ANH DUNG Jul 07, 2014
     * @Todo: update $enquiry_global_id cho mảng aId
     * @Param: $enquiry_global_id, $aId
     */
    public static function UpdateEnquiryGlobalId($enquiry_global_id, $aId){
        if(count($aId)<1 || !self::ValidArrId($aId)) return ;
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $aId);
        ProEnquiryGlobalFile::model()->updateAll(array('enquiry_global_id'=>$enquiry_global_id),
                    $criteria);        
    }
    
    
    // Kiểm tra mảng id submit lê có hợp lệ ko
    public static function ValidArrId($aId){
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $aId);
        $criteria->compare("date_only", date('Y-m-d'));
        $models = ProEnquiryGlobalFile::model()->findAll($criteria);
        if(count($models) != count($aId))
            return false;
        return true;
    }

    public static function BindLinkFile($model){
        $res = '';
        $aDate = explode('-', $model->date_only);
        $path = "/".ProGlobalEnquiry::$folderUpload."/$aDate[0]/$aDate[1]/$aDate[2]/$model->file_name";        
        if(!empty($model->file_name)
                &&
            file_exists(Yii::getPathOfAlias("webroot") . $path) != NULL
        ){
            $link = Yii::app()->createAbsoluteUrl('/').$path;
            $res = "<a href='$link' target='_blank'>$model->file_name</a>";
        }
        return $res;
    }

    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_enquiry_global_file}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('id, enquiry_global_id, file_name, type, created_date', 'safe'),
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
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'enquiry_global_id' => 'Enquiry Global',
                    'file_name' => 'File Name',
                    'type' => 'Type',
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

            $criteria->compare('t.id',$this->id);
            $criteria->compare('t.enquiry_global_id',$this->enquiry_global_id,true);
            $criteria->compare('t.file_name',$this->file_name,true);
            $criteria->compare('t.type',$this->type);
            $criteria->compare('t.created_date',$this->created_date,true);

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
}