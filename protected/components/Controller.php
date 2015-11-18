<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends MainController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/site';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	 
	public $activedPage;
    public $productCategories;
    public $breadcrumbs=array();
	
	public $_metaKeyword;
	
	public $_metaDescription;

    public function init(){

        // register class paths for extension captcha extended
        Yii::$classMap = array_merge( Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
        ));
    }
    
	public function getMetaKeywords()
	{
		if(!empty($this->_metaKeyword))
			return $this->_metaKeyword;
		else
		{
			return Yii::app()->params['meta_keywords'];
		}
	}
	
	public function setMetaKeywords($value)
	{
		$this->_metaKeyword=$value;
	}
	
	public function getMetaDescription()
	{
		if(!empty($this->_metaDescription))
			return $this->_metaDescription;
		else
		{
			return Yii::app()->params['meta_description'];
		}
	}
	
	public function setMetaDescription($value)
	{
		$this->_metaDescription=$value;
	}
    
    public function rewriteForSeo(){
        if(!empty($this->_metaDescription)) {
            Yii::app()->clientScript->registerMetaTag($this->_metaDescription, 'description');
		} else {
            Yii::app()->clientScript->registerMetaTag(Yii::app()->params['meta_description'], 'description');
		}

		if(!empty($this->_metaKeyword)) {
            Yii::app()->clientScript->registerMetaTag($this->_metaKeyword, 'keywords');
		} else  {
            Yii::app()->clientScript->registerMetaTag(Yii::app()->params['meta_keywords'], 'keywords');
		}
    }   
    
    public function beforeRender($view) {
		parent::beforeRender($view);
        $this->rewriteForSeo();                                 	
        return true;        
    }
    
    public function getCurrentUrlWithoutParam()
    {
        $uriWithoutParam = $_SERVER['REQUEST_URI'];
        if (strpos($uriWithoutParam, '?') != false)
            $uriWithoutParam = substr($uriWithoutParam, 0, strpos($uriWithoutParam, '?'));
        return 'http://' . $_SERVER['SERVER_NAME'] . $uriWithoutParam;
    }
    
    
    
    public function getCartCount()
    {
        if (isset($_COOKIE['cart'])) {
            $cart = unserialize(Yii::app()->request->cookies['cart']->value);
            return count($cart['product']);
        }
        return 0;
    }
    
    function checkChildCatSelect($listCat, $selectedCat)
	{
	    foreach ($listCat as $item)
	    {
		if ($selectedCat!= '' && $selectedCat == $item->slug && $item->level > 0)
		{
		    return Categories::model()->findByPk ($item->parent_id);
		}
	    }
	    return null;
	}
	
	function hasChild($listCat, $selectedCat)
	{
	    foreach ($listCat as $item)
	    {
		if ($selectedCat == $item->slug)
		    return $hasChild = Categories::model()->findAll("parent_id = " . $item->id);
	    }
	    return null;
	}
	
	/*
	 * Setting page title, meta description, meta keywords from values in db
	 */
	public function autosetSeoData($pageName, $params=array()) {
		array_unshift($params, $pageName);
		$pageId = implode('_', $params);
		$seo = Seo::model()->findByAttributes(array('page_identifier'=>$pageId));
		if (!$seo) return;
		$this->pageTitle = $seo->page_title;
		$this->setMetaDescription($seo->meta_description);
		$this->setMetaKeywords($seo->meta_keyword);
	}
}