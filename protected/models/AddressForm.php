<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class AddressForm extends CFormModel
{
	public $address1;
	public $address2;
	public $country;
    public $city;
    public $postCode;
    public $state;
    public $shipingMethod;
    public $theSame;


    /**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('address1,  country, city, postCode', 'required', 'on' => 'create'),
            array('shipingMethod', 'required', 'on' => 'shipping', 'message'=>'You have to select an shipping method'),
            array('address1, address2, country, city, postCode, state, theSame', 'safe'),
            );
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
                        'address1'=>'Address line 1',
                        'address2'=>'Address line 2',
                        'country'=>'Country',
                        'city'   => 'City',
                        'state'  =>  'State',
                        'postCode'=>'Postcode',
		);
	}
}