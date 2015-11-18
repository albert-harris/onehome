<?php
class Api{
    
    public static function wrapcontent($url, $datatopost, $header) {
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL,           $url);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($soap_do, CURLOPT_POST,           true );
        curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $datatopost);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header );

        $output = curl_exec($soap_do);
//        $aInfo = curl_getinfo($soap_do);
        curl_close($soap_do);
        return $output;
    }
    
    //MindEgde
    public static function getLicensedUserID()
    {
        $datatopost ='<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
              <soap:Body>
                <CreateUser xmlns="http://tempuri.org/" />
              </soap:Body>
            </soap:Envelope>';
        
        $header = array(
                "Content-Type: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
               "SOAPAction: \"http://tempuri.org/CreateUser\"",
                "Content-length: ".strlen($datatopost),
        );
        
        $xml = self::wrapcontent('http://mindedge.briantracy.com/LicensedUser/LicensedUsers.asmx', $datatopost, $header);
        $oParser = new XmlToArrayParser($xml);
        $aResult = $oParser->array;
        $aCreateUserResult = $aResult['soap:Envelope']['soap:Body']['CreateUserResponse']['CreateUserResult'];
        if($aCreateUserResult['Status'] == 'Success')
            return $aCreateUserResult['LicensedUserID'];
        else
            return false;
    }
    
    //MindEgde
    public static function getVideoLink($video_id, $LicensedUserID)
    {
        $datatopost ='<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <AuthorizeLesson xmlns="http://tempuri.org/">
              <LicensedUserAuth>
                <LicensedUserID>'.$LicensedUserID.'</LicensedUserID>
                <LessonID>'.$video_id.'</LessonID>
              </LicensedUserAuth>
            </AuthorizeLesson>
          </soap:Body>
        </soap:Envelope>';
        
        $header = array(
                "Content-Type: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
               "SOAPAction: \"http://tempuri.org/AuthorizeLesson\"",
                "Content-length: ".strlen($datatopost),
        );
        
        $xml = self::wrapcontent('http://mindedge.briantracy.com/LicensedUser/LicensedUsers.asmx', $datatopost, $header);
        $oParser = new XmlToArrayParser($xml);
        $aResult = $oParser->array;
        $aAuthorizeLessonResponse = $aResult['soap:Envelope']['soap:Body']['AuthorizeLessonResponse']['AuthorizeLessonResult'];
        if($aAuthorizeLessonResponse['Status'] == 'Success')
        {
            return 'http://mindedge.briantracy.com/LicensedUser/lesson.aspx?LessonID='.$video_id.'&AuthorizationCode='.$aAuthorizeLessonResponse['AuthorizationCode'];             
        }
        else
            return false;
    }
    
}

