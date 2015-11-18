<?php
Yii::import('zii.widgets.CPortlet');
class NavMenu extends CPortlet
{
	public $idul;
	public $classli;
	public $before_link;
	public $after_link;
	public $before_content;
	public $after_content;
	
	public function init()
    {
        parent::init();
    }
	
	public function renderContent()
    {
		$model = Cms::model()->findAllByAttributes(array('status'=>1,'show_in_menu'=>1));
		//$model = Cms::model()->findAll();
		$this->render('navmenu',array(
				'models'=>$model,
				'idul'=>$this->idul,
				'classli'=>$this->classli,
				'before_link'=> $this->before_link, 
				'after_link' => $this->after_link, 
				'before_content'=>$this->before_content, 
				'after_content' => $this->after_content
		));
	}
	
	public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('ext.mywidget.assets'), true, -1, true );
        return $this->_assetsUrl;
    }
}
?>