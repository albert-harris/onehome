<?php

class PagesController extends AdminController {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        try {
            $model = $this->loadModel($id);
            $content = $model->content;
            $pattern = '/[{]G[0-9]{3,6}[}]/';
            preg_match_all($pattern, $content, $matches);
            if (!empty($matches)) {
                for ($i = 0; $i < count($matches[0]); $i++) {
                    if (!empty($matches[0][$i])) {
                        $code = $matches[0][$i];
                        $gallery_id = Galleries::model()->find(array('condition' => 'code = "' . $code . '"'))->id;
                        if (!empty($gallery_id)) {
                            $photos = Photos::model()->findAll(array('condition' => 'gallery_id =' . $gallery_id));
                            $htmlReplace = ActiveRecord::getHtmlGalleryBox($photos);
                        }
                    }
                    $content = str_replace($code, $htmlReplace, $content);
                }
            }
            $this->render('view', array(
                'model' => $model,
                'content' => $content,
                'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        try {
            $model = new Pages('create');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Pages'])) {
                $model->attributes = $_POST['Pages'];
				$uploadFile = CUploadedFile::getInstance($model, 'banner');
                $model->parent_id = $_POST['Pages']['parent_id'];

                $model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
                $model->thumbFile = CUploadedFile::getInstance($model, 'thumbFile');

//                $model->show_footer = $_POST['Pages']['show_footer'];
//                $model->show_home_page = $_POST['Pages']['show_home_page'];
//                $model->short_content = $_POST['Pages']['short_content'];
//                $model->order = $_POST['Pages']['order'];
                $model->scenario = 'create';
                $model->status = STATUS_ACTIVE;

                if (isset($_POST['ck'])) {
                    $model->show_desc = 1;
                } else {
                    $model->show_desc = 0;
                }

//                if ($model->show_home_page == 0) {
//                    $model->thumbFile = 'qwertyuiopasdfghjklzxcvbnm.jpg';
//                }

                if ($model->validate()) {
					if ($uploadFile) {	// save new image to disk
						$model->saveBanner($uploadFile);
					}

                    //For banner
                    if (!empty($model->imageFile)) {
                        //Checked size of banner
                        $errorBanner = false;
                        if (MyFunctionCustom::bannerIsSmall($model->imageFile->getTempName(), Pages::$aSizeBanner['960x252']['width'], Pages::$aSizeBanner['960x252']['height']))
                            $errorBanner = true;

                        //Checked size of banner
                        if ($errorBanner)
                            $model->addError('imageFile', 'Banner file size need larger than 960x252.');
                        else {
                            $ext_banner = $model->imageFile->getExtensionName();
                            $timestamp_banner = time();
                            $model->featured_image = $timestamp_banner . '.' . $ext_banner;
                        }
                    }

                    //For home page
                    if (!empty($model->thumbFile) && $model->thumbFile != "qwertyuiopasdfghjklzxcvbnm.jpg") {
                        //Checked size of banner
                        $errorBanner = false;
                        if (MyFunctionCustom::bannerEqual($model->thumbFile->getTempName(), Pages::$aSizeHomePage['204x94']['width'], Pages::$aSizeHomePage['204x94']['height']))
                            $errorBanner = true;

                        //Checked size of banner
                        if ($errorBanner)
                            $model->addError('thumbFile', 'Thumb file size must be equal 204x94.');
                        else {
                            $ext_home_page = $model->thumbFile->getExtensionName();
                            $timestamp_home_page = time();
                            $model->thumb_image = $timestamp_home_page . '.' . $ext_home_page;
                        }
                    }
                    if (!$model->hasErrors()) {
                        if ($model->save()) {
                            if (!empty($model->imageFile)) {
                                $ImageProcessing = new ImageProcessing();
                                $ImageProcessing->createDirectoryByPath('upload/admin/' . Pages::$folderUpload . '/' . $model->id);
                                $model->imageFile->saveAs(YII_UPLOAD_DIR . '/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $model->featured_image);

                                $model->resizeBanner();
                            }

                            if (!empty($model->thumbFile) && $model->thumbFile != "qwertyuiopasdfghjklzxcvbnm.jpg") {
                                $ImageProcessing = new ImageProcessing();
                                $ImageProcessing->createDirectoryByPath('upload/admin/' . Pages::$folderUpload . '/' . $model->id);
                                $model->thumbFile->saveAs(YII_UPLOAD_DIR . '/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $model->thumb_image);

                                $model->resizeHomePages();
                            }

                            $this->redirect(array('view', 'id' => $model->id));
                        }
                    }
                }
            }
            $this->render('create', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        } catch (exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e->getMessage(), true));
        }
    }

    public function actionImagepaging() {
        if (isset($_GET['image_title'])) {
            if (isset($_GET['user_id']))
                $user_id_image = $_GET['user_id'];
            else
                $user_id_image = Yii::app()->user->id;

            $medias_paging = Medias::imagePaging($_GET['image_title'], $user_id_image, (isset($_GET['c_page']) && $_GET['c_page'] != null && $_GET['c_page'] != 0) ? $_GET['c_page'] : null);

            $list = $medias_paging[0];
            $pages = $medias_paging[1];

            $this->layout = "";
            $this->render('imagepaging', array('list' => $list, 'pages' => $pages,
                'user_id_image' => $user_id_image));
        }
    }

    public function actionImageurl() {
        if (isset($_GET['url'])) {
            $ext = substr($_GET['url'], -4);
            if (!in_array($ext, array(
                        '.jpg',
                        '.png',
                        '.gif',
                        '.JPG',
                        '.PNG',
                        '.GIF',
                    ))) {
                echo 'Wrong url!.';
                return;
            }

            $name = end(explode("/", $_GET['url']));
            $sourcecode = Helper::GetImageFromUrl($_GET['url']);

            if (isset($_GET['user_id']))
                $user_id_image = $_GET['user_id'];
            else
                $user_id_image = Yii::app()->user->id;

            $media = new Medias;
            $fileName = $media->getImageName($name);

            //check image file
            $checkImage = $media->saveImageUrl($fileName, $sourcecode, $user_id_image);
            if ($checkImage == null) {
                echo '<div class="errorMessage">Invalid url!</div>';
                return;
            }

            $media->url = $fileName;
            $media->type = 'image-upload';
            $media->title = substr($fileName, 25);
            if ($media->save()) {
                $this->layout = "";
                $this->render('imageupload', array('model' => $media));
            } else
                echo '<div class="errorMessage">Not save!</div>';
        }
        return;
    }

    public function actionImageupload() {
        $model = new Medias('create');
        $uploadedFile = CUploadedFile::getInstanceByName('uploadedfile');
        if ($uploadedFile != null) {
            $model->real_name = $uploadedFile;
            $fileName = $model->getImageName($uploadedFile);
            $model->url = $fileName;
            $model->type = 'image-upload';
            $model->title = substr($fileName, 25);
        } else {
            return;
        }

        if ($model->save()) {
            $model->saveImage($fileName, $uploadedFile);
            $this->layout = "";
            $this->render('imageupload', array('model' => $model));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        try {
            $model = Pages::model()->findbyPk($id);
            $model->scenario = 'update';

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            $old_image = $model->featured_image;
            $old_home_page = $model->thumb_image;

            if (isset($_POST['Pages'])) {
				$oldImg = $model->banner;
                $model->attributes = $_POST['Pages'];
				$uploadFile = CUploadedFile::getInstance($model, 'banner');
                $model->parent_id = $_POST['Pages']['parent_id'];

//                $model->show_footer = $_POST['Pages']['show_footer'];
//                $model->show_home_page = $_POST['Pages']['show_home_page'];
//                $model->short_content = $_POST['Pages']['short_content'];
//                $model->order = $_POST['Pages']['order'];

                if (isset($_POST['ck'])) {
                    $model->show_desc = 1;
                } else {
                    $model->show_desc = 0;
                }
                $isEmptyFileInput = empty($_FILES["Pages"]["name"]["imageFile"]);
                $new_banner = '';
                if (!$isEmptyFileInput) { //has file input
                    $model->imageFile = CUploadedFile::getInstance($model, 'imageFile');
                }

                $isEmptyHomePageInput = empty($_FILES["Pages"]["name"]["thumbFile"]);
                $new_home_page = '';
                if (!$isEmptyHomePageInput) { //has file input
                    $model->thumbFile = CUploadedFile::getInstance($model, 'thumbFile');
                }

                if ($model->validate()) {
					if ($uploadFile) {	// remove old image and save new image to disk
						$model->removeBanner($oldImg);
						$model->saveBanner($uploadFile);
					} else {
						$model->banner = $oldImg; // keep old image
					}
					
                    if (!$isEmptyFileInput) { //has file input
                        $errorBanner = false;
                        if (MyFunctionCustom::bannerIsSmall($model->imageFile->getTempName(), Pages::$aSizeBanner['960x252']['width'], Pages::$aSizeBanner['960x252']['height']))
                            $errorBanner = true;

                        //Checked size of banner
                        if ($errorBanner)
                            $model->addError('imageFile', 'Banner file size need larger than 960x252.');
                        else {
                            $ext_banner = $model->imageFile->getExtensionName();
                            $timestamp_banner = time();
                            $new_banner = $timestamp_banner . '.' . $ext_banner;
                        }
                    }
                    if (!$isEmptyHomePageInput) { //has file input
                        //Checked size of banner
                        $errorBanner = false;
                        if (MyFunctionCustom::bannerEqual($model->thumbFile->getTempName(), Pages::$aSizeHomePage['204x94']['width'], Pages::$aSizeHomePage['204x94']['height']))
                            $errorBanner = true;

                        //Checked size of banner
                        if ($errorBanner)
                            $model->addError('thumbFile', 'Thumb file size must be equal 204x94.');
                        else {
                            $ext_home_page = $model->thumbFile->getExtensionName();
                            $timestamp_home_page = time();
                            $model->thumb_image = $timestamp_home_page . '.' . $ext_home_page;
                        }
                    }

                    if (!$model->hasErrors()) {

                        if (isset($_POST['delete_current_image']) && $_POST['delete_current_image'] == 'on') {
                            Pages::deleteImage($model);
                            $model->featured_image = NULL;
                            if (!$isEmptyFileInput) {
                                $ImageProcessing = new ImageProcessing();
                                $ImageProcessing->delete('upload/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $old_image);

                                $ImageProcessing->createDirectoryByPath('upload/admin/' . Pages::$folderUpload . '/' . $model->id);
                                $model->imageFile->saveAs(YII_UPLOAD_DIR . '/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $new_banner);

                                $model->featured_image = $new_banner;
                                $model->resizeBanner();
                            }
                            $model->update();
                        } else {
                            if ($new_banner != NULL) {
                                $model->featured_image = $new_banner;
                            }

                            if ($model->update()) {
                                if (!$isEmptyFileInput) {
                                    $ImageProcessing = new ImageProcessing();
                                    $ImageProcessing->delete('upload/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $old_image);

                                    $ImageProcessing->createDirectoryByPath('upload/admin/' . Pages::$folderUpload . '/' . $model->id);
                                    $model->imageFile->saveAs(YII_UPLOAD_DIR . '/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $model->featured_image);
                                    $model->resizeBanner();
                                }
                            }
                        }

                        //For home page
                        if (isset($_POST['delete_current_image_home_page']) && $_POST['delete_current_image_home_page'] == 'on') {
                            Pages::deleteImage($model, true);
                            $model->thumb_image = NULL;
                            if (!$isEmptyHomePageInput) {
                                $ImageProcessing = new ImageProcessing();
                                $ImageProcessing->delete('upload/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $old_home_page);

                                $ImageProcessing->createDirectoryByPath('upload/admin/' . Pages::$folderUpload . '/' . $model->id);
                                $model->thumbFile->saveAs(YII_UPLOAD_DIR . '/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $new_home_page);

                                $model->thumb_image = $new_home_page;
                                $model->resizeHomePages();
                            }
                            $model->update();
                        } else {
                            if ($new_home_page != NULL) {
                                $model->thumb_image = $new_home_page;
                            }

                            if ($model->update()) {
                                if (!$isEmptyHomePageInput) {
                                    $ImageProcessing = new ImageProcessing();
                                    $ImageProcessing->delete('upload/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $old_home_page);

                                    $ImageProcessing->createDirectoryByPath('upload/admin/' . Pages::$folderUpload . '/' . $model->id);
                                    $model->thumbFile->saveAs(YII_UPLOAD_DIR . '/admin/' . Pages::$folderUpload . '/' . $model->id . '/' . $model->thumb_image);
                                    $model->resizeHomePages();
                                }
                            }
                        }
                        $this->redirect(array('view', 'id' => $model->id));
                    }
                }
            }

            $this->render('update', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        } catch (exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }


    public function actionDelete($id) {
        try {
            if (Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
                if ($model = $this->loadModel($id)) {
                    if ($model->delete()) {
                        Yii::log("Delete record " . print_r($model->attributes, true), 'info');
                    }
                }

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if (!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
            else {
                Yii::log("Invalid request. Please do not repeat this request again.");
                throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }


    public function actionIndex() {
        try {
            $model = new Pages('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Pages']))
                $model->attributes = $_GET['Pages'];

            $this->render('index', array(
                'model' => $model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }


    public function loadModel($id) {
        if (!is_numeric($id))
            throw new CHttpException(404, 'The requested page does not exist.');
        try {
            $model = Pages::model()->findByPk($id);
            if ($model === null) {
                Yii::log("The requested page does not exist.");
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            return $model;
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }


    protected function performAjaxValidation($model) {
        try {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'pages-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }


    public function actionListBanner($id) {
        try {
            $model = new Pages('search');
            $pageParent = $this->loadModel($id);
            $imageCount = Pages::countImagesWithIdparent($id);
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['ImagePage']))
                $model->attributes = $_GET['ImagePage'];
            $model->parent = $id;

            $this->render('medias/index', array(
                'model' => $model, 'actions' => $this->listActionsCanAccess,
                'pageParent' => $pageParent,
                'imageCount' => $imageCount
            ));
        } catch (exception $e) {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

}