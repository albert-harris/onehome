<?php
/**
 * 
 * Class for handle data entry - data input. 
 * @author bb  <quocbao1087@gmail.com>
 * @copyright (c) 6/6/2013, bb
 *  
 */

class InputHelper
{   
    /**
     * Set attributes by indicate array
     * 
     * @param model $model
     * @param array $aAttributes
     * @param array $aInput
     * @example  
     *          $model = new Users;
     *          $aAttributes = array('first_name', 'last_name', 'email');
     *          $aInput = $_POST['Users'];
     *          InputHelper::setAttributes($model, $aAttributes, $aInput);    
     * 
     *          It will set $model->first_name = $aInput['first_name'], etc..
     * 
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 6/6/2013, bb
     */
    public static function setAttributes(&$model, $aAttributes, $aInput)
    {
        foreach($aAttributes as $attribute)
        {
            self::filterInput($aInput[$attribute]);
            $model->$attribute = $aInput[$attribute];
        }   
    }
    
    /**
     * Set attributes but ignore some attribute by an array
     * 
     * @param model $model
     * @param array $aIgnoreAttributes
     * @param array $aInput
     * @example  
     *          $model = new Users;
     *          $aAttributes = array('status', 'approved');
     *          $aInput = $_POST['Users'];
     *          InputHelper::ignoreAttributes($model, $aAttributes, $aInput);    
     * 
     *          It will set $model->attributes= $aInput;
     *          But Ignore status, approved attributes
     * 
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 6/6/2013, bb
     */
    public static function ignoreAttributes(&$model, $aIgnoreAttributes, $aInput)
    {
        foreach($aIgnoreAttributes as $ignoreAttribute)
        {
            if(isset($aInput[$ignoreAttribute]))
                unset($aInput[$ignoreAttribute]);
        }        
        
        foreach($aInput as $input)
        {
            self::filterInput($aInput[$input]);
        }
        $model->attributes = $aInput;
    }
    
    /**
     * @todo Need to code this function for security purpose
     * @param unsafe $input string or array of string
     * @return safe input (security)
     * @author bb <unknow@unknow.com>
     */
    public static function filterInput(&$input)
    {
        return $input;
        if(is_array($input))
        {
            foreach($input as $key=>$value){
                $input[$key] = mysql_real_escape_string($value);
            }
        }
        else
            $input = mysql_real_escape_string($input);
            
    }
    
    public static function escape($value)
    {
        return str_replace("'", "", $value);
    }
    
    /**
     * @Author: ANH DUNG Apr 01, 2014
     * @Todo: removeScriptTag
     */
    public static function removeScriptTag($string) {
        $CHtmlPurifier = new CHtmlPurifier();
        $CHtmlPurifier->options = array('HTML.ForbiddenElements' => array('script','style','applet'));
        $string =  $CHtmlPurifier->purify($string);
        $scriptRemove = array("<script>", "</script>", "script",'text/javascript');
        return str_replace($scriptRemove, "", $string);    
    }    
    
	/*
	 * Return img html tag with the specified size. Display holder image if url is empty
	 * 
	 * @author Lam Huynh
	 */
	static public function holderImage($url, $width, $height, $options=array()) {
		$options = array_merge(array('class'=>'img-responsive'), $options);
		return CHtml::image(self::holderUrl($url, $width, $height), 
			'', $options);
	}
	
	/*
	 * Return no image url for specific size if url is empty
	 * 
	 * @author Lam Huynh
	 */
	static public function holderUrl($url, $width, $height) {
		if ($url) return $url;
		
		$noImgSrc = Yii::getPathOfAlias('webroot').'/upload/noimage/noimage-all.jpg';
		$noImg = Yii::getPathOfAlias('webroot')."/upload/noimage/{$width}x{$height}.jpg";
		$noImageUrl = Yii::app()->baseUrl."/upload/noimage/{$width}x{$height}.jpg";
		// resize the placeholder image file
		if (!is_file($noImg)) {
			ImageHelper::resize($noImgSrc, $noImg, $width, $height);
		}
		return $noImageUrl;
	}
	
	/*
	 * Replace last n character in string s with 'x' mark
	 * 
	 * @author Lam Huynh
	 */
	static public function stripoff($s, $n) {
		if (strpos($s, '@')!==false){
			return substr($s, 0, strpos($s, '@')+1).str_repeat('x', $n);
		}
		return substr($s, 0, -$n).str_repeat('x', $n);
	}
	
	/*
	 * Diplay empty mark if value is empty
	 * 
	 * @author Lam Huynh
	 */
	public static function display($value) {
		return $value ?: '<em>Not Available.</em>';
	}
}
