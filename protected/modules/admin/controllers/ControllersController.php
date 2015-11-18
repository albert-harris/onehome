<?php

class ControllersController extends AdminController {

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Controllers('create');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Controllers'])) {
            //Check controller name, action name - PDQuang
            if ($_POST['Controllers']['module_name'] == null) {
                $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Controllers']['controller_name'], $_POST['Controllers']['actions']);
            } else {
                $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Controllers']['controller_name'], $_POST['Controllers']['actions'], $_POST['Controllers']['module_name']);
            }

            if (!$checkController) {
                Yii::log('Controller, Module or Actions is wrong!');
                throw new CHttpException('Controller, Module or Actions is wrong!');
            }

            $model->attributes = $_POST['Controllers'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
//        echo Yii::app()->session['roles'];
        if (!isset(Yii::app()->session['roles']) || !isset(Yii::app()->session['type'])) {
            Yii::log("You must choose roles first!");
            throw new CHttpException("You must choose roles first!");
            return;
        }
        $roles = Yii::app()->session['roles'];
        if (Yii::app()->session['type'] == 'ActionsUsers') {
            $user = Users::model()->find("username like '$roles'");
            if (!$user) {
                Yii::log("Wrong username!");
                throw new CHttpException("Wrong username!");
                return;
            }
        }

        $model = $this->loadModel($id);
        $array_action = array_map('trim', explode(",", trim($model->actions)));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Actions'])) {
            if (Yii::app()->session['type'] == 'ActionsUsers') {
                $model->addUserRoles($_POST['Actions']);
                $this->redirect(array('user'));
            } else {
                $model->addGroupRoles($_POST['Actions']);
                $this->redirect(array('group'));
            }
        }

        $this->render('update', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess,
            'actions_controller' => $array_action,
        ));
    }

    public function actionEdit($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Controllers'])) {
            //Check controller name, action name - PDQuang
            if ($_POST['Controllers']['module_name'] == null) {
                $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Controllers']['controller_name'], $_POST['Controllers']['actions']);
            } else {
                $checkController = ControllerActionsName::checkControllerActionsExist($_POST['Controllers']['controller_name'], $_POST['Controllers']['actions'], $_POST['Controllers']['module_name']);
            }

            if (!$checkController) {
                Yii::log('Controller, Module or Actions is wrong!');
                throw new CHttpException('Controller, Module or Actions is wrong!');
            }

            $model->attributes = $_POST['Controllers'];
            
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('edit', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            if ($model = $this->loadModel($id)) {
                if ($model->delete())
                    Yii::log("Delete record " . print_r($model->attributes, true), 'info');
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else {
            Yii::log("Invalid request. Please do not repeat this request again.");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Controllers('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Controllers']))
            $model->attributes = $_GET['Controllers'];

        $this->render('index', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess,
        ));
    }

    public function actionGroup() {
        $model = new Controllers('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Controllers']))
            $model->attributes = $_GET['Controllers'];
        if (!isset($_GET['ajax'])) {
            Yii::app()->session['type'] = 'ActionsRoles';
            Yii::app()->session['roles'] = 1;
        }

        $this->render('group', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess,
        ));
    }

    public function actionUser() {
        $model = new Controllers('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Controllers']))
            $model->attributes = $_GET['Controllers'];

        $this->render('user', array(
            'model' => $model, 'actions' => $this->listActionsCanAccess,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Controllers::model()->findByPk($id);
        if ($model === null) {
            Yii::log("The requested page does not exist.");
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'controllers-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
