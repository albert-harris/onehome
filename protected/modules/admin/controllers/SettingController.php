<?php

class SettingController extends AdminController {

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Setting'])) {
            $model->attributes = $_POST['Setting'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {        
//        Yii::app()->setting->setDbItem('total_coin', 0);
//        Yii::app()->setting->setDbItem('available_coin', 0);
//        Yii::app()->setting->setDbItem('total_coin', Yii::app()->params['total_coin'] + 1);
//        Yii::app()->setting->setDbItem('available_coin', Yii::app()->params['available_coin'] + 1);
//        exit;

        $this->layout = 'column1';
        $model = new SettingForm('index');
        $model->scenario = "updateSettings";
        $setting = Yii::app()->setting;
        if (isset($_POST['SettingForm'])) {
            $model->attributes = $_POST['SettingForm'];
            $model->image_watermark2 = CUploadedFile::getInstance($model,'image_watermark2');
            
            if ($model->validate()) {
                $setting->setDbItem('transportType', $model->transportType);
                foreach (SettingForm::$arrSmtp as $key => $value) {
                    $setting->setDbItem($value, $model->$value);
                }

                $setting->setDbItem('paypal_email_address', $model->paypal_email_address);

                $setting->setDbItem('paypalType', $model->paypalType);
                if ($model->paypalType == 'live') {
                    $setting->setDbItem('paypalURL', str_replace('sandbox.', '', SettingForm::$_paypalURL));
                } else { //paypalType = 'test'
                    if (strpos($model->paypalURL, 'sandbox.') == false) {
                        $setting->setDbItem('paypalURL', str_replace('paypal', 'sandbox.paypal', SettingForm::$_paypalURL));
                    }
                }
                foreach (SettingForm::$arrGeneral as $key => $value) {
                    $setting->setDbItem($value, $model->$value);
                }

                
                $file = CUploadedFile::getInstance($model,'image_watermark2');
                if($file !== null){
                    $baseImagePath = ROOT . '/upload/admin/settings/';
                    $name = preg_replace('/\.\w+$/', '', $file->name);
                    $newName = $name . '_' . time() . rand(1,10000).'.' . $file->extensionName;
                    Yii::log($newName, 'error');
                    if($file->saveAs($baseImagePath.$newName))
                    {
                        if(file_exists(ROOT . '/upload/admin/settings/'.Yii::app()->params['image_watermark']) && !empty(Yii::app()->params['image_watermark'])) 
                            @unlink(ROOT . '/upload/admin/settings/'.Yii::app()->params['image_watermark']);   
                        $model->image_watermark = $newName;
                        $setting->setDbItem('image_watermark', $newName);                      
                    }
                } else{
                    $model->image_watermark = $setting->getItem('image_watermark');
                    $setting->setDbItem('image_watermark',Yii::app()->params['image_watermark']);                    
                }                

                Yii::app()->user->setFlash('setting', 'Setting has been updated.');
                $this->refresh();
            }
        } else {
            $temp = $setting->getItem('transportType');
            if (!empty($temp)) {
                $model->transportType = $setting->getItem('transportType');
            } else if (!empty(Yii::app()->mail->transportType)) {
                $model->transportType = Yii::app()->mail->transportType;
            }

            foreach (SettingForm::$arrSmtp as $key => $value) {
                $temp = $setting->getItem($value);
                if (!empty($temp)) {
                    $model->$value = $setting->getItem($value);
                } else if (!empty(Yii::app()->mail->transportOptions[$key])) {
                    $model->$value = Yii::app()->mail->transportOptions[$key];
                }
            }

            foreach (SettingForm::$arrGeneral as $key => $value) {
                $temp = $setting->getItem($value);
                if (!empty($temp)) {
                    $model->$value = $setting->getItem($value);
                } else if (!empty(Yii::app()->mail->transportOptions[$key])) {
                    $model->$value = Yii::app()->mail->transportOptions[$key];
                }
            }

            $temp = $setting->getItem('paypalURL');
            if (!empty($temp)) {
                $model->paypalURL = $setting->getItem('paypalURL');
            } else if (!empty(Yii::app()->params['paypalURL'])) {
                $model->paypalURL = Yii::app()->params['paypalURL'];
            }

            $temp = $setting->getItem('paypalType');
            if (!empty($temp)) {
                $model->paypalType = $setting->getItem('paypalType');
            } else {
                $model->paypalType = 'live';
            }

            $temp = $setting->getItem('paypal_email_address');
            if (!empty($temp)) {
                $model->paypal_email_address = $setting->getItem('paypal_email_address');
            } else if (!empty(Yii::app()->params['paypal_email_address'])) {
                $model->paypal_email_address = Yii::app()->params['paypal_email_address'];
            }
            
             $temp = $setting->getItem('image_watermark');
            if (!empty($temp)) {
                $model->image_watermark = $setting->getItem('image_watermark');
            } else if(!empty(Yii::app()->params['image_watermark'])) {
                $model->image_watermark = Yii::app()->params['image_watermark'];
            }           

        }

        $this->render('index', array('model' => $model,));
    }

    public function actionMailchimp() {
        $this->layout = 'column1';
        $model = new SettingForm;
        $model->scenario = "updateMailchimpSetting";
        $setting = Yii::app()->setting;
        if (isset($_POST['SettingForm'])) {

            $model->attributes = $_POST['SettingForm'];
            if ($model->validate()) {
                $setting->setDbItem('mailchimp_title_groups', $model->mailchimp_title_groups);
                $setting->setDbItem('mailchimp_api_key', $model->mailchimp_api_key);
                $setting->setDbItem('mailchimp_list_id', $model->mailchimp_list_id);


                Yii::app()->user->setFlash('setting', 'Setting has been updated.');
            }
        } else {

            $model->mailchimp_title_groups = $setting->getItem('mailchimp_title_groups');


            $model->mailchimp_api_key = $setting->getItem('mailchimp_api_key');


            $model->mailchimp_list_id = $setting->getItem('mailchimp_list_id');
        }
        $this->render('mailchimp', array('model' => $model,));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Setting::model()->findByPk($id);
        if ($model === null) {
            Yii::log('The requested page does not exist.');
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'setting-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
