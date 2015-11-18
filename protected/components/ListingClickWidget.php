<?php

/**
 * Display popup when click to the total clicked number
 *
 * @author Lam Huynh
 */
class ListingClickWidget extends CWidget {

	public $listing;

	public function run() {
		$this->render('listing_click', array('model'=>$this->listing));
	}

}
