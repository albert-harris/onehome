<?php
/**
 * @author Lam Huynh
 */
class CmsUrlRule extends CBaseUrlRule {

	protected $_pages=null;
	
	protected $_urlSuffix='';
	
	protected function getPages() {
		if (!$this->_pages) {
			$c = new CDbCriteria();
			$this->_pages = Pages::model()->findAll($c);
		}
		return $this->_pages;
	}
	
	public function createUrl($manager, $route, $params, $ampersand) {
		// url rewrite for cms page
		if (!isset($params['slug'])) return false;
		foreach($this->getPages() as $p) {
			if ($p->slug==$params['slug'])
				return $p->slug.$this->_urlSuffix;
		}

		// no content found
		return false;
	}
	
	public function parseUrl($manager, $request, $pathInfo, $rawPathInfo) {
		// url rewrite for cms page
		foreach($this->getPages() as $p) {
			$slug = rtrim($pathInfo,$this->_urlSuffix);
			if ($p->slug==$slug)
//				return "site/view_page/slug/$p->slug";
				return "page/index/slug/$p->slug";
		}
		
		// no content found
		return false;
	}
}