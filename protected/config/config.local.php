<?php 
$THEME_NAME = 'property';
$THEME		= 'property';
$TABLE_PREFIX = 'pro';
   
include 'config_host/host.php';
   
/**********************Core config********************************/

define('TYPE_LANDLORD', 3);
define('TYPE_TENANT', 4);

define('BE', 1);
define('FE', 2);

define('ROLE_MANAGER', 1);
define('ROLE_ADMIN', 2);
define('ROLE_AGENT', 3);
define('ROLE_LANDLORD', 4);
define('ROLE_TENANT', 5);
define('ROLE_REGISTER_MEMBER', 6);
define('ROLE_VENDOR', 7);
define('ROLE_PURCHASER', 8);
define('ROLE_SUB_ADMIN', 9);
define('ROLE_EXTERNAL_CO_BROKE', 10);
define('ROLE_TELEMARKETER', 15);
define('ROLE_HR', 16);

//max records in logger table
define('LOGGER_TABLE_MAX_RECORDS', 2000);

define('BANNER_1_WIDTH', 960);
define('BANNER_1_HEIGHT', 300);
define('BANNER_2_WIDTH', 230);
define('BANNER_2_HEIGHT', 69);


define('STATUS_INACTIVE', 0);
define('STATUS_ACTIVE', 1);
define('STATUS_GEN_INVOICE', 2);// 2 đánh dấu transaction đã được gen invoice
define('STATUS_GEN_VOUCHER', 3);// 3 đánh dấu transaction đã được gen VOUCHER
define('STATUS_GEN_RECEIPT', 4);// 4 đánh dấu transaction đã được gen RECEIPT
define('STATUS_TENANCY_NEW', 35);// 35 status for change Now 28, 2014 tạo tenancy mà không có transaction voi status new
define('STATUS_TENANCY_APPROVE', 36);// 35 status for change Now 28, 2014 tạo tenancy mà không có transaction, status approve
define('STATUS_TENANCY_DRAFT', 37);// 37 status for change JAN 13, 2015  tạo tenancy mà không có transaction, add Save as Draft and Cancel button beside Submit.

/**************Listing**************/
define('STATUS_LISTING_ALL', 0);
define('STATUS_LISTING_ACTIVE', 1);
define('STATUS_LISTING_EXPIRED', 6);
define('STATUS_LISTING_PENDING', 2);
define('STATUS_LISTING_REJECTED', 3);
define('STATUS_LISTING_DRAFT', 4);
define('STATUS_LISTING_PAST', 5);

define('STATUS_PEDING_APPROVE', 0); //DUNG CHO tab pending
define('STATUS_ADMIN_APPROVE', 1); //DUNG CHO tab pending
define('STATUS_PEDING_REMOVE', 2); //DUNG CHO tab pending

/**********************************/

//Bank request
define('SHOP_HOUSE', 48);
define('LAND_SIZE', 49);
define('BUILT_UP_SIZE', 50);
define('RETAIL', 28);
define('LANDED_HOUSE', 2);   

/**********************************/


define('DEFAULT_AREA_CODE', 229);// IS SINGAPORE
define('PASSW_LENGTH_MIN', 6);
define('PASSW_LENGTH_MAX', 32);
define('PHONE_LENGTH_MAX', 20);
define('PHONE_LENGTH_MIN',6);
define('MAX_LIMIT_EMAIL_ACCOUNT',200);

define('MAXLENGTH_FIRST_LAST_NAME', 50);
define('MAXLENGTH_EMAIL', 100);
define('MAXLENGTH_ADDRESS', 200);

define('IMAGE_ADMIN_WIDTH', 260);
define('IMAGE_ADMIN_HEIGHT', 200);

define('BANNER_CMS_ADMIN_WIDTH', 960);
define('BANNER_CMS_ADMIN_HEIGHT', 217);

define('IMAGE_ADMIN_THUMB_WIDTH', 117);
define('IMAGE_ADMIN_THUMB_HEIGHT', 90);

// Toan
define('VERZ_COOKIE_ADMIN', md5('verz_cookie_admin'));
define('VERZ_COOKIE', md5('verz_cookie'));
define('VERZLOGIN', md5('verz_login'));
define('VERZLPASS', md5('verz_pass'));
// Nguyen Dung
define('VERZ_COOKIE_MEMBER', md5('verz_cookie_member'));
define('VERZLOGIN_MEMBER', md5('verz_login_member'));
define('VERZLPASS_MEMBER', md5('verz_pass_member'));
// ANH DUNG

define('EDITOR_WIDTH',400);

//HThoa
define('MINIMUM_TYPE', 1);
define('MAXIMUM_TYPE', 2);


/**********************Property Info config********************************/

// don vi do
define('PRO_UNIT','sqft');

//AutoComplete
define('MIN_LENGTH_AUTOCOMPLETE',1);

//mail
define('EMAIL_CONTACT_US', 14);
define('MAIL_AFTER_REGISTER', 9);
define('EMAIL_REPLY_ENQUIRY', 17);
define('EMAIL_ENQUIRY_GLOBAL', 24);
define('EMAIL_SHORTLIST_ENQUIRY', 21);
define('EMAIL_ENQUIRY_FOR_AGENT', 22);
define('MAIL_LANDLORD_TENANT_LOGIN', 18);
define('MAIL_LANDLORD_TENANT_ADDTO_TRANSACTION', 19);
define('MAIL_LANDLORD_SEND_ENGAGE_US', 20);
define('MAIL_BANK_REQUEST', 25);
define('MAIL_RESUME_USER', 26);
define('MAIL_TENANCY_EXPIRING', 28);
define('MAIL_TENANT_EMPLOYMENT_PASS_EXPIRE', 29);
define('MAIL_NOTIFY_TESTIMONIAL_SUBMIT', 30);
define('EMAIL_ENQUIRY_GLOBAL_TO_SENDER', 31);
define('EMAIL_ENQUIRY_FOR_SENDER', 32);
define('EMAIL_NEW_TRANSACTION', 33);

//type of banner
define('TOP', 1);
define('MIDDLE', 2);
define('BOTTOM', 3);
define('MIDDLE_HOME', 4);
define('TOP_HOME', 5);

//static page
define('PAGE_ENGAGE_US_BOX', 67);
define('PAGE_PROPERTY_BOX', 68);
define('PAGE_THANK_ENQUIRY_GLOBAL', 69);
define('PAGE_THANK_ENQUIRY_PROPERTY', 70);
define('PAGE_Terms_Of_Service', 79);
define('PAGE_Privacy_Policy', 61);
define('PAGE_THANK_BANK_VALUATION_REQUEST', 82);
define('PAGE_REGISTER_THANK_YOU', 64);

//limit photo upload
define('LIMIT_PHOTO_UPLOAD',12);
define('LIMIT_DOC_UPLOAD',3);
define('LIMIT_UPLOAD_APPREAL',3);
//group subscriber
define('G_PUBLIC', 1);
define('G_REGISTER_MEMBER', 2);
define('G_AGENT', 3);
define('G_LANDLORD', 4);
define('G_TENANT', 5);

//type of enquiry property
define('ENQUIRY_PROPERTY_NEW', 0);
define('ENQUIRY_PROPERTY_READ', 1);
define('ENQUIRY_PROPERTY_REPLIED', 2);



define('PAGE_TERMS_CONDITION',60);

/*
* verz : 778 , 779
* live 744,745
 */

define('ID_USER_SHOW_FULL_LISTING_1',744);
define('ID_USER_SHOW_FULL_LISTING_2',745);

















/**************************************************************************/

?>