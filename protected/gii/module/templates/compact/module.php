<?php echo "<?php\n"; ?>

class <?php echo $this->moduleClass; ?> extends CWebModule
{
	public $defaultController = 'site';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'<?php echo $this->moduleID; ?>.models.*',
			'<?php echo $this->moduleID; ?>.components.*',
		));
		
		
		$this->setComponents(array(
            'user' => array(
                'class' => 'WebUser',
                'loginUrl' => Yii::app()->createUrl('<?php echo $this->moduleID; ?>/site/login'),
                'returnUrl'=> Yii::app()->createUrl('<?php echo $this->moduleID; ?>/site/'),
            )
        ));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			Yii::app()->errorHandler->errorAction='<?php echo $this->moduleID; ?>/site/error';
			
			return true;
		}
		else
			return false;
	}
}
