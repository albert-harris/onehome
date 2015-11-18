<?php
class SFSignature{
    /**
     * 
     * @param type $aData: array of username, password, currenttime
     * @param type $password
     * @return type
     */
    public static function genSignature($username, $password)
    {    
        date_default_timezone_set('Asia/Singapore');  
        $aData['username'] = $username;
//        $aData['password'] = $password;
        $aData['ctime'] = strtotime(date('Y-m-d H:i:s'));
        $password_hash = md5($password);
        $signature = self::getSignature($aData, $password_hash);
        
        return '&username='.$username.'&password='.$password_hash.'&ctime='.$aData['ctime'].'&signature='.$signature;
    }
    
    public static function getSignature($aData, $password)
    {
        return hash_hmac('sha1', json_encode($aData), $password);
    }
    
}
?>
