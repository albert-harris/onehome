<?php
/*
 * Property search
 */
class PropertySearchHomeWidget extends CWidget
{
	public function run() {
		$property_type = ProPropertyType::model()->findForSearch();
		$this->render("property_search_home", array(
                    'property_type' => $property_type
                ));	
	}
}
?>
