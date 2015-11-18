<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
                try{
                $this->render('view',array(
			'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                try
                {
		$model=new <?php echo $this->modelClass; ?>('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('create',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                try
                {
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save())
				$this->redirect(array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
		}

		$this->render('update',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
                try
                {
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			if($model = $this->loadModel($id))
                        {
                            if($model->delete())
                                Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                        }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
                {
                    Yii::log("Invalid request. Please do not repeat this request again.");
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }	
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
                try
                {
                    <?php 
                    foreach($this->tableSchema->columns as $column)
                    {
                        if($column->name == 'status')
                        {
                            ?>
                    if(isset($_POST['status']) && isset($_POST['selectedField']))
                    {
                        <?php echo $this->modelClass; ?>::changeStatus($_POST['status'], $_POST['selectedField']);
                    }
                         
                    <?php   
                        }
                    }
                    ?>
                    
		$model=new <?php echo $this->modelClass; ?>('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['<?php echo $this->modelClass; ?>']))
			$model->attributes=$_GET['<?php echo $this->modelClass; ?>'];

		$this->render('index',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
                try
                {
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
                {
                    Yii::log("The requested page does not exist.");
                    throw new CHttpException(404,'The requested page does not exist.');
                }			
		return $model;
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
                try
                {
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                }
                catch (Exception $e)
                {
                    Yii::log("Exception ".  print_r($e, true), 'error');
                    throw  new CHttpException("Exception ".  print_r($e, true));     
                }
	}
}
