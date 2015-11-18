<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
    public $name;
    public $phone;
    public $email;
    public $enquiry_type;
    public $position;
    public $message;
    public $company;

    public $verifyCode;
    public static $enqueryType = array(''=>'Select',
                                '1'=>'Buy',
                                '2'=>'Sell',
                                '3'=>'Rent',
                                '4'=>'Others',
    );

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('message,email,phone,enquiry_type', 'required'),
//                        array('enquiry_type','checkEnqueryType'),
            array('email', 'email'),
            array('phone','checkPhone'),
            array('phone','length', 'max'=>'15'),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements()),

        );
    }
    
    public function checkPhone($attribute,$params)
    {
        if($this->$attribute != ''){
            $pattern = '/^[\+]?[\(]?(\+)?(\d{0,3})[\)]?[\s]?[\-]?(\d{0,9})[\s]?[\-]?(\d{0,9})[\s]?[x]?(\d*)$/';
            $containsDigit = preg_match($pattern,$this->$attribute);
            $lb = $this->getAttributeLabel($attribute);
            if(!$containsDigit)
                $this->addError($attribute,"$lb must be numerical and  allow input (),+,-");
        }
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
            return array(
                    'email'=>'Email Address',
                    'name'=>'Name',
                    'enquiry_type'=>'Enquiry Type',
                    'position'=>'Position',
                    'phone'=>'Telephone',
                    'message'=>'Message',
                    'company'=>'Company',
            );
    }
    public function checkEnqueryType($attribute, $params) 
    {
        $enquiry_type = $this->enquiry_type;
        if($enquiry_type == '1')
        {
            $this->addError('enquiry_type', 'Enquiry Type cannot blank.');
        }

    }
}