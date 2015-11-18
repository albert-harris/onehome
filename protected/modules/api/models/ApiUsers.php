<?php
class ApiUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('email, email_not_login, password_hash, temp_password, first_name, last_name, created_date, last_logged_in, ip_address, role_id, application_id, address, dob, upload_employment_pass_passport, scanned_passport, country_id, address2, avatar, commission_schema_id, agent_cea, agent_company_name, agent_company_logo, license, expiration_date, name_for_slug, slug, ic_number, full_name_for_search', 'required'),
			array('login_attemp, role_id, application_id, status, area_code_id, gender, id_type, country_id, is_subscriber, commission_schema_id, send_mail, gst, email_click, phone_click, view_count, location_id', 'numerical', 'integerOnly'=>true),
			array('email, username, title, nric_passportno_roc', 'length', 'max'=>50),
			array('email_not_login, password_hash, first_name, last_name, verify_code, contact_no, postal_code, ic_number', 'length', 'max'=>100),
			array('temp_password, ip_address', 'length', 'max'=>30),
			array('first_char', 'length', 'max'=>1),
			array('address, address2, avatar, agent_cea, agent_company_name, agent_company_logo, license, name_for_slug, slug, upload_nric_back, upload_nric_front, upload_certification', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>20),
			array('upload_employment_pass_passport', 'length', 'max'=>300),
			array('scanned_passport', 'length', 'max'=>254),
			array('full_name_for_search', 'length', 'max'=>256),
			array('pass_expiry_date, introduction, qualification, experience', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, email_not_login, username, title, password_hash, temp_password, first_name, last_name, first_char, login_attemp, created_date, last_logged_in, ip_address, role_id, application_id, status, verify_code, area_code_id, address, dob, gender, phone, nric_passportno_roc, contact_no, postal_code, id_type, pass_expiry_date, upload_employment_pass_passport, scanned_passport, country_id, is_subscriber, address2, avatar, commission_schema_id, send_mail, agent_cea, agent_company_name, agent_company_logo, license, expiration_date, gst, name_for_slug, slug, ic_number, full_name_for_search, email_click, phone_click, introduction, qualification, experience, view_count, upload_nric_back, upload_nric_front, upload_certification, location_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'email_not_login' => 'Email Not Login',
			'username' => 'Username',
			'title' => 'Title',
			'password_hash' => 'Password Hash',
			'temp_password' => 'Temp Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'first_char' => 'First Char',
			'login_attemp' => 'Login Attemp',
			'created_date' => 'Created Date',
			'last_logged_in' => 'Last Logged In',
			'ip_address' => 'Ip Address',
			'role_id' => 'Role',
			'application_id' => 'Application',
			'status' => 'Status',
			'verify_code' => 'Verify Code',
			'area_code_id' => 'Area Code',
			'address' => 'Address',
			'dob' => 'Dob',
			'gender' => 'Gender',
			'phone' => 'Phone',
			'nric_passportno_roc' => 'Nric Passportno Roc',
			'contact_no' => 'Contact No',
			'postal_code' => 'Postal Code',
			'id_type' => 'Id Type',
			'pass_expiry_date' => 'Pass Expiry Date',
			'upload_employment_pass_passport' => 'Upload Employment Pass Passport',
			'scanned_passport' => 'Scanned Passport',
			'country_id' => 'Country',
			'is_subscriber' => 'Is Subscriber',
			'address2' => 'Address2',
			'avatar' => 'Avatar',
			'commission_schema_id' => 'Commission Schema',
			'send_mail' => 'Send Mail',
			'agent_cea' => 'Agent Cea',
			'agent_company_name' => 'Agent Company Name',
			'agent_company_logo' => 'Agent Company Logo',
			'license' => 'License',
			'expiration_date' => 'Expiration Date',
			'gst' => 'Gst',
			'name_for_slug' => 'Name For Slug',
			'slug' => 'Slug',
			'ic_number' => 'Ic Number',
			'full_name_for_search' => 'Full Name For Search',
			'email_click' => 'Email Click',
			'phone_click' => 'Phone Click',
			'introduction' => 'Introduction',
			'qualification' => 'Qualification',
			'experience' => 'Experience',
			'view_count' => 'View Count',
			'upload_nric_back' => 'Upload Nric Back',
			'upload_nric_front' => 'Upload Nric Front',
			'upload_certification' => 'Upload Certification',
			'location_id' => 'Location',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getByNric($nric)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.nric_passportno_roc', $nric);
        return self::model()->find($criteria);
	}
	public function logout($token)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('token', $token);
        UsersTokens::model()->deleteAll($criteria);
    }

}
