<?php

class PostsController extends AdminController
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $content = $model->content;
        $pattern = '/[{]G[0-9]{3,6}[}]/';
        preg_match_all($pattern, $content, $matches);
        if(!empty($matches)){
            for($i=0;$i<count($matches[0]);$i++ ){
                if(!empty($matches[0][$i])){
                    $code = $matches[0][$i];
                    $gallery_id = Galleries::model()->find(array('condition'=>'code = "'.$code.'"'))->id;
                    if(!empty($gallery_id)){
                        $photos = Photos::model()->findAll(array('condition'=>'gallery_id ='.$gallery_id));
                        $htmlReplace = ActiveRecord::getHtmlGalleryBox($photos);
                    }
                }
                $content = str_replace($code, $htmlReplace, $content);
            }
        }
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'content' => $content,
            'actions' => $this->listActionsCanAccess,
            ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Posts('create');
        $mesg = "";

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        //prepare tags most used
        $tags_most_used = TagsPosts::mostTagsUsed();

        //paging media
        $medias_paging = Medias::getUserMedias();
        $list = $medias_paging[0];
        $pages = $medias_paging[1];

        

        if (isset($_POST['Posts'])) {
            $model->attributes = $_POST['Posts'];
            $model->created = date('Y-m-d h:i:s');
            
                if (isset($_POST['featured_image_name'])) {
                    $model->featured_image = $_POST['featured_image_name'];
                }

            if ($model->save()) {
                //add category to posts
                if (isset($_POST['Categories'])) {
                    foreach ($_POST['Categories'] as $key => $value) {
                        $category_post = new CategoriesPosts;
                        $category_post->post_id = $model->id;
                        $category_post->category_id = $key;
                        $category_post->save();
                    }
                }

                //add tags to posts
                if (isset($_POST['Tags'])) {
                    TagsPosts::insertTagsPost($_POST['Tags'], $model->id);
                }

                $this->redirect(array('view', 'id' => $model->id));
            }

        }

        $this->render('create', array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'tags_most_used' => $tags_most_used,
            'mesg' => $mesg,
            'list' => $list,
            'pages' => $pages,
            ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $mesg = "";

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        //prepare tags most used
        $tags_most_used = TagsPosts::mostTagsUsed();

        //paging media
        $medias_paging = Medias::getUserMedias();
        $list = $medias_paging[0];
        $pages = $medias_paging[1];

        if (isset($_POST['Posts'])) {
            $model->attributes = $_POST['Posts'];
            $model->modified = date('Y-m-d h:i:s');
            
                if (isset($_POST['featured_image_name'])) {
                    $model->featured_image = $_POST['featured_image_name'];
                }

            if ($model->save()) {
                //add category to posts
                CategoriesPosts::deleteCategory($model->id);
                if (isset($_POST['Categories'])) {
                    foreach ($_POST['Categories'] as $key => $value) {
                        $category_post = new CategoriesPosts;
                        $category_post->post_id = $model->id;
                        $category_post->category_id = $key;
                        $category_post->save();
                    }
                }

                //add tags to posts
                TagsPosts::deleteTagsPost($model->id);
                if (isset($_POST['Tags'])) {
                    TagsPosts::insertTagsPost($_POST['Tags'], $model->id);
                }

                $this->redirect(array('view', 'id' => $model->id));
            }

        }

        $this->render('update', array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'tags_most_used' => $tags_most_used,
            'mesg' => $mesg,
            'list' => $list,
            'pages' => $pages,
            ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            if ($model = $this->loadModel($id)) {
                if ($model->delete()) {
                    Yii::log("Delete record " . print_r($model->attributes, true), 'info');
                    TagsPosts::deleteTagsPost($id);
                    CategoriesPosts::deleteCategory($id);
                }
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        } else {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400,
                'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new Posts('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Posts']))
            $model->attributes = $_GET['Posts'];

        $this->render('index', array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        if (!is_numeric($id))
            throw new CHttpException(404, 'The requested page does not exist.');
        $model = Posts::model()->findByPk((int)$id);

        if ($model === null) {
            Yii::log("The requested page does not exist.");
            throw new CHttpException(404, 'The requested page does not exist.');
        } else
            return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'posts-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAddCategory()
    {
        if (isset($_POST)) {
            $category = new Categories;
            $category->title = $_POST['category_name'];
            $category->parent_id = $_POST['parent_id'];
            $category->layout_id = 1;
            $category->save();

            echo Categories::getCheckBoxList();
        }
    }

    public function actionGetDropdownCategory()
    {
        echo Categories::getDropDownList('Categories[parent_id]', 'Menus_parent_id', '', true);
    }
}
