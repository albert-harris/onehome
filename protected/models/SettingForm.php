<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SettingForm extends CFormModel {

    //email
    public $transportType; //php or smtp
    public $smtpHost;
    public $smtpUsername;
    public $smtpPassword;
    public $smtpPort;
    public $encryption;
    //general
    public $dateFormat;
    public $timeFormat;
    public $adminEmail;
    public $autoEmail;
    public $login_limit_times;
    public $time_refresh_login;
    public $description_funtastic;
    public $description_promo;
    public $description_contactus;
    public $number_month_expired;

    //Silver Planet
    public $membership_fee;
    public $total_coin;    
    public $available_coin;    
    public $commission_coin;    
    
    //paypal
    public $paypalURL;
    public $paypal_email_address;
    public $paypalType;
    public $twitter;
    public $facebook;
    public $linkedin;
    public $rss;
    public $title;
    public $meta_description;
    public $meta_keywords;
    public static $_paypalURL;
    public $title_all_mail;
    public $image_watermark;
    public $image_watermark2;
    //mailchimp
    public $mailchimp_on;
    public $mailchimp_api_key;
    public $mailchimp_list_id;
    public $mailchimp_title_groups;
    // for cron job newsletter
    public $server_name;
    public $directions;
    public $postal_code;
    public $company_name;
    public $address;
    public $tel;
    public $fax;
    public $email;
    public $follow_us_facebook;
    public $follow_us_twitter;
    public $follow_us_youtube;
    public $follow_us_linkedin;
    public $follow_us_instagram;
    public $follow_us_google;
    public $follow_us_tumblr;
    public $copyright_on_footer;
    public $text_on_footer;
    public $whitepaper_file_types;
    public $paypalCurrencySign;
   
    public $directReferal;
    public $indirectReferal;
    
    public $movement_by_car;
    public $movement_by_train;
    public $address_map;
    
    public $distance=2;
    public $limit_result=2000;
    
    public $gst;
    
    public $min_land_area;
    public $min_floor_area;
    public $unit_sqm_sqft;
    
    public $percent_profit_from_company_listing;
    
    public $invoice_title;
    public $invoice_address_line_1;
    public $invoice_address_line_2;
    public $invoice_address_line_3;
    public $invoice_phone;
    public $invoice_fax;
    public $invoice_uen;
    public $invoice_cea;
    public $company_license;
    
    public $side_bar_text_1;
    public $side_bar_text_2;
    public $telemarketer_comm;
    public $month_expiry_alert;
    
    public $place_holder_description_send_enquiry;
    public $detail_property_place_holder_description_send_enquiry;
    
    public $flag_resize;

    public function rules() {
        $return = array();
        foreach (SettingForm::$arrGeneral as $key => $value):
            $return[] = array($value, 'safe');
        endforeach;
        foreach (SettingForm::$arrSmtp as $key => $value):
            $return[] = array($value, 'safe');
        endforeach;

        $return [] = array('number_month_expired, school_level, programme_title,payment_mode, description_contactus,distance,limit_result', 'required','on'=>'index');
        
        $return [] = array('number_month_expired, copyright_on_footer, adminEmail, autoEmail, description_promo, description_funtastic', 'required', 'on' => 'updateSettins');
//        $return [] = array('min_land_area, min_floor_area, unit_sqm_sqft', 'required'); // không nên, vì setting là required hết
        
        $return [] = array('smtpPort, login_limit_times, time_refresh_login', 'numerical', 'integerOnly' => true);
        
        //silver planet
        $return [] = array('commission_coin,distance,limit_result', 'numerical', 'integerOnly' => true);
        $return [] = array('distance,limit_result','compare','compareValue'=>'0','operator'=>'>=','message'=>'Distance must be greater than 0' );
        $return [] = array('membership_fee', 'numerical');
        

        
        $return [] = array('adminEmail, autoEmail', 'email');
        $return [] = array('twitter,facebook,linkedin,rss', 'length', 'max' => 200);
//        $return [] = array('asideImage', 'file', 'on' => 'updateSettings',
//            'allowEmpty' => true,
//            'types' => 'jpg,gif,png,tiff',
//            'wrongType' => 'Only jpg,gif,png,tiff allowed',
//            'maxSize' => 1024 * 1024 * 3, // 8MB
//            'tooLarge' => 'The file was larger than 3MB. Please upload a smaller file.',
//        );
//        $return [] = array('asideImage', 'match', 'pattern' => '/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:&;{}\\\\]{3}$/', 'message' => 'Image files name cannot include special characters: &%$#', 'on' => 'updateSettings');
        
//        $return [] = array('asideVideo', 'file', 'on' => 'updateSettings',
//            'allowEmpty' => true,
//            'types' => 'avi,mpg,flv,mp4',
//            'wrongType' => 'Only avi,mpg,flv,mp4 allowed',
//            'maxSize' => 1024 * 1024 * 50, // 8MB
//            'tooLarge' => 'The file was larger than 3MB. Please upload a smaller file.',
//        );
//        $return [] = array('asideVideo', 'match', 'pattern' => '/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:&;{}\\\\]{3}$/', 'message' => 'Video files name cannot include special characters: &%$#', 'on' => 'updateSettings');
//        
        $return [] = array('image_watermark2', 'file',
              'allowEmpty'=>true,
              'types'=> 'png',
              'wrongType'=>'Only png allowed',
              'maxSize' => 1024 * 1024 * 3, // 8MB
              'tooLarge' => 'The file was larger than 3MB. Please upload a smaller file.',
         );       
        
        $return [] = array('transportType, smtpHost, dateFormat, timeFormat, smtpUsername, smtpPassword, encryption', 'length', 'max' => 100);
        $return [] = array('number_month_expired,paypalCurrencySign, adminEmail,autoEmail,copyright_on_footer,text_on_footer, title, meta_description, meta_keywords,address, address_map, phone, email,fax,movement_by_car,movement_by_train', 'safe');//googleMap,
		return $return;
    }

    public static $arrSmtp = array('host' => 'smtpHost', 'username' => 'smtpUsername', 'password' => 'smtpPassword',
        'port' => 'smtpPort', 'encryption' => 'encryption');
    public static $arrGeneral = array('dateFormat' => 'dateFormat', 'timeFormat' => 'timeFormat',
        'adminEmail' => 'adminEmail',
        'autoEmail' => 'autoEmail', 'paypalURL' => 'paypalURL', 'paypal_email_address' => 'paypal_email_address',
        'twitter' => 'twitter', 'facebook' => 'facebook', 'linkedin' => 'linkedin', 'rss' => 'rss',
        'title' => 'title',
        'meta_description' => 'meta_description',
        'meta_keywords' => 'meta_keywords', 
        'image_watermark' => 'image_watermark',
        'image_watermark2' => 'image_watermark2',
        
        'login_limit_times' => 'login_limit_times',
        'time_refresh_login' => 'time_refresh_login',
        
        'membership_fee' => 'membership_fee',    
        'commission_coin' => 'commission_coin',    
        
        'title_all_mail' => 'title_all_mail',
        'mailchimp_on' => 'mailchimp_on',
        'mailchimp_api_key' => 'mailchimp_api_key',
        'mailchimp_list_id' => 'mailchimp_list_id',
        'mailchimp_title_groups' => 'mailchimp_title_groups',
        'server_name' => 'server_name',
        'directions' => 'directions',
        'postal_code' => 'postal_code',
        'company_name' => 'company_name',
        'address' => 'address',
        'address_map'=>'address_map',
        'tel' => 'tel',
        'fax' => 'fax',
        'email' => 'email',
        'follow_us_facebook' => 'follow_us_facebook',
        'follow_us_twitter' => 'follow_us_twitter',
        'follow_us_youtube' => 'follow_us_youtube',
        'follow_us_linkedin' => 'follow_us_linkedin',
        'follow_us_instagram'=>'follow_us_instagram',
        'follow_us_google'=>'follow_us_google',
        'follow_us_tumblr'=>'follow_us_tumblr',
        'copyright_on_footer' => 'copyright_on_footer',
        'movement_by_car'=>'movement_by_car',
        'movement_by_train'=>'movement_by_train',
        'text_on_footer'=>'text_on_footer',
        'number_month_expired'=>'number_month_expired',
        'distance'=>'distance',
        'limit_result'=>'limit_result',
        'gst'=>'gst',
        'min_land_area'=>'min_land_area',
        'min_floor_area'=>'min_floor_area',
        'unit_sqm_sqft'=>'unit_sqm_sqft',
        'percent_profit_from_company_listing'=>'percent_profit_from_company_listing',
        
        'invoice_title'=>'invoice_title',
        'invoice_address_line_1'=>'invoice_address_line_1',
        'invoice_address_line_2'=>'invoice_address_line_2',
        'invoice_address_line_3'=>'invoice_address_line_3',
        'invoice_phone'=>'invoice_phone',
        'invoice_fax'=>'invoice_fax',
        'invoice_uen'=>'invoice_uen',
        'invoice_cea'=>'invoice_cea',
        'company_license'=>'company_license',
        'side_bar_text_1'=>'side_bar_text_1',
        'side_bar_text_2'=>'side_bar_text_2',
        'telemarketer_comm'=>'telemarketer_comm',
        'month_expiry_alert'=>'month_expiry_alert',
        
        'place_holder_description_send_enquiry'=>'place_holder_description_send_enquiry',
        'detail_property_place_holder_description_send_enquiry'=>'detail_property_place_holder_description_send_enquiry',
        'flag_resize'=>'flag_resize',
    );
    
    /**
     * Override configurations.
     */
    static public function applySettings() {
        //apply setting for paypal
        if (Yii::app()->setting->getItem('transportType')) {
            Yii::app()->mail->transportType = Yii::app()->setting->getItem('transportType');
        }
        if (Yii::app()->mail->transportType == 'smtp') {
            foreach (self::$arrSmtp as $key => $value) {
                if (Yii::app()->setting->getItem($value)) {
                    Yii::app()->mail->transportOptions[$key] = Yii::app()->setting->getItem($value);
                }
            }
        } else {
            Yii::app()->mail->transportOptions = '';
        }

        //apply setting for general
        foreach (self::$arrGeneral as $key => $value) {
            if (Yii::app()->setting->getItem($value)) {
                Yii::app()->params[$key] = Yii::app()->setting->getItem($value);
            }
        }
        
        //apply setting for general

        self::$_paypalURL = Yii::app()->params['paypalURL'];

        //apply setting for paypal

        if (Yii::app()->setting->getItem('title')) {
            Yii::app()->name = Yii::app()->setting->getItem('title');
        }
    }
    
    

}
