<?php

/**
 * 
 * @todo Class for handle image. Required: EPhpThumb extension
 * @author qbao@verzdesign.co
 * @example Using create_thumbs function
 *
 */
class ImageProcessing {

    public $folder = 'upload';
    public $file = '';
    public $thumbs = array();

    /**
     * @todo Create thumb images to specific folders from exist image 
     * @example 
     * $ImageProcessing = new ImageProcessing();
     * $ImageProcessing->folder = '/upload/admin/artist';         
     * $ImageProcessing->file = 'photo.jpg';
     * $ImageProcessing->thumbs =array('thumb1' => array('width'=>'1336','height'=>'768'),
     *                                  'thumb2' =>  array('width'=>'800','height'=>'600'));
     *   $ImageProcessing->create_thumbs();
     * @author bb
     */
    public function create_thumbs() {
        if (count($this->thumbs) > 0) {
            $this->createDirectoryByPath($this->folder);
            foreach ($this->thumbs as $folderThumb => $size) {
                $this->createSingleDirectoryByPath($this->folder . '/' . $folderThumb);

                $thumb = new EPhpThumb($this->folder);
                $thumb->init();
                $thumb->create(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $this->file)
                        ->resize($size['width'], $size['height'])
                        ->save(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $folderThumb . '/' . $this->file);
            }
        }
    }

    /**
     * @todo delete image file
     * @param type $source: "/upload/admin/artist/photo.jpg"
     * @author bb
     */
    public function delete($source) {//  "/upload/admin/artist/photo.jpg"
        if (file_exists(Yii::getPathOfAlias("webroot") . $source))
            unlink(Yii::getPathOfAlias("webroot") . $source);
//        if(file_exists($source))
//            unlink($source);
    }

    /** it is static function 
     * @todo delete image file
     * @param type $source: "/upload/admin/artist/photo.jpg"
     * @author NguyenDung
     */
    public static function deleteFile($source) {//  "/upload/admin/artist/photo.jpg"
        if (file_exists(Yii::getPathOfAlias("webroot") . $source))
            unlink(Yii::getPathOfAlias("webroot") . $source);
    }

    /**
     * 
     * @todo RESIZE & CROP
     * @param type $fileName
     * @example 
     * $ImageProcessing = new ImageProcessing();
      $ImageProcessing->folder = '/upload/admin/artist';
      $ImageProcessing->file = 'photo.jpg';
      $ImageProcessing->thumbs =array('width'=>'1336','height'=>'768');
      $ImageProcessing->resizeAndCrop('fileNameOfDestinationImage');
     * @author bb
     */
    public function resizeAndCrop($fileName) {
        $thumb = new EPhpThumb();
        $thumb->init();
        $thumb->create(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $this->file)
                ->adaptiveResize($this->thumbs['width'], $this->thumbs['height'])
                ->save(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $fileName);
    }

    /**
     * 
     * @todo create directory from path
     * @param type $path: '/upload/admin/artist'
     * @author bb
     */
    public function createDirectoryByPath($path) {
        $aFolder = explode('/', $path);
        if (is_array($aFolder)) {
            $this->removeEmptyItemFromArray($aFolder);
            $root = Yii::getPathOfAlias('webroot');

            $currentPath = $root;
            foreach ($aFolder as $key => $folder) {
                $currentPath = $currentPath . '/' . $folder;
                if (!is_dir($currentPath))
                    mkdir($currentPath);
            }
        }
    }

    public function removeEmptyItemFromArray(&$arr) {
        foreach ($arr as $key => $value)
            if (is_null($value)) {
                unset($arr[$key]);
            }
    }

    /**
     * @todo create directory from path
     * @param type $path: /upload/member/555/avatar
     * @author NguyenDung
     */
    public static function createDirectory($path) {
        $path = trim($path, '/');
        $aFolder = explode('/', $path);
        if (is_array($aFolder)) {
            $root = Yii::getPathOfAlias('webroot');
            $currentPath = $root;
            foreach ($aFolder as $folder) {
                $currentPath = $currentPath . '/' . $folder;
                if (!is_dir($currentPath)) {
                    mkdir($currentPath);
                    chmod($currentPath, 0755);
                }
            }
        }
    }

    /**
     * 
     * @todo Create single directory. 
     *          Create directory from the last path.
     *          You have to make sure that the parent directorry already exists
     * @param string $path: '/upload/admin/artist/thumb'
     * @author bb
     * 
     */
    public function createSingleDirectoryByPath($path) {
        $path = Yii::getPathOfAlias('webroot') . $path;
        if (!is_dir($path))
            mkdir($path);
    }

    /**
     * 
     * @todo bind image by phpthumb for unavailable size of no image for other case
     * 
     * Return absolute url by relative path. If no image exist. It will return noimage url
     * Require an exist noimage in format:   "/upload/noimage/200x300.jpg"
     * 
     * @param string $path relative path "/upload/noimage/200x300.jpg"
     * @param int $width 
     * @param int $height          * 
     * 
     * @copyright (c) 12/6/2013, bb Verz Design
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function bindImage($path, $width, $height) {
        $noimagePath = '/upload/noimage/' . $width . 'x' . $height . 'noimage.jpg';
        $absolutePath = Yii::app()->baseUrl . $path;
        if (!file_exists(Yii::getPathOfAlias("webroot") . $path)) {
            if (!file_exists(Yii::getPathOfAlias("webroot") . $noimagePath))
                return Yii::app()->baseUrl . '/upload/noimage/noimage-all.jpg';
            return Yii::app()->baseUrl . $noimagePath;
        }

        return $absolutePath;
    }

    /**
     * <Jason>
     * <Email: pmhai90@gmail.com>
     */
    public static function bindImageModule($path, $width, $height) {
        $noimagePath = 'no-img.jpg';
        $absolutePath = Yii::app()->baseUrl . "/themes/mindedge/img/" . $noimagePath;
        if (file_exists(Yii::getPathOfAlias("webroot") . $path) != NULL) {
            if (!file_exists(Yii::app()->baseUrl . $path))
                return Yii::app()->baseUrl . $path;
            return Yii::app()->baseUrl . '/upload/noimage/noimage-all.jpg';
        }

        return $absolutePath;
    }

    /**
     * Return href of image by model
     * 
     * @param model $model
     * @param int $width
     * @param int $height
     * 
     * @return string href
     * 
     * @copyright (c) 12/6/2013, bb Verz Design
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function bindImageByModel($model, $width = null, $height = null, $customField = array()) {
        $className = get_class($model);
        if ($className == 'Banners') {
            $path = '/upload/admin/banner/' . $model->id . "/" . $width . 'x' . $height . '/' . $model->large_image;
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'Users') {
            if (isset($customField['avatar'])) {
                if ($width == null && $height == null) {
                    $path = '/' . Users::$folderUpload . '/' . $model->id . '/avatar/' . $model->avatar;
                } else {
                    $path = '/' . Users::$folderUpload . '/' . $model->id . '/avatar' . "/" . $width . 'x' . $height . '/' . $model->avatar;
                }
            }
            if (isset($customField['agent_company_logo'])) {
                $path = '/' . Users::$folderUpload . '/' . $model->id . '/avatar' . "/" . $width . 'x' . $height . '/' . $model->agent_company_logo;
            }

            return self::bindImage($path, $width, $height);
        } elseif ($className == 'ProListingPhotos') {
            $path = '/' . ProListingPhotos::$folderUpload . '/' . $model->listing_id . '/' . $width . 'x' . $height . '/' . $model->image;
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'ProReportDefect') {
            $path = '/' . ProReportDefect::$folderUpload . '/' . $model->id . '/' . $width . 'x' . $height . '/' . $model->photo;
            return self::bindImage($path, $width, $height);
        } 
        elseif ($className == 'ProInventoryPhoto') {
            if($width==-1 && $height==-1){
                $path = '/' . ProInventoryPhoto::$folderUpload . '/'. $model->file_name;
            }else{
                $path = '/' . ProInventoryPhoto::$folderUpload . '/' . $width . 'x' . $height . '/' . $model->file_name;
            }            
            return self::bindImage($path, $width, $height);
        } 
        else {
            $path = '/upload/settings/noimage';
            return self::bindImage($path, $width, $height);
        }
    }

    //tuan-user to advertisement
    public function delete_advertise($source) {//  "/upload/admin/artist/photo.jpg"
//        if(file_exists(Yii::getPathOfAlias("webroot").$source))
//            unlink(Yii::getPathOfAlias("webroot").$source);
        if (file_exists($source))
            unlink($source);
    }

    /*
     * ---------------------------------------------
     * Author : dtoan
     * Email  : ghostkissboy12@gmail.com
     * addWarterMark
     * $groundImage : duong dan file goc
     * $dirwartermark : duong dan file sau khi dong dau hinh
     * $waterPos : vi tri duoc dong dau ( 1->9)
     * $waterImage : duong dan hinh dong dau
     * ---------------------------------------------
     */

    public static function addWarterMark($groundImage, $dirwartermark = null, $waterPos = 5, $waterImage = null) {
        if (!empty($dirwartermark)) {
            @copy($groundImage, $dirwartermark);
            $groundImage = $dirwartermark;
        }
        if (empty($waterImage)) {
            $waterImage = Yii::getPathOfAlias('webroot') . '/upload/admin/settings/'.Yii::app()->params['image_watermark'];            
            if(!file_exists($waterImage) && !is_dir($waterImage)) return ;
        }

       
        
        $water_info = getimagesize($waterImage);
        $w = $water_info[0];
        $h = $water_info[1];
        $water_im = imagecreatefrompng($waterImage);
        imageAlphaBlending($water_im, false);
        imageSaveAlpha($water_im, true);

        if (!empty($groundImage) && file_exists($groundImage)) {
            $ground_info = getimagesize($groundImage);
            $ground_w = $ground_info[0];
            $ground_h = $ground_info[1];
            switch ($ground_info[2]) {
                case 1:$ground_im = imagecreatefromgif($groundImage);
                    break;
                case 2:$ground_im = imagecreatefromjpeg($groundImage);
                    break;
                case 3:$ground_im = imagecreatefrompng($groundImage);
                    break;
                default:die($formatMsg);
            }
        } else {
            die("File error");
        }

        if (($ground_w < $w) || ($ground_h < $h))
            return;

        switch ($waterPos) {
            case 0:
                $posX = rand(0, ($ground_w - $w));
                $posY = rand(0, ($ground_h - $h));
                break;
            case 1:
                $posX = 0;
                $posY = 0;
                break;
            case 2:
                $posX = ($ground_w - $w) / 2;
                $posY = 0;
                break;
            case 3:
                $posX = $ground_w - $w;
                $posY = 0;
                break;
            case 4:
                $posX = 0;
                $posY = ($ground_h - $h) / 2;
                break;
            case 5:
                $posX = ($ground_w - $w) / 2;
                $posY = ($ground_h - $h) / 2;
                break;
            case 6:
                $posX = $ground_w - $w;
                $posY = ($ground_h - $h) / 2;
                break;
            case 7:
                $posX = 0;
                $posY = $ground_h - $h;
                break;
            case 8:
                $posX = ($ground_w - $w) / 2;
                $posY = $ground_h - $h;
                break;
            case 9:
                $posX = $ground_w - $w;
                $posY = $ground_h - $h;
                break;
            default:
                $posX = rand(0, ($ground_w - $w));
                $posY = rand(0, ($ground_h - $h));
                break;
        }

        imagealphablending($ground_im, true);
        imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $w, $h);
        @unlink($groundImage);

        ImageJpeg($ground_im, $groundImage);
        if (isset($water_info))
            unset($water_info);
        if (isset($water_im))
            imagedestroy($water_im);
        unset($ground_info);
        imagedestroy($ground_im);
    }       

}