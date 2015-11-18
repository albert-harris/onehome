<?php

class ActiveRecord extends CActiveRecord {

    public function getAjaxAction() {
        return array();
    }

    public static function getValueOrder($limit = 50) {
        $number = array();
        for ($i = 1; $i <= $limit; $i++) {
            $number[$i] = $i;
        }
        return $number;
    }

    public static function getText($content = NULL, $number = NULL) {
        $result = (strlen($content) > $number) ? substr($content, 0, $number) . '...' : $content;
        return $result;
    }

    public static function getTiles($hasEmpty = true) {
        if ($hasEmpty)
            $data = array('' => '', 'Mr' => 'Mr.', 'Mrs' => 'Mrs.', 'Ms' => 'Ms.', 'Madam' => 'Madam', 'Dr' => 'Dr.');
        else
            $data = array('Mr' => 'Mr.', 'Mrs' => 'Mrs.', 'Ms' => 'Ms.', 'Madam' => 'Madam', 'Dr' => 'Dr.');
        return $data;
    }

    public static function getAlphabet() {
        $data = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        return $data;
    }

    public static function getUserStatus($hasEmpty = false) {
        if ($hasEmpty)
            return array('' => '', '1' => 'Active', '0' => 'Inactive');
        return array('1' => 'Active',
            '0' => 'Inactive');
    }

    public static function getYesNo($emptyOption = false) {
        if ($emptyOption)
            return array('' => '',
                '1' => 'Yes',
                '0' => 'No');
        else
            return array('1' => 'Yes',
                '0' => 'No');
    }

    public static function getUserZone() {
        return array("North" => "North", "South" => "South", "East" => "East", "West" => "West");
    }

    public static function getGenders($hasEmpty = true) {
        if ($hasEmpty)
            $data = array('' => '', 'MALE' => 'Male', 'FEMALE' => 'Female');
        else
            $data = array('MALE' => 'Male', 'FEMALE' => 'Female');
        return $data;
    }

    public static function getMonths() {
        $result = array();
        for ($i = Yii::app()->params['minMonth']; $i <= Yii::app()->params['maxMonth']; ++$i) {
            $result[$i] = $i . ' Months';
        }
        return $result;
    }

    public static function getPaypalUrl() {
        return Yii::app()->params['paypalURL'];
        //        return Yii::app()->params['is_paypal_sandbox'] ? Yii::app()->params['paypalURL_sandbox'] : Yii::app()->params['paypalURL'];
    }

    public static function timeCalMinutes($m, $datetime = null) {
        if ($datetime === null)
            return date('Y-m-d H:i:s', time() + ($m * 60));
        else
            return date('Y-m-d H:i:s', strtotime($datetime) + ($m * 60));
    }

    public static function getRewriteUrl($strTitle) {
        $result = '';
        if (empty($strTitle)) {
            $result = '';
            return $result;
        } else {
            $result = preg_replace('/\%/', ' percentage', $strTitle);
            $result = preg_replace('/\@/', ' at ', $result);
            $result = preg_replace('/\&/', ' and ', $result);
            $result = preg_replace('/\+/', ' plus ', $result);
            $result = preg_replace('/\s\s+/', ' ', trim($result));  //Strip off multiple spaces between the sentence, making it like "Hello Ms Van"
            $result = preg_replace('%(#|;|{}=(//)).*%', '', $result);
            $result = preg_replace('%/\*(?:(?!\*/).)*\*/%s', '', $result); // google for negative lookahead
            $result = preg_replace('/[\s\W]+/', '-', $result);    // Strip off spaces and non-alpha-numeric
            $result = preg_replace('/^[\-]+/', '', $result); // Strip off the starting hyphens
            $result = preg_replace('/[\-]+$/', '', $result); // // Strip off the ending hyphens
            $result = strtolower($result);

            return $result;
        }
    }

    public static function replaceInputValue($strInput) {
        $result = '';
        if (empty($strInput)) {
            $result = '';
            return $result;
        } else {
            $badWords = array("/delete/", "/update/", "/union/", "/insert/", "/drop/", "/http/", "/--/");
            $result = preg_replace($badWords, "", $strInput);
            $result = addslashes($result);
            $result = preg_replace('/\s\s+/', ' ', trim($result));  //Strip off multiple spaces between the sentence, making it like "Hello Ms Van"
            $result = preg_replace('%(#|;|{}=(//)).*%', '', $result);
            $result = preg_replace('%/\*(?:(?!\*/).)*\*/%s', '', $result); // google for negative lookahead
            $result = preg_replace('/^[\-]+/', '', $result); // Strip off the starting hyphens
            $result = preg_replace('/[\-]+$/', '', $result); // // Strip off the ending hyphens
            $result = strtolower($result);

            return $result;
        }
    }

    public static function getMonth() {
        $data = array('1' => 'January', '2' => 'Febuary', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
        return $data;
    }

    public static function getDay() {
        for ($i = 1; $i <= 31; $i++) {
            $data[$i] = $i;
        }
        return $data;
    }

    public static function getHours() {
        $data = array();
        for ($i = 7; i <= 17; $i++) {
            $hourText = $i;
            if ($i < 10)
                $hourText = '0' . $i;
            $data[] = array($i => $hourText);
        }
        return $data;
    }

    public static function getYear() {
        $cur_year = date('Y');
        for ($i = $cur_year; $i < $cur_year + 4; $i++) {
            $data[$i] = $i;
        }
        return $data;
    }

    public static function getBirthYear() {
        $cur_year = date('Y');
        for ($i = $cur_year; $i > $cur_year - 43; $i--) {
            $data[$i] = $i;
        }
        return $data;
    }

    public static function getHour() {
        for ($i = 7; $i <= 17; $i++) {
            if ($i < 10) {
                $data[$i] = '0' . $i;
            }
            else
                $data[$i] = $i;
        }
        return $data;
    }

    public static function getMinute() {
        for ($i = 5; $i <= 55; $i+=5) {
            if ($i < 10) {
                $data[$i] = '0' . $i;
            }
            else
                $data[$i] = $i;
        }
        return $data;
    }

    public static function formatDate($dates) {
        if ($dates == "") {
            return $dates;
        } else {
            $date_arr = explode('/', $dates);
            $dates = $date_arr[2] . '-' . $date_arr[1] . '-' . $date_arr[0];
            return $dates;
        }
    }

    public static function countDate($date1, $date2) {
        if ($date1 < $date2) {
            $dates_range[] = $date1;
            $date1 = strtotime($date1);
            $date2 = strtotime($date2);
            $count = 0;
            while ($date1 != $date2) {
                $date1 = mktime(0, 0, 0, date("m", $date1), date("d", $date1) + 1, date("Y", $date1));
                $dates_range[] = date('Y-m-d', $date1);
                $count++;
            }
            return $count;
        }
    }

    public static function testLeapYear($year) {
        $ret = (($year % 400 == 0) || ($year % 4 == 0 && $year % 100 != 0)) ? true : false;
        return $ret;
    }

    public static function checkEnddate($date, $month) {
        if ($month == 2 && $date == 29) {
            return true;
        } elseif ($month == 2 && $date == 28) {
            return true;
        } elseif ($month % 2 != 0 && $date == 31) {
            return true;
        } elseif ($month % 2 == 0 && $month != 2 && $date == 30) {
            return true;
        }
        return false;
    }

    public static function formatCurrency($price) {
        return Yii::app()->numberFormatter->formatCurrency($price, '$');
    }

    // Show image in Detail view
    public function detailImageColumn($data) {
        $image = '/upload/member/photos/' . $data;
        return CHtml::image(Yii::app()->baseUrl . $image, $data, array('width' => '100px'));
    }

//       public static function gridImageColumn($data,$row){
//            $image = '/upload/member/photos/'.$data->thumb_image;
//            return CHtml::image(Yii::app()->baseUrl . $image,$data->thumb_image,array('width'=>'100px'));  
//       }

    public static function getMaxLengthPassword() {
        return 30;
    }

    public static function getDefaultAreaCode() {
        return 229;
    }

    public static function getSlugTermsOfUse() {
        return 'terms-of-use';
    }

    public static function getSlugPrivacyPolicy() {
        return 'privacy-policy';
    }

    public static function getSlugContact() {
        return 'contact-us';
    }

    public static function getCities() {
        $cities = Cities::model()->findAll();
        $array[''] = '-- Select city --';
        foreach ($cities as $city) {
            $array[$city->id] = $city->city_name;
        }
        return CHtml::dropDownList('Users[city_id]', 'city_id', $array, $htmlOptions = array('class' => 'type-1'));
    }

    public static function getCity() {
        $cities = Cities::model()->findAll();
        foreach ($cities as $city) {
            $array[$city->id] = $city->city_name;
        }
        return $array;
    }

    public static function countPhoneNumber($id, $area_code_id, $phone) {
        if (is_null($id))
            return Users::model()->count('phone=' . (int) $phone . ' AND area_code_id=' . (int) $area_code_id . '');
        else {
            $model = Users::model()->findAll('phone=' . (int) $phone . ' AND area_code_id=' . (int) $area_code_id . '');
            if (count($model) < 1 || is_null($model))
                return 0;
            else if (count($model) > 1)
                return 1;
            else if (count($model) == 1) {
                if ($model[0]->id == $id)
                    return 0;
                else
                    return 1;
            }
        }
    }

    // Create Photo Thumb name
    public function setThumbName($filename, $size) {
        return $size . '_' . $filename;
    }

    public static function getDateFormatJquery() {
        return "dd/mm/yy";
    }
    
    public static function getDateFormatSearch() {
        return "dd-mm-yy";
    }

    public static function getDateFormatPhp() {
        return "d/m/Y";
    }

    public static function getPlaceHoldersTop() {
        return 17;
    }

    public static function getPlaceHoldersRight() {
        return 18;
    }

    public static function getPlaceHoldersBottom() {
        return 19;
    }

    public static function getPlaceHoldersLeft() {
        return 20;
    }

    public static function getMaxFileSize() {
        return 10 * 1024 * 1000;
    }

    public static function getMaxFileSizeImage() {
        return 3 * 1024 * 1000;
    }

    public static function randString($length = 6, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }
        return $str;
    }

    public static function geocode($portal_code) {
        $portal_code = trim('' . $portal_code);
        $portal_code = 'Singapore ' . $portal_code;
        $addressclean = str_replace(" ", "+", $portal_code);
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $addressclean . "&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $geoloc = json_decode(curl_exec($ch), true);

        if (!isset($geoloc['results'][0]))
            return '1.352083,103.819836';
        else
            return $geoloc['results'][0]['geometry']['location']['lat'] . ',' . $geoloc['results'][0]['geometry']['location']['lng'];
    }

    public static function getFormatAddressDoctor($address) {
        $remove = array("\n", "\r\n", "\r", "<p>", "</p>");
        $address = str_replace($remove, '', $address);
        $address = str_replace("'", "\'", $address);
        return $address;
    }

    public static function replaceTagP_ToBr($message) {
        $message = str_replace('</p>', '<br/>', $message);
        $message = str_replace('<p>', '', $message);
        return $message;
    }

    public static function getCmsPageSize() {
        return 50;
    }

    public static function timeSpan($startDate, $endDate) {
        $startDateTimeStamp = strtotime($startDate);
        $endDateTimeStamp = strtotime($endDate);
        if ($endDateTimeStamp >= $startDateTimeStamp)
            return ($endDateTimeStamp - $startDateTimeStamp) / (3600 * 24);
        return - 1;
    }

    public function languageArr() {
        $arrLan = Language::model()->findAll(array('condition' => 't.status = 1', 'order' => 't.default DESC'));
        return $arrLan;
    }

    public static function clearHtml($str) {
        return strip_tags($str);
    }

    public static function getHtmlGalleryBox($photo) {
        $htmlReplace = "";
        if (!empty($photo)) {
            $htmlReplace .='<div class="clear"></div><div class="gallery_photo">';
            for ($i = 0; $i < count($photo); $i++) {
                $v = $photo[$i];
                $htmlReplace .='<div class="item_photo">';
                $htmlReplace .='<a class="group4" href="' . Yii::app()->baseUrl . "/upload/admin/galleries/large/" . $v->file_name . '"><img class="gallery_item_img" src="' . Yii::app()->baseUrl . "/upload/admin/galleries/thumbs/" . $v->file_name . '"/></a>';
                $htmlReplace .='</div>';
            }
            $htmlReplace .= '</div><div class="clear"></div>';
        }
        return $htmlReplace;
    }

    //Validate for users over 18 only
    /* Nguyen Dung 2013-06-11
     * @param: String $dob: birthday : 1987-11-15 
     * @param: Int $allowAge: 18 or small...
     * @return: true if Age over 18 else return false
     */
    public static function validateAge($dob, $allowAge) {
        // $then will first be a string-date
        $dob = strtotime($dob);
        //The age to be over, over +18
        $min = strtotime('+18 years', $dob);
        if (time() < $min)
            return false; // Not 18
        return true; // over 18
    }

    /* Nguyen Dung 2013-06-11
     * @return: unique verify_code in table User
     */

    public static function generateVerifyCode() {
        $verify_code = rand(100000, 1000000);
        $count = Users::model()->count('verify_code=' . $verify_code . '');
        if ($count > 0) {
            $verify_code = ActiveRecord::generateVerifyCode();
            return $verify_code;
        }
        else
            return $verify_code;
    }

    public static function checkOrderNo($prefix, $order_no) {
        $return_order_id = $prefix . $order_no;
        $count = (int) TspOrder::model()->count('order_no="' . $return_order_id . '"');
        if ($count > 0) {
            $return_order_id = ActiveRecord::checkOrderNo($prefix, GenShortId::alphaID(time()));
            return $return_order_id;
        }
        else
            return $return_order_id;
    }

    public static function getCategory() {
        $model = PrecCategories::model()->findAll('status = 1');
        $arr_category = array(null => 'All');

        if (count($model) > 0) {
            foreach ($model as $model)
                $arr_category[$model->name] = $model->name;
        }
        return $arr_category;
    }

    public static function safeField($field) {
        $field = ActiveRecord::remove_vietnamese_accents($field);
        $field = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $field);
        $remove = array("'", '"', ':');
        $field = str_replace($remove, '', $field);
        return $field;
    }

    public static function remove_vietnamese_accents($str) {
        $accents_arr = array(
            "à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề",
            "ế", "ệ", "ể", "ễ",
            "ì", "í", "ị", "ỉ", "ĩ",
            "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ",
            "ờ", "ớ", "ợ", "ở", "ỡ",
            "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ",
            "đ",
            "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă",
            "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ",
            "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ",
            "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
            "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
            "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
            "Đ"
        );

        $no_accents_arr = array(
            "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a",
            "a", "a", "a", "a", "a", "a",
            "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o",
            "o", "o", "o", "o", "o",
            "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "y", "y", "y", "y", "y",
            "d",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A",
            "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O",
            "O", "O", "O", "O", "O",
            "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
            "Y", "Y", "Y", "Y", "Y",
            "D"
        );

        return str_replace($accents_arr, $no_accents_arr, $str);
    }

    public static function getYearold() {
        $cur_year = date('Y');
        for ($i = ($cur_year - 100); $i <= $cur_year; $i++) {
            $data[$i] = $i;
        }
        return $data;
    }

    public static function getNameBuyer($id_order) {
        $order = PrecOrder::model()->findByPk($id_order);
        if (count($order) > 0) {
            $name = json_decode($order->data_buyer);
            return $name->name;
        }
    }

    public static function getJsonAttrValue($data, $attrName) {
        if ($data) {
            $object = json_decode($data);
            return $object->$attrName;
        }
    }

    public static function getAddress($data) {
        if ($data) {
            $object = json_decode($data);
            return $object->address1 . ' ' . $object->address2 . ', ' . $object->city . ', '
                    . AreaCode::getCountryById($object->country)->area_name . ' ' . $object->postCode;
        }
    }

    public static function Synchronize() {
        set_time_limit(7200);
        $idNameGroup = array();
        $criteria = new CDbCriteria;
//            $criteria->compare('t.status',1);
        $mSubG = SubscriberGroup::model()->findAll($criteria);
        if (count($mSubG) > 0)
            foreach ($mSubG as $i)
                $idNameGroup[$i->id] = $i->name;

        $criteria = new CDbCriteria;
        $mSubscriber = Subscriber::model()->findAll($criteria);
        $test = array();
        if (count($mSubscriber) > 0) {
            Yii::import('ext.MailChimp.MailChimp', true);
            foreach ($mSubscriber as $item) {
                $mailChimp = new MailChimp();
//                    $mailChimp->removeSubscriber('verzdev2@gmail.com');
//                    die;
                $sGroupName = Yii::app()->params['mailchimp_title_groups'];
                $sGroup = strtolower($idNameGroup[$item->subscriber_group_id]);
                $merge_vars = array(
                    //'FNAME'=>$item->first_name, 'LNAME'=>  $item->last_name, 
                    'GROUPINGS' => array(
                        array('name' => $sGroupName, 'groups' => $sGroup),
                    )
                );
                if ($item->status == 1) {
                    $test[] = $mailChimp->addSubscriber($item->email, $merge_vars);
                } else {
                    $mailChimp->removeSubscriber($item->email);
                }
            }
        }
    }

    /**
     * <Jason>
     * @return type
     */
    public static function getSubpage() {
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', 1);
        $model = Pages::model()->findAll($criteria);
        if ($model) {
            return CHtml::listData($model, 'id', 'title');
        }
    }

    /**
     * <Jason>
     * @return type
     */
    public static function getResizeImage($pageId) {
//            if($pageId==){
        return array('thumbs' => array('width' => BANNER_CMS_ADMIN_WIDTH, 'height' => BANNER_CMS_ADMIN_HEIGHT),
            '960x217' => array('width' => BANNER_CMS_ADMIN_WIDTH, 'height' => BANNER_CMS_ADMIN_HEIGHT),
        );
//            }
    }

    //current date < start date and number register <opacity and is login  and no exist register
    // true-> has register , false -> has not register

    public static function CheckRegisterEvent($slug) {
        $event = PrecEvents::model()->find('slug = "' . $slug . '"');
        $flag = true;
        //current date < start date
        if (strtotime($event->datetime_from) < time()) {
            $flag = false;
        }
        //number register <opacity
        $user_event_count = PrecEventUser::model()->findAll('event_id = ' . $event->id);
        if (count($user_event_count) >= $event->capacity) {
            $flag = false;
        }
        //is login

        return $flag;
    }

    public static function CheckRegisterEventUser($slug) {

        // no exist register
        $flag = true;
        if (isset(Yii::app()->user->id)) {
            $event = PrecEvents::model()->find('slug = "' . $slug . '"');
            $user_event_exist = PrecEventUser::model()->findAll('event_id = "' . $event->id . '" and user_id = ' . Yii::app()->user->id);
            if (count($user_event_exist) > 0) {
                $flag = false;
            }
        }
        return $flag;
    }

    public static function setCookie($type, $record, $fieldName) {
        $param = array(
            VERZ_COOKIE_ADMIN => array(VERZLOGIN, VERZLPASS),
            VERZ_COOKIE_MEMBER => array(VERZLOGIN_MEMBER, VERZLPASS_MEMBER)
        );
        if (array_key_exists($type, $param)) {
            $expire = time() + 7 * 24 * 60 * 60;
            $array[$param[$type][0]] = $record->$fieldName;
            $array[$param[$type][1]] = $record->temp_password;
            setcookie($type, json_encode($array), $expire);
        }
    }

    public static function getTypeEnquiry() {
        $type_arr = array(null => 'Select One');
        $type = PrecTypes::model()->findAll('status = 1');
        if (count($type) > 0) {
            foreach ($type as $type) {
                $type_arr[$type->name] = $type->name;
            }
        }
        return $type_arr;
    }

    public static function forceDownload($model, $name_field) {
        $src = '';
        $className = get_class($model);
        if ($className == 'ProListingUploadCea') {
            if (empty($model->$name_field))
                throw new Exception("Invalid request. No $name_field found.");
            $fileName = $model->$name_field;
            $src = "upload/listing/" . $model->listing_id . "/cea/" . $fileName;
        }
        elseif ($className == 'ProTransactionsPropertyDocument') {
            if (empty($model->$name_field))
                throw new Exception("Invalid request. No $name_field found.");
            $fileName = $model->$name_field;
            $src = "upload/transactions/property_document/" . $model->transactions_id . "/" . $fileName;
        }
        elseif ($className == 'ProUploadDocument') {
            if (empty($model->$name_field))
                throw new Exception("Invalid request. No $name_field found.");
            $fileName = $model->$name_field;
            $src = "upload/document/" . $model->user_id . "/" . $fileName;
        }        
        else
            throw new Exception('Invalid request.');
        $fileHelper = new FileHelper();
        $fileHelper->forceDownload($src);
    }

    /*
     * dtoan
     */
    
    public static function getInfoRecord($className,$id,$field_name=NULL){
        $ModelName = call_user_func(array($className,'model'));
        $model = $ModelName->findByPk($id);
        if($model){
            if(empty($field_name))  return $model;
            else return $model->$field_name;
        }
        return null;
    }
    
    
}
