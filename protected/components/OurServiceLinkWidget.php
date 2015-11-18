<?php


/**
 * Display listings with sorter and pager
 *
 * @author Lam Huynh
 */
class OurServiceLinkWidget extends CWidget {

	public $model;
	
    public function run() {
		$categories = OurService::getMainCategories();
		$this->render('our-service-link-widget', array(
			'categories' => $categories
		));
	}
	
	public function isItemActive($item) {
		return $this->model && ( $item->id==$this->model->id || 
			$this->hasChildActive($item) );
	}
	
	public function hasChildActive($item) {
		foreach($item->childs as $c) {
			if ($c->id==$this->model->id) return true;
		}
		return false;
	}
	public function getCssClass($item) {
		return $this->isItemActive($item) ? 'active' : '';
	}
}
