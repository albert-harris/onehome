<?php
/*
 * Property search
 */
class PropertyQuickSearchWidget extends CWidget
{
	public function run() {
		$property_type = ProPropertyType::model()->findForSearch();
		$this->render("property_quick_search", array(
                    'property_type' => $property_type
                ));	
	}
}
?>
