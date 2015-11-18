<?php
class MyFunctionCustom extends CActiveRecord
{
    public static function EventCalender($events='',$date='') {
        //This puts the day, month, and year in seperate variables
        if(empty($date))
            $date = date('Y-m-d');

        //$day = date('d', strtotime($date)) ;
        $month = date('m', strtotime($date)) ;
        $year = date('Y', strtotime($date)) ;

        //Here we generate the first day of the month
        $first_day = mktime(0,0,0,$month, 1, $year) ;

        //This gets us the month name
        $title = date('F', $first_day) ;

        //Here we find out what day of the week the first day of the month falls on
        $day_of_week = date('D', $first_day) ;

        //Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero

        switch($day_of_week){
            case "Sun": $blank = 0; break;
            case "Mon": $blank = 1; break;
            case "Tue": $blank = 2; break;
            case "Wed": $blank = 3; break;
            case "Thu": $blank = 4; break;
            case "Fri": $blank = 5; break;
            case "Sat": $blank = 6; break;
        }

        //We then determine how many days are in the current month
        $days_in_month = cal_days_in_month(0, $month, $year) ;
        $calender = '';

        //Here we start building the table heads
        $calender.= '<table>';
        $calender.= '<thead>
                            <tr>
                                <th class="first">Sun</th>
                        	<th>Mon</th>
                            	<th>Tues</th>
                            	<th>Wed</th>
                            	<th>Thu</th>
                            	<th>Fri</th>
                            	<th>Sat</th>
                            </tr>
                   </thead><tbody>';

        //This counts the days in the week, up to 7
        $day_count = 1;

        $calender.= "<tr>";

        //first we take care of those blank days
        while ( $blank > 0 )
        {
            $calender.= "<td><div class='date'></div>
                         <div class='content'></div></td>";
            $blank = $blank-1;
            $day_count++;
        }

        //sets the first day of the month to 1
        $day_num = 1;

        //count up the days, untill we've done all of them in the month
        while ( $day_num <= $days_in_month )
        {
            if(empty($events)){
                $status_of_calender= "<td><div class='date'>".$day_num."</div>
                                        <div class='content'></div></td>";
            }else{
                $status_of_calender= "";
                $FlgEvent = false;
                $list_name_events=array();
                foreach($events as $event) {
                    $day_of_event = date('d',strtotime($event['datetime_from']));
                    if ($day_of_event == $day_num){
                        $status_of_slot = $event->viewStatusOfSlot();
                        if($status_of_slot == 'Session Full'){
                            $list_name_events[$event['slug']] = $event['name'];
                            $FlgEvent = true;
                            //break;
                        }
                        elseif ($status_of_slot == 'Session Almost Full'){
                           $list_name_events[$event['slug']] = $event['name'];
                            $FlgEvent = true;
                            //break;
                        }
                        else {                          
                           $list_name_events[$event['slug']] = $event['name'];
                            $FlgEvent = true;
                           // break;
                        }

                    }
                }
                if($FlgEvent == false){
                    $status_of_calender .= "<td>
                                              <div class='date'>".$day_num."</div>
                                               <div class='content'></div>
                                            </td>";
                }else{
                    $str="<ul>";
                    foreach ($list_name_events as $k=>$v){
                          $str.="<li><a href='".Yii::app()->createAbsoluteUrl('site/register_event/'. $k)."' target='_blank'>" . $v . "</a></li>";
                    }
                    $str.="</ul>";
                    $status_of_calender .= "<td>
                                                  <div class='date'>".$day_num."</div>
                                                  <div class='content'>".$str."</div>
                                            </td>";
                }
            }

            $calender.= $status_of_calender;

            $day_num++;
            $day_count++;

            //Make sure we start a new row every week
            if ($day_count > 7)
            {
                $calender.= "</tr><tr>";
                $day_count = 1;
            }
        }

        //Finaly we finish out the table with some blank details if needed
        while ( $day_count >1 && $day_count <=7 )
        {
            $calender.= "<td><div class='date'></div>
                         <div class='content'></div></td>";
            $day_count++;
        }
        $calender.= "</tr></tbody></table>";
        echo $calender;
    }


    /**
     * trims text to a space then adds ellipses if desired
     * @param string $input text to trim
     * @param int $length in characters to trim to
     * @param bool $ellipses if ellipses (...) are to be added
     * @param bool $strip_html if html tags are to be stripped
     * @return string
     */
    public function trim_text($input, $length, $ellipses = true, $strip_html = true) {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...more';
        }

        return $trimmed_text;
    }

	/**
	 * Returns auto generate max id: ID0001.
	 * @param:$className: Users
	 * @param:$prefix_code: ID
	 * @param:$length_max_id: int: 6
	 * @param:$fieldName: name of field generate max id in database: ex: customer_id, user_no....
         * @how to do: $model->user_no = MyFunctionCustom::getNextId('Users','ID',6,'user_no');
	 */  		
    public static function getNextId($className,$prefix_code, $length_max_id, $fieldName){
        $prefix_code_length = strlen($prefix_code);
        $criteria = new CDbCriteria;
        $criteria->select='MAX(CONVERT(SUBSTR(t.'.$fieldName.','.($prefix_code_length+1).'),SIGNED)) as MAX_ID';
        $model_ = call_user_func(array($className, 'model'));
        $model = $model_->find($criteria);
        $max_id =  (null == $model->MAX_ID) ? 0 : $model->MAX_ID;
        $max_id++;
        $addition_zero_num 	= $length_max_id - strlen($max_id) - strlen($prefix_code);
        $code = $prefix_code;
        for($i=1;$i<=$addition_zero_num;$i++)
            $code.='0';
        $code.= $max_id;
        
        return $code;
    }
		
	/*
     * to make slug (url string)
     */
    public static function slugify($text)
    { 
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

      // trim
      $text = trim($text, '-');

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // lowercase
      $text = strtolower($text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      if (empty($text))
      {
        return 'n-a';
      }

      return $text;
    }    
        
	/** Nguyen Dung
	* To do: delete  all file in folder
	* @param: $path = '/upload/admin/artist/thumb';
	*/
    public static function delteAllFileInFolder($path)
    {
        $path = Yii::getPathOfAlias('webroot').$path;
        $files = glob($path.'/*'); // get all file names
        foreach($files as $file){ // iterate files
          if(is_file($file))
            unlink($file); // delete file
        }
    }

    /*
     * Nguyen Dung
     * to do: download file of model
     * @param: $model
     * @param: $name_field: whitepaper
     * @param: $folder: whitepaper
     */
    public static function forceDownload($model,$name_field, $folder)
    {
        try {
            $className = get_class($model);
             if($className == 'PrecProductFamily')
             {
                if(empty($model->$name_field))
                    throw new Exception("Invalid request. No $name_field found.");
                $fileName = $model->$name_field;
                $checkSpace = explode(' ', $model->$name_field);
                if(count($checkSpace)>1)
                    $fileName = rawurlencode ($fileName);
                 $src = "upload/products/".$model->id."/$folder/".$fileName;
             }
             elseif($className == 'PrecWhitepaper')
             {
                if(empty($model->$name_field))
                    throw new Exception("Invalid request. No $name_field found.");
                $fileName = $model->$name_field;
                $checkSpace = explode(' ', $model->$name_field);
                if(count($checkSpace)>1)
                    $fileName = rawurlencode ($fileName);                
                 $src = "upload/$folder/".$model->id."/".$fileName;
                 
             }
             elseif($className == 'PrecPromotion')
             {
                if(empty($model->$name_field))
                    throw new Exception("Invalid request. No $name_field found.");
                $fileName = $model->$name_field;
                $checkSpace = explode(' ', $model->$name_field);
                if(count($checkSpace)>1)
                    $fileName = rawurlencode ($fileName);                
                 $src = "upload/promotion/$folder/".$model->id."/".$fileName;
                 
             }
             else
                 throw new Exception('Invalid request.');             
             
            $fileHelper = new FileHelper();
            $fileHelper->forceDownload($src);  
            
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());;
        }

    }
    
    /*
     * to do: kiểm tra xem size của hình up lên có nhỏ hơn kích thước nào đó ko
     * @return: true: nếu width hoặc height của hình nhỏ hơn kích thước so sánh
     *          false: nếu width và height của hình lớn hơn
     */
    public static function bannerIsSmall($pathImage, $widthCompare, $heightCompare){
        list($width, $height, $type, $attr)=getimagesize($pathImage);
        if($width<$widthCompare || $height<$heightCompare)
            return true;
        return false;        
    }		
    
    /* NGUYEN DUNG - 10-16-2013
     * to Truncate a string in PHP to the word closest to a certain number of characters?
     * http://stackoverflow.com/questions/79960/how-to-truncate-a-string-in-php-to-the-word-closest-to-a-certain-number-of-chara
     * @param: $string
     * @param: $your_desired_width
     * return short string
     */
    public static function ShortenString($string, $your_desired_width){
        $string = strip_tags($string);
        if(strlen($string)<$your_desired_width) 
            return $string;
        $res =  preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $your_desired_width));
       return $res.'...';
    }
    
    public static function getSchoolLevel(){
        $str = Yii::app()->params['school_level'];
        $array = explode(',', $str);
        $result = array();
        foreach ($array as $item){
            $result[$item] = $item;
        }
        return $result;
    }
    public static function getProgrammeTitle(){
        $str = Yii::app()->params['programme_title'];
          $array = explode(',', $str);
        $result = array();
        foreach ($array as $item){
            $result[$item] = $item;
        }
        return $result;
    }
    public static function getPaymentMode(){
        $str = Yii::app()->params['payment_mode'];
          $array = explode(',', $str);
         $result = array();
        foreach ($array as $item){
            $result[$item] = $item;
        }
        return $result;
    }
            
    public static function sendmailpayment($model, $list_product) {
		
		$billing_address = json_decode($model->billing_address, true);
		$shipping_address = json_decode($model->shipping_address, true);
		
		$param = array(
			'{NAME}' => $model->user->name,
			'{ORDER_NO}' => $model->order_no,
			'{CREATED_DATE}' => date('Y-m-d H:i:s', strtotime($model->created_date)),
			'{BILLING_NAME}' => $billing_address['first_name'].' '.$billing_address['last_name'],
			'{BILLING_EMAIL}' => $billing_address['email'],
			'{BILLING_NUMBER}' => $billing_address['contact_number'],
			'{BILLING_ADDRESS}' => $billing_address['address'],
			'{BILLING_COUNTRY}' => AreaCode::model()->findByPk($billing_address['country_id'])->area_name,
			'{BILLING_POSTCODE}' => $billing_address['postal_code'],
			'{SHIPPING_NAME}' => $shipping_address['first_name'].' '.$shipping_address['last_name'],
			'{SHIPPING_EMAIL}' => $shipping_address['email'],
			'{SHIPPING_NUMBER}' => $shipping_address['contact_number'],
			'{SHIPPING_ADDRESS}' => $shipping_address['address'],
			'{SHIPPING_COUNTRY}' => AreaCode::model()->findByPk($shipping_address['country_id'])->area_name,
			'{SHIPPING_POSTCODE}' => $shipping_address['postal_code'],
			'{PRODUCT_LIST}' => $list_product,
		);
        EmailHelper::bindEmailContent(EMAIL_CONFIRM_PAYMENT_PRODUCT, $param, $model->user->email);
	}

    /**
     * @param $model
     * @return bool
     * <Jason>
     * <pmhai90@gmail.com>
     */
    public static function logout(){
        Yii::app()->user->logout();
        if (isset($_COOKIE[VERZ_COOKIE_MEMBER])) {
            setcookie(VERZ_COOKIE_MEMBER, "", time() - 7*24*60*60);
            setcookie(VERZ_COOKIE_MEMBER, "", time() - 7*24*60*60, '/');
        }

        Yii::app()->session->destroy();
        Yii::app()->request->cookies->clear();
    }

    /**
     * @param $model
     * @return bool
     * <Jason>
     * <pmhai90@gmail.com>
     */
    public static function saveUserRegister($model){
        if(isset($_POST['Users'])){

            $model->attributes = $_POST['Users'];
            $model->validate(array('email','title','first_name',
                'last_name','phone','area_code_id','password_hash','password_confirm',
            ));
//            $model->validate();
            // if ok validate then do something
            if(!$model->hasErrors()){
                $model->email = ActiveRecord::clearHtml($model->email);
                //$model->email_temp = ActiveRecord::clearHtml($model->email);
                $model->title = ActiveRecord::clearHtml($model->title);
                $arr_email = explode('@', $model->email);
                $model->username = $arr_email[0];
                $model->first_name = ActiveRecord::clearHtml($model->first_name);
                $model->last_name = ActiveRecord::clearHtml($model->last_name);
                $model->phone = ActiveRecord::clearHtml($model->phone);
                $model->area_code_id = ActiveRecord::clearHtml($model->area_code_id);
//                if(MyFunctionCustom::checkCountryFilter()) {
//                    $model->status=STATUS_PENDING_USER;
//                } else {
//                    $model->status=STATUS_BLOCK_IP;
//                }
                $model->created_date=date('Y-m-d H:i:s');
                $model->last_logged_in=date('Y-m-d H:i:s');
                $model->role_id=ROLE_REGISTER_MEMBER;
                $model->application_id = FE;

                $model->login_attemp = 0;
                //$model->verify_code = ActiveRecord::generateVerifyCode();
                $model->temp_password =  $_POST['Users']['password_hash'];
                $model->scenario = NULL;

                $model->save();
                $model->password_hash =  md5($_POST['Users']['password_hash']);
                $model->verify_code = sha1(mt_rand(10000, 99999).time().$model->email);

                $model->update(array('password_hash', 'verify_code'));
                MyFunctionCustom::sendMailAfterRegister($model);

                if($model->is_subscriber){
                    Subscriber::saveSubscriberUser($model->id);
                }

                //Added subcriber
                return true;
            }

        }
        return false;
    }

    /**
     * @param $model
     * @return bool
     * <Jason>
     * <pmhai90@gmail.com>
     */
    public static function sendMailAfterRegister($model){
        $url_login = Yii::app()->createAbsoluteUrl('site/login', array('role'=>ROLE_REGISTER_MEMBER, 'verify_code'=>$model->verify_code));
        $url_login = "<a href='$url_login' target='_blank'>$url_login</a>";

        $aBody = array(
            '{EMAIL}'=>$model->email,
            '{FULL_NAME}'=>$model->title. ' '.$model->first_name.' '.$model->last_name,
            '{PASSWORD}'=>$model->temp_password,
            '{LINK}'=> $url_login,
        );

        if(CmsEmail::sendmail(MAIL_AFTER_REGISTER, array(), $aBody, $model->email)){
            // Send a email to admin
            return true;
        }
        else
            $model->addError('email', 'Can not send email');
    }
    
    /**
     * @Author: ANH DUNG May 06, 2014
     * @Todo: get url page view detail listing at FE
     * @Param: $listing_id
     * @Return: string url dạng Yii::app()->createAbsoluteUrl('/')
     * MyFunctionCustom::getUrlListing($listing_id);
     */
    public static function getUrlListing($listing_id){
        $model = Listing::model()->findByPk($listing_id);
        if($model) {
            return Yii::app()->createAbsoluteUrl('site/listingdetail',array('slug'=>$model->slug));
        }
        return "";
    }


    public static function convertData($value,$type,$value2=null){
        $total=0;
        if(is_numeric($value)){
           if($type=='sqft') $total = round(($value/10.76391),0);
           if($type=='sqm')  $total = round(($value*10.76391),0);
           if($type=='sqf')  if($value>0 && $value2>0 ) $total = round(($value/$value2),2) ;
        }
        return $total;
    }

    public static function showTitlePropertyOrBuilding($title,$type='building'){
        $arrTile = explode('--', $title);
        if($type=='building' && count($arrTile)==2){
            return $arrTile[0];
        }
        if($type=='title' && count($arrTile)==2){
            return $arrTile[1];
        }
        return $title;
    }

}
?>