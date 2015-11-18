<?php

/**
 * Duplicated of Listing except beforeSave
 *
 * @author Lam
 */
class LhListing extends Listing {
	
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

	public function beforeSave() {
		return CActiveRecord::beforeSave();
	}
	
	public function rules() {
		return array(
			array('listing_type,display_address,of_bedroom,of_bathrooms,listing_description,
				date_listed,re_listed_date,property_name_or_address,price,floor_area,
				land_area,property_type_1,tenure,user_id,status,status_listing,created_date,
				floor_area_unit', 
				'safe', 'on'=>'sync')
		);
	}
}
