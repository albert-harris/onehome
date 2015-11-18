<?php
class HelperFunction extends CActiveRecord
{

        public function unlinkAllFileInFolder($path) {
            $files = glob($path.'/*'); // get all file names
            foreach($files as $file){ // iterate files
                if(is_file($file))
                    unlink($file); // delete file
            }
        }   
        
        public static function unlinkFile($path){
                if(file_exists($path)) 
                    unlink($path);
        }
        
        public function insertPhotoNomal($path,$file,$user_id){
             if(!$file)
                return false;
            $file->saveAs($path.$user_id.'/'.$file->name);
            return $file->name;
        }
        
        public function insertPhotoResize($path,$file,$user_id,$resizeW,$resizeH){
             if(!$file) return false;            
            $thumb1=new EPhpThumb();
            $thumb1->init(); 
            $thumb1->create($path.$user_id.'/'.$file->name)
                    ->resize($resizeW,$resizeH)
                    ->save($path.$user_id.'/'.$resizeW.'x'.$resizeH.$file->name);
            return $file->name;
        }
        
        public function displayPhoto($path, $width, $height){
            return $path;
        }        
    
}