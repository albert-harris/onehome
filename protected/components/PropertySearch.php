<?php

/*
 * HThoa
 * Property search
 */
class PropertySearch extends CWidget
{
	public function run() {
		$property_type = ProPropertyType::model()->findForSearch();
		$this->render("property_search", array(
                    'property_type' => $property_type
                ));	
	}
}

?>
