<?php
class Verz_filter {

         public static $array_tags = array('script','a','img','iframe');
	public  static function string($strTemp) {
// 		$strTemp = 'this    -post-demo2as    dasd&^*^%$#!@#%^&*~!(^#@#';
		$patem = '#(!|@|\#|\$|%|\^|&|\*|\(|\)|~|\s)#imsU';
		$strTemp = preg_replace($patem,'',$strTemp);
		return trim($strTemp);
	}
	 

        
        // tuan daklak
        public static function strip_only($str, $tags) {
                foreach($tags as $tag){ 
                    $str =  preg_replace('#</?'.$tag.'[^>]*>#is', '', $str);
                }
                return $str;
        }
        public static function strip_only_model($model){
            $array_attr = $model->getAttributes();
            foreach ($array_attr as $name=>$value){
                if(in_array($name,array('name','email','subject','message'))){
                  $model->$name = self::strip_only($model->$name,self::$array_tags);
                  $model->$name = strip_tags($model->$name);
                }
            }
        }

	
	
}