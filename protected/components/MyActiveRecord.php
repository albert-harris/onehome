<?php
class MyActiveRecord extends CActiveRecord{
    
    public $aAttributesBeforeSave = array();//first time load model
    public $aImageSize = array();
    
        /**
        * 
        * @param type $fieldName
        * @param type $path 'upload/imageExample/123456789'
        * @param type $oldImage old image filename to delete after resize
        * @return string
        * @copyright (c) 2014, bb
        */
        public function saveImage($fieldName, $path)
        {
           if(array_key_exists($fieldName, $this->aAttributesBeforeSave))
                $oldImage = $this->aAttributesBeforeSave[$fieldName];
           if (is_null($this->$fieldName))
           {               
               if(!empty($oldImage))
               {
                    $this->$fieldName = $oldImage;
                    $this->update(array($fieldName));
               }
               return false;
           }
           if(!empty($oldImage))
                $this->deleteImage($fieldName,$path, $oldImage);
           $ext = $this->$fieldName->getExtensionName();
           $fileName = time() . '_' .$this->id.'_'. $fieldName . '.' . $ext;
           $imageHelper = new ImageHelper();
           $imageHelper->createDirectoryByPath($path);
           $this->$fieldName->saveAs($path. '/' . $fileName);
           $this->$fieldName = $fileName;
           $this->update(array($fieldName));
           
           if(array_key_exists($fieldName, $this->aImageSize) && is_array($this->aImageSize[$fieldName]))
           {
               $this->resizeImage($fieldName, $path);
           }
       }

        //bb
        public function resizeImage($fieldName, $path)
        {
            $ImageHelper = new ImageHelper();
            $ImageHelper->folder = $path;
            $ImageHelper->file = $this->$fieldName;
            $ImageHelper->thumbs = $this->aImageSize[$fieldName];
            $ImageHelper->createThumbs();
        }

        //bb
        public function deleteImage($fieldName, $path, $oldImage)
        {
            if (!empty($oldImage)) {
                ImageHelper::deleteFile($path. '/' . $oldImage);
                if(array_key_exists($fieldName, $this->aImageSize) && is_array($this->aImageSize[$fieldName]))
                {
                    $aSize = $this->aImageSize[$fieldName];
                    foreach ($aSize as $key => $value) {
                        ImageHelper::deleteFile($path.'/' . $key . '/' . $oldImage);
                    }
                }
            }
        }
        
        //bb
        public function getImageUrl($fieldName, $width, $height)
        {
            //you must code in each extend class
        }
        
        //bb
        protected function beforeValidate()
        {
            foreach($this->aImageSize as $fieldName=>$aSize)
            {
                $this->$fieldName = CUploadedFile::getInstance($this, $fieldName);
            }
            return parent::beforeValidate();
        }
        
        //bb
        protected function beforeSave()
        {
            if(!$this->isNewRecord)
            {
                if(count($this->aAttributesBeforeSave) == 0)
                {
                    $model = call_user_func(array(get_class($this) , 'model'));
                    $mBeforeSave = $model->findByPk($this->id);
                    $this->aAttributesBeforeSave = $mBeforeSave->attributes;
                }
            }
            return parent::beforeSave();
        }
        
}

