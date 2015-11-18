<?php
/**
 * 
 * @todo Class for handle string
 * @author bb
 */


class DateHelper
{
    
    public static function getDayOfWeekArray()
    {
        return array('Mon'=>'Mon',
                    'Tue'=>'Tue',
                    'Wed'=>'Wed',
                    'Thu'=>'Thu',
                    'Fri'=>'Fri',
                    'Sat'=>'Sat',
                    'Sun'=>'Sun',
            );
    }
    
    public static function getDayOfMonthArray()
    {
        $aResult = array();
        for($i = 1; $i<=31; $i++){
            $aResult[$i] = $i;
        }
        return $aResult;
    }
    
    
    /**
     * 
     * @param type $string
     * @return dd/mm/Y -> Y-m-d
     * @author bb
     */
    public static function toDbDateFormat($string)
    {        
        $aDate = explode('/', $string);
        if(count($aDate) == 3)
            return $aDate[2].'-'.$aDate[1].'-'.$aDate[0];
        else return NULL;
    }
    
    /**
     * @param type $string: 25-09-2014
     * @return -> Y-m-d
     * @author bb
     */
    public static function toDbDateFormat_tuan($string)
    {        
        $aDate = explode('-', $string);
        if(count($aDate) == 3)
            return $aDate[2].'-'.$aDate[1].'-'.$aDate[0];
        else return NULL;
    }
        
    /**
     * 
     * @param type $string
     * @return dd/mm/Y H:i -> Y-m-d H:i:s
     * @author bb
     */
    public static function toDbDateTimeFormat($string)
    {     
        $aString = explode(' ', $string);
        $aDate = explode('/', $aString[0]);
            $sDate = $aDate[2].'-'.$aDate[1].'-'.$aDate[0];
        return $sDate.' '. $aString[1].':00';
        
    }
    /**
     * 
     * @param type $string
     * @return Y-m-d H:i:s -> d/m/Y
     * @author Jason
     */
    public static function toDateFormat($string)
    {
        if ($string == '0000-00-00' || $string == '0000-00-00 00:00:00' || is_null($string))
            return '';
        else{
            $aString = explode('-', $string);
            $sDate = $aString[2].'/'.$aString[1].'/'.$aString[0];
            return $sDate;
        }
    }
    
   
    /**
     * 
     * @param type $string
     * @return Y-m-d H:i:s -> dd/mm/Y H:i
     * @author bb
     */
    public static function toDateTimePickerFormat($string)
    {     
        $aString = explode(' ', $string);
        $aDate = explode('-', $aString[0]);
            $sDate = $aDate[2].'/'.$aDate[1].'/'.$aDate[0];
            
        $aTime = explode(':', $aString[1]);
        $sTime = $aTime[0].':'. $aTime[1];
        return $sDate.' '. $sTime;
        
    }
    /**
     * @param type $string
     * @return Y-m-d -> Y-m-d
     */
    public static function toDatePickerFormat($dateInDatabase)
    {     
        return date('d/m/Y', strtotime($dateInDatabase));
    }
   
    /**
     * 
     * @param type $timestamp1
     * @param type $timestamp2
     * @param type $operator: ==, <=, >=, ..
     * @return int
     * @author bb
     */
    public static function compareDate($timestamp1, $timestamp2, $operator = '==')
    {   
        if(version_compare(strtotime(date('Y-m-d',$timestamp1)) -  strtotime(date('Y-m-d',$timestamp2)), 0,$operator))
            return 1;
        return 0;
    }
   
    /**
     * 
     * @param type $timestamp1: start date
     * @param type $timestamp2: end date
     * @param type $aDayOfWeek: array of Sun, Sat...
     * @return array "Y-m-d"
     * @author bb
     */
    public static function getDateByDayOfWeekInDateSpan($timestamp1, $timestamp2, $aDayOfWeek)
    {   
        $result = array();
        $resultFirstWeek = array();
        
        //find date in first weeek
        for($i = 0; $i<7; $i++)
        {
            
            $currentLoopDate = date ( 'Y-m-d', strtotime("+$i days",$timestamp1));
            $currentLoopDayOfWeek = date('D',  strtotime($currentLoopDate));
            
            if(strtotime(date('Y-m-d',  $timestamp2)) - strtotime($currentLoopDate) < 0)
                return $resultFirstWeek;
            
            if(in_array($currentLoopDayOfWeek, $aDayOfWeek))
            {
               $resultFirstWeek[] = $currentLoopDate;
            }
        }
        
        //find date in date span
        foreach($resultFirstWeek as $itemFirstWeek)//each Sun, Mon.. format(Y-m-d)
        {
            $i = 0;
            while (1)
            {
                
                $currentLoopDate = date ( 'Y-m-d', strtotime("+$i week",  strtotime($itemFirstWeek)));
                if(strtotime($currentLoopDate) - strtotime(date('Y-m-d',$timestamp2)) <= 0)
                {
                   $result[] = $currentLoopDate; 
                   $i ++;
                }else
                {                    
                    break;
                    $i = 0;
                }
            }
        }
        return $result;        
    }
    
    /**
     * 
     * @param type $timestamp1: start date
     * @param type $timestamp2: end date
     * @param type $aDayOfMonth: array of 1,2,31...
     * @return array "Y-m-d"
     * @author bb
     */
    public static function getDateByDayOfMonthInDateSpan($timestamp1, $timestamp2, $aDayOfMonth)
    {   
        $result = array();
        $iMonthSpan = self::getTimeSpan($timestamp1, $timestamp2, 'month');
        
        for($i = 0; $i <= $iMonthSpan; $i ++)
        {            
            foreach($aDayOfMonth as $dayOfMonth)
            {
                if(strlen($dayOfMonth) == 1)
                    $dayOfMonth = '0'.$dayOfMonth;
                                
                $startDateOfMonth  = date('Y-m', $timestamp1).'-01';                
                $currentLoopStartDate = date ( 'Y-m-d', strtotime("+$i month",  strtotime($startDateOfMonth)));                
                
                if(checkdate(date('m',  strtotime($currentLoopStartDate)), $dayOfMonth, date('Y',  strtotime($currentLoopStartDate)))) 
                {
                    $resultDate = date('Y',  strtotime($currentLoopStartDate)).'-'.date('m',  strtotime($currentLoopStartDate)).'-'.$dayOfMonth; 
                    if(strtotime($resultDate) - $timestamp1 >= 0)
                        $result[] = $resultDate;               
                }
            }
        }
        return $result;        
    }
    /**
     * 
     * @param timestamp $timestampStart
     * @param timestamp $timestampEnd
     * @param text $type: year, month, week, day...
     * @return int
     * @author bb
     */
    
    public static function getTimeSpan($timestampStart, $timestampEnd, $type = 'day')
    {
        $time = $timestampEnd - $timestampStart;
        $aType = array('decade' => 315576000,
                    'year' => 31557600,
                    'month' => 2629800,//===
                    'week' => 604800,
                    'day' => 86400,
                    'hour' => 3600,
                    'min' => 60,
                    'sec' => 1);
        return floor($time/$aType[$type]); 
    }
    
    /**
     * @todo Get date of next month by the given date. If no exist date in next month, it will return the last date of next month.
     * @param timestamp $date
     * @param string $count: number of month from the given date. Default is next month (1)
     * @author bb
     */
    public static function getDateOfNextMonthByDate($date, $count = '+1')
    {
        $startDateOfGivenMonth  = date('Y-m', $date).'-01';   
        $startDateOfNextMonth = date('Y-m-d', strtotime("$count month",strtotime($startDateOfGivenMonth)));

        if(!checkdate(date('m',  strtotime($startDateOfNextMonth)), date('d', $date), date('Y',  strtotime($startDateOfNextMonth)))) 
        {
            return date('Y-m-t', strtotime($startDateOfNextMonth));
        } 
        
        return date('Y-m', strtotime($startDateOfNextMonth)).'-'.date('d',$date);        
    }
   
    /**
     * 
     * @param string $data : 23/2/2013
     * @param type $formatDate
     * @return boolean
     * @author bb
     */
    public static function isValidDate($data, $formatDate = 'dd/mm/yyyy')
    {
        $data = trim($data);
        if($data == '')
            return false;
        
       
//          $patternDate = '/^(\d){2}(\/){1}(\d){2}(\/){1}(\d){4}$/';
//          $patternDate = '/([0-9]{1})\/([0-9]{1})\/([0-9]{4})/';
        $patternDate = '/^\d{1,2}\/\d{1,2}\/\d{4}/';

        if(!preg_match($patternDate,trim($data),$matches))
        {            
            return false;
        }
        else
        {
            $aData = explode('/', $data);
            if(!checkdate((int)$aData[1], (int)$aData[0], $aData[2]))
                return false;
        }
       
        return true;
    }
}
