<?php
/**
 * bb
 * Class for handle string
 */


class StringHelper
{
    /**
     * bb
   * TEMP
   * need to code more
   */

    public static function createShort($str, $length)
    {
        if(strlen($str) <= $length) return $str;

        $shortStr = substr($str, 0 , $length - 3);        
        return $shortStr.'...';
    }
    
    public static function createShortEnd($str, $length)
    {
        if(strlen($str) <= $length) return $str;

        $shortStr = substr($str, -$length , $length);        
        return '..'.$shortStr;
    }
    
    /*
     * bb
     * get segment of url by position
     * example:
     * http://code.local/hansproperty/category/commercial
     * 1-> hansproperty
     */
    
    public static function getSegmentOfUrl($position)
    {
        $aSegment = explode('/', str_replace(Yii::app()->baseUrl, '', Yii::app()->request->requestUri));
        if(isset($aSegment[$position]))
            return $aSegment[$position];
        return '';
    }
    
    /**
     * 
     * @param int $id id in table
     * @param char $char
     * @param int $length length of generated string
     * @param string $prefix prefix add to first of generated string
     * @return string
     * 
     * @example  
     *          Input   : genId(789, '0', 6)
     *          Output  : 000789
     * 
     *          Input   : genId(789, '0', 8, 'S-')
     *          Output  : S-000789
     * 
     * 
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 26/6/2013, bb Verz Design
     */
    public static function genId($id, $char = '0', $length = 8, $prefix = '')
    {
        $result = $id;
        $idLength = strlen($id);
        if($idLength < $length)
        {
            $result = $prefix.self::genNumberOfCharacters($char, $length - $idLength).$id;           
        }
        return $result;
    }
    
    /**
     * Add random string before given id
     * 99 -> LKCUA99
     * 
     * @param int $id
     * @param int $length
     * @param string $type: all, alphabet, uppercase, lowercase, number
     * @return string random string end with $id
     * @copyright (c) 9/6/2013, bb 
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function genRandomWithId($id, $length = 8, $type = 'uppercase')
    {
        $result = $id;
        $strLength = strlen($id);
        if($strLength < $length)
            $result = self::getRandomString($length - $strLength, $type).$result;
        return $result;
    }
    
    public function genNumberOfCharacters($char, $length)
    {
        $result = '';
        for($i = 0;  $i< $length; $i ++)
        {
            $result .= $char;
        }
        return $result;
    }
    /*
     * bb
     */
    //additional function, 
    public static function genPhoneFormat($str) //from 0902244581 to 090-224-xxxx
    {
        $aNumbers = str_split($str);
        
        $result = '';
        $index = 0;
        for($i = count($aNumbers) - 1 ; $i >= 0; $i--)
        {
           $index++;
            
           if($index <= 4)
           {
                $result = 'x'.$result; 
                if($index == 4)
                    $result = '-'.$result;
                           
           }else
           {
               $result = $aNumbers[$i].$result;
               if($index == 7)
                  $result = '-'.$result; 
           }
        }
        return $result;
    }
    
    /**
     * 
     * @param int $length
     * @param string $type: all, alphabet, uppercase, lowercase, number
     * @return string random
     * @copyright (c) 9/6/2013, bb
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function getRandomString($length = 8, $type = 'all') 
    {
        if($type == 'all')
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        elseif($type == 'alphabet')
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        elseif($type == 'uppercase')
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        elseif($type == 'lowercase')
            $characters = 'abcdefghijklmnopqrstuvwxyz';
        elseif($type == 'number')
            $characters = '0123456789';
        elseif($type == 'uppercase_number')
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        elseif($type == 'lowercase_number')
            $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

    /**
     * 
     * @param string $string
     * @param int $len
     * @param boolean $bReturnArray
     * @return string OR array
     * @copyright (c) 9/10/2013, bb
     */
    public static function limitStringLength($string, $len = 500, $bReturnArray = false)
    {
        $aResult = array(
			'sContent'=>$string,
			'bShowMore'=>false
		);
		
		$parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
		$parts_count = count($parts);

		$length = 0;
		$last_part = 0;
		for (; $last_part < $parts_count; ++$last_part) {
			$length += strlen($parts[$last_part]);
			if ($length > $len)
				break;
		}

		$result = implode(array_slice($parts, 0, $last_part));
		if (strlen($result) < strlen($string)) {
			$result .= '...';
            $aResult['sContent'] = $result;
            $aResult['bShowMore'] = true;
		}

        if($bReturnArray)
            return $aResult;
        return $result;
    }
}
