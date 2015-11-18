<?php

class ManagebannerController extends AdminController
{
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        public function actionHelp()
	{
		$this->render('help');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banners']))
		{
			$model->attributes=$_POST['Banners'];
			if($model->save())
				$this->redirect(array('/admin/manageBanner'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionAddCustomPhoto($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $aAllBannerSize = Banners::getHomeBannerSize();
        $aBannerSize = $aAllBannerSize[$model->place_holder_id];

		if(isset($_POST['Banners'])){

			$model->attributes=$_POST['Banners'];
            $model->image=CUploadedFile::getInstance($model,'image');

            $model->scenario = 'addCustomPhoto';
            if($model->validate()){

                $ext = $model->image->getExtensionName();

                $file_name = 'banner_'.$model->place_holder_id;

                $model->large_image =$file_name.'.'.$ext;
                $model->thumb_image ='thumb_'.$file_name.'.'.$ext;

    			if($model->save()){

                    $model->image=EUploadedImage::getInstance($model,'image');
                    //$model->image->maxWidth = $aBannerSize['width'];
                    //$model->image->maxHeight = $aBannerSize['height'];

                    /*$model->image->thumb = array(
                                                'maxWidth' => $aBannerSize['width'],
                                                'maxHeight' => $aBannerSize['height'],
                                                'dir' => 'thumbs',
                                                'prefix' => 'thumb_',
                                          );*/

                    $model->image->saveAs(Yii::getPathOfAlias('webroot').'/upload/admin/homeBanner/'.$file_name.'.'.$ext);

                    $thumb=new EPhpThumb();
                    $thumb->init();
                    $thumb->create(Yii::getPathOfAlias('webroot').'/upload/admin/homeBanner/'.$file_name.'.'.$ext)
                        ->resize($aBannerSize['width'],$aBannerSize['height'])
                        ->save(Yii::getPathOfAlias('webroot').'/upload/admin/homeBanner/thumbs/thumb_'.$file_name.'.'.$ext);

    				$this->redirect(array('/admin/manageBanner'));
                }
            }
		}

		$this->render('addCustomPhoto',array(
			'model'=>$model,
            'bannerSize'=> $aBannerSize,
		));
	}

    public function actionChooseModel($id ,$modelID = 0, $photoID = 0)
	{
        if($modelID == 0)//list all models
        {
            $model=new ManageModel('search');
    		$model->unsetAttributes();  // clear any default values
    		if(isset($_GET['ManageModel'])){
    			$model->attributes = $_GET['ManageModel'];
                /*if(isset($_GET['Banners']['model_nick']))
                    $model->model_nick = $_GET['Banners']['model_nick'];*/

            }
    		$this->render('chooseModel',array(
    			'model'=>$model,
                'bannerID'=>$id,
    		));
        }
        else{//list all model's photos

            if($photoID == 0)//list all model's photos
            {
                $model=new UserPictures('search');
                //$model = UserPictures::model()->findAll('user_id = 1');
        		$model->unsetAttributes();  // clear any default values
        		if(isset($_GET['UserPictures'])){
        			$model->attributes = $_GET['UserPictures'];
                    /*if(isset($_GET['Banners']['model_nick']))
                        $model->model_nick = $_GET['Banners']['model_nick'];*/

                }

                $criteria = new CDbCriteria();
                $criteria->condition="t.user_id = ".$modelID;

        		$this->render('chooseModelPhoto',array(
        			'model'=>$model,
                    'dataProvider'=>$model->search($criteria),
                    'bannerID'=>$id,
                    'modelID'=>$modelID,
        		));
            }else{ //view photo to crop

                $model=$this->loadModelUserPicture($photoID);
                $modelBanner=$this->loadModelBanners($id);
                $aAllBannerSize = Banners::getHomeBannerSize();
                $aBannerSize = $aAllBannerSize[$modelBanner->place_holder_id];

                $this->render('crop',array(
        			'model'=>$model,
                    'bannerID'=>$id,
                    'modelID'=>$modelID,
                    'photoID'=>$photoID,
                    'bannerSize'=>$aBannerSize,
        		));
            }

        }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
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
                    Yii::log('Invalid request. Please do not repeat this request again.');
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Banners('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Banners'])){
			$model->attributes = $_GET['Banners'];
            /*if(isset($_GET['Banners']['model_nick']))
                $model->model_nick = $_GET['Banners']['model_nick'];*/

        }
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Banners::model()->findByPk($id);
		if($model===null)
		{
                    Yii::log('The requested page does not exist.');
                    throw new CHttpException(404,'The requested page does not exist.');
                }
		return $model;
	}

    public function loadModelUserPicture($id)
	{
		$model=UserPictures::model()->findByPk($id);
		if($model===null)
		{
                    Yii::log('The requested page does not exist.');
                    throw new CHttpException(404,'The requested page does not exist.');
                }
		return $model;
	}

    public function loadModelBanners($id)
	{
		$model=Banners::model()->findByPk($id);
		if($model===null)
		{
                    Yii::log('The requested page does not exist.');
                    throw new CHttpException(404,'The requested page does not exist.');
                }
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='manage-banner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


     public function actionHandleCropZoom($bannerID = 0, $photoID = 0)
     {
        $model=$this->loadModel($bannerID);
        $file_name = 'banner_'.$model->place_holder_id;

        //copy original file of Model to Banner folder
        $modelPhoto=$this->loadModelUserPicture($photoID);

        $modelPhotoFile = Yii::getPathOfAlias('webroot').'/upload/member/photos/'.$modelPhoto->user_id.'/'.$modelPhoto->large_image;
        $bannerLargePhotoFile =  Yii::getPathOfAlias('webroot').'/upload/admin/homeBanner/'.$file_name.'.jpg';
        copy($modelPhotoFile, $bannerLargePhotoFile);

        //crop to thumbs folder
        Yii::import('ext.cropzoom.JCropZoom');
        $saveToFilePath = Yii::getPathOfAlias('webroot').'/upload/admin/homeBanner/thumbs/' .'thumb_'.$file_name;

        JCropZoom::getHandler()->process($saveToFilePath,true)->process($saveToFilePath.'.jpg');



        die('You has cropped this photo and saved to banner.');
    }
}
