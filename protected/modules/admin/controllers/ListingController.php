<?php

/**
 * DTOAN
 * ListingController
 * Manager listing for user Agent
 * Date 21-03-2014
 */
class ListingController extends AdminController {

    public $userID;

    public function init() {
        parent::init();
        $this->userID = Yii::app()->user->id;
//      $this->userID = 204;
    }

    public function actionIndex($status = null, $listing_type = null, $pro_type = NULL) {
//        Listing::SqlUpdateInfo();
        $model = new Listing();
        $agent = '';
        if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
            $model->user_id = (int) $_GET['user_id'];
            $agent = Users::model()->findByPk($model->user_id);
        }

        //status
        if (empty($status))
            $model->status_listing = STATUS_LISTING_ACTIVE;
        else
            $model->status_listing = $status;

        //listing type
        if (!empty($listing_type) && is_numeric($listing_type) && ($listing_type >= 1 && $listing_type <= 2))
            $model->listing_type = $listing_type;

        //property type
        if (!empty($pro_type) && is_numeric($pro_type))
            $model->property_type_1 = $pro_type;

        $view = Listing::getViewStatus($status, STATUS_LISTING_ACTIVE);
        
        if(isset($_GET['Listing'])){
            $model->attributes=$_GET['Listing'];
        }
        $this->render("index_$view", array('model' => $model, 'agent' => $agent, 'actions' => $this->listActionsCanAccess,));
    }
    
    /**
     * @Author: ANH DUNG Jun 26, 2014
     * @Todo: re set scenario 
     * @Param: $model
     */    
    public function setScenarioStep1($model){
        $scenario = Listing::getScenarioOfListing($model);
        if(!empty($scenario))
            $model->scenario = $scenario;
    }    
    
    /*
     * STEP 1
     */
    public function actionCreate() {
        if (!isset($_GET['id'])) {
            $model = new Listing('create_listing_step1_admin');
        } else {
            $model = $this->loadModel((int) $_GET['id']);
            $model->scenario = 'create_listing_step1_admin';
        }
        $model->listing_type_transaction = ProTransactionsPropertyDetail::VAR_INDIVIDUAL;

        if (isset($_POST['Listing'])) {
            $model->attributes = $_POST['Listing'];
            $this->setScenarioStep1($model);
            if ($model->validate()) {
                $model->user_id = $model->user_agent_id;
                
                $model->status_approve = 0;                 
                $model->status_listing = ($model->isNewRecord) ? STATUS_LISTING_DRAFT : $model->status_listing;
                $model->status_tmp = 1;
                $model->status = 1;
                if ($model->isNewRecord) {
                    $model->current_step_next = 2;
                } else {
                    $model->current_step_next = ($model->current_step_next == 1) ? 2 : $model->current_step_next;
                }

                $model->save();
                if (isset($_POST['save_exit'])) {
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing', array('status' => $model->status_listing)));
                } else {
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing/extradetail', array('id' => $model->id)));
                }
            } else {
                $error = $model->getErrors();
                if (isset($error['unit_to'])) {
                    $model->addError('unit_from', $error['unit_to'][0]);
                }
                if (isset($model->user_agent_id) && is_numeric($model->user_agent_id)) {
                    $mUser = Users::model()->findByPk($model->user_agent_id);
                    if ($mUser) {
                        $typeMember = ($mUser->role_id == ROLE_LANDLORD) ? '[ Landlord ]' : '[ Agent ]';
                        $model->user_member = $mUser->first_name . ' ' . $mUser->last_name . $typeMember;
                        $model->user_agent_nirc = $mUser->nric_passportno_roc;
                    }
                }
            }
        } else {
            if (!empty($model->price)) {
                $model->price = Listing::getformatPrice($model->price);
            }
            if (!empty($model->office_bkank_valuation)) {
                $model->office_bkank_valuation = Listing::getformatPrice($model->office_bkank_valuation);
            }
            if (!$model->isNewRecord) {
                if (isset($model->user->first_name)) {
//                    $typeMember = ($model->user->role_id == ROLE_LANDLORD) ? '[ Landlord ]' : '[ Agent ]';
                    $typeMember = '';
                    $model->user_agent_id = $model->user->id;
                    $model->user_member = $model->user->first_name . ' ' . $model->user->last_name . $typeMember;
                    $model->user_agent_nirc = $model->user->nric_passportno_roc;
                }
                if($model->listing_type_transaction==2 &&  $model->dnc_expiry_date !=''  ){
                    $model->dnc_expiry_date= date('d-m-Y',  strtotime($model->dnc_expiry_date));
                }else{
                     $model->dnc_expiry_date =null;
                }
            }
        }

        Listing::getCurrentStep($model, 'admin', 1);

        $this->render('create', array('model' => $model, 'view' => 'basic_information', 'actions' => $this->listActionsCanAccess));
    }

    /*
     * STEP 2
     */

    public function actionExtradetail($id) {
        $model = $this->loadModel($id);
        if (empty($model)) {
            $this->redirect(Yii::app()->createAbsoluteUrl('site/index'));
        }
        $model->scenario = 'extradetail_step2_for_sale';
        if($model->listing_type==Listing::FOR_RENT){
            $model->scenario = 'extradetail_step2_for_rent';
        }

        if (isset($_POST['Listing'])) {
            $model->attributes = $_POST['Listing'];
            if (trim($model->listing_description) == '<br>' || trim($model->listing_description) == '<br/>') {
                $model->listing_description = NULL;
            }
            if ($model->validate()) {
                $model->special_feature_json = json_encode($model->special_feature_json);
                $model->fixtures_fittings_json = json_encode($model->fixtures_fittings_json);
                $model->outdoor_indoor_space_json = json_encode($model->outdoor_indoor_space_json);
                $model->furnishing_included_json = json_encode($model->furnishing_included_json);
                if ($model->status_listing != STATUS_LISTING_ACTIVE) {
                    if ($model->current_step_next == 1) {
                        $model->current_step_next = 2;
                    } else {
                        if ($model->current_step_next == 2) {
                            $model->current_step_next = 3;
                        }
                    }
                }

                if ($model->save()) {
                    Listing::saveTableStep2($model, 'special_feature_json', 'ProListingSpecialFeature', 'special_feature_id');
                    Listing::saveTableStep2($model, 'fixtures_fittings_json', 'ProListingFixturesFittings', 'fixtures_fittings_id');
                    Listing::saveTableStep2($model, 'outdoor_indoor_space_json', 'ProListingOutdoorIndoorSpace', 'outdoor_indoor_space_id');
                    Listing::saveTableStep2($model, 'furnishing_included_json', 'ProListingFurnishingIncluded', 'furnishing_included_id');
                    if (isset($_POST['save_exit'])) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing', array('status' => $model->status_listing)));
                    } else {
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing/managephotos', array('id' => $model->id)));
                    }
                }
            }
        } else {
            $model->special_feature_json = json_decode($model->special_feature_json);
            $model->fixtures_fittings_json = json_decode($model->fixtures_fittings_json);
            $model->outdoor_indoor_space_json = json_decode($model->outdoor_indoor_space_json);
            $model->furnishing_included_json = json_decode($model->furnishing_included_json);
        }
        Listing::getCurrentStep($model, 'admin', 2);

        $this->render('create', array('model' => $model, 'view' => 'extra_detail', 'actions' => $this->listActionsCanAccess));
    }

    /*
     * step 3
     */

    public function actionManagephotos($id) {
        $model = $this->loadModel($id);
        $messagePhoto = NULL;
        if (empty($model)) {
            $this->redirect(Yii::app()->createAbsoluteUrl('admin/site/index'));
        }
        if (isset($_POST) && count($_POST) > 0) {
            //chekcPhoto
            $totalImgupload = ProListingPhotos::model()->countByAttributes(array('listing_id' => $id));
//            if ($totalImgupload > 0) { // ANH DUNG CLOSE AUG 28, 2014
                if (isset($_POST['releated']))
                    $model->listing_releated = json_encode($_POST['releated']);
                //back
                if (isset($_POST['back'])) {
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing/extradetail', array('id' => $model->id)));
                }

                if (isset($_POST['save_exit']) || isset($_POST['next']) && $model->status_listing != STATUS_LISTING_ACTIVE) {

                    if ($model->current_step_next == 2) {
                        $model->current_step_next = 3;
                    } else {
                        if ($model->current_step_next == 3) {
                            $model->current_step_next = 4;
                        }
                    }
                    if ($model->save()) {
                        ProListingReleated::saveListingReleatedWithListingid($model);
                    }
                }

                //save & exit
                if (isset($_POST['save_exit'])) {
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing', array('status' => $model->status_listing)));
                }
                //next
                if (isset($_POST['next'])) {
                    if ($model->save()) {
                        ProListingReleated::saveListingReleatedWithListingid($model);
                    }
                    $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing/confrimations', array('id' => $model->id)));
                }
//            } else { // ANH DUNG CLOSE AUG 28, 2014
//                $messagePhoto = 'Please upload photos';
//            }
        }

        Listing::getCurrentStep($model, 'admin', 3);

        //photo
        $photo = new ProListingPhotos();
        $photo->listing_id = $model->id;

        //cea form
        $cea = new ProListingUploadCea();
        $cea->listing_id = $model->id;

        $this->render('create', array(
            'model' => $model,
            'view' => 'manage_photos',
            'arrOrther' => array(
                'photo' => $photo->search(),
                'cea' => $cea->search(),
                'messagePhoto' => $messagePhoto
            ),
            'actions' => $this->listActionsCanAccess
        ));
    }

    /*
     * step 4
     */

    public function actionConfrimations($id) {
        $model = $this->loadModel($id);
        if (empty($model)) {
            $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing/index'));
        }
        $model->scenario = 'listing_step4';

        if (isset($_POST['Listing'])) {
            $model->attributes = $_POST['Listing'];
            if ($model->validate()) {
                $model->activate_listing_options = json_encode($model->activate_listing_options);
                $model->remark = strip_tags($model->remark);

                if ($model->current_step_next == 3) {
                    $model->current_step_next = 4;
                } else {
                    if ($model->current_step_next == 4) {
                        $model->current_step_next = 4;
                    }
                }

                if (isset($_POST['next'])) {
                    // ANH DUNG CLOSE JUN 14, 2014
//                    $model->status_listing = ($model->status_listing == STATUS_LISTING_DRAFT) ? STATUS_LISTING_PENDING : $model->status_listing;
//                    $model->status_approve = ($model->status_approve == STATUS_PEDING_APPROVE) ? STATUS_PEDING_APPROVE : $model->status_approve;
                    Listing::SetActiveListing($model);
                }

                if (isset($_POST['save_exit'])) {
                    $model->status_listing = ($model->status_listing == STATUS_LISTING_DRAFT) ? STATUS_LISTING_DRAFT : $model->status_listing;
                }

                if ($model->save()) {
                    //back
                    if (isset($_POST['back'])) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing/managephotos', array('id' => $model->id)));
                    }
                    //save & exit
                    if (isset($_POST['save_exit'])) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing', array('status' => $model->status_listing)));
                    }
                    //next
                    if (isset($_POST['next'])) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/listing', array('status' => $model->status_listing)));
                    }
                }
            }
        } else {
            if (!empty($model->activate_listing_options)) {
                $model->activate_listing_options = json_decode($model->activate_listing_options);
            }
        }

        Listing::getCurrentStep($model, 'admin', 4);

        $imageDefault = Listing::getDefaultImgListing($model->id, 'image');
        $this->render('create', array(
            'model' => $model,
            'view' => 'confrimations',
            'arrOrther' => array('imageDefault' => $imageDefault),
            'actions' => $this->listActionsCanAccess
        ));
    }

    public function actionAutocomplete() {
        $this->layout = false;
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.property_name_or_address', ActiveRecord::safeField($_GET['term']), true);
        $criteria->compare('t.status', STATUS_ACTIVE);
//        $criteria->compare('t.user_id', $this->userID);
//        $criteria->limit = 20;

        $models = Listing::model()->findAll($criteria);
        $returnVal = array();
        foreach ($models as $model) {
            $returnVal[] = array(
                'label' => $model->property_name_or_address,
                'value' => $model->property_name_or_address,
                'Listing_property_type_1' => $model->property_type_1,
                'Listing_property_type_2' => $model->property_type_2,
                'Listing_unit_from' => $model->unit_from,
                'Listing_unit_to' => $model->unit_to,
                'Listing_price' => Listing::getformatPrice($model->price),
                'Listing_office_bkank_valuation' => Listing::getformatPrice($model->office_bkank_valuation),
                'Listing_of_bedroom' => $model->of_bedroom,
                'Listing_floor_area' => $model->floor_area,
                'Listing_hdb_town_estate' => $model->floor_area,
                'Listing_developer' => $model->developer,
                'Listing_tenure' => $model->tenure,
                'Listing_field' => $model->postal_code,
                'Listing_postal_code' => $model->postal_code,
                'Listing_postal_code_xy' => $model->postal_code_xy,
            );
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();
    }

    public function actionAutocomplete_agent() {
        $this->layout = false;
        $criteria = new CDbCriteria();
//      $criteria->addSearchCondition('t.nric_passportno_roc', ActiveRecord::safeField($_GET['term']), true);
        $criteria->compare('CONCAT(t.first_name,t.last_name)', trim($_GET['term']), true);
//        $criteria->addCondition("t.nric_passportno_roc like '" . trim($_GET['term']) . "%' ");
        $criteria->compare('t.status', STATUS_ACTIVE);
//        $criteria->compare('t.role_id', array(ROLE_AGENT, ROLE_LANDLORD));
        $criteria->addInCondition('t.role_id', array(ROLE_AGENT));

        $models = Users::model()->findAll($criteria);
        $returnVal = array();

        foreach ($models as $model) {
//            $typeMember = ($model->role_id == ROLE_LANDLORD) ? '[ Landlord ]' : '[ Agent ]';
            $typeMember = '';

            $returnVal[] = array(
                'label' => $model->first_name . ' ' . $model->last_name . $typeMember,
                'value' => $model->first_name . ' ' . $model->last_name . $typeMember,
                'nirc' => $model->nric_passportno_roc,
                'id' => $model->id,
            );
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();
    }

    public function loadModel($id) {
        $model = Listing::model()->findByPk($id);
        if ($model === null) {
            Yii::log("The requested page does not exist.");
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

/**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: for upload multiphoto listing by ajax 
     * @Param: $id listing
     */
    public function actionAjax_upload_photo($id) {
        try{
            set_time_limit(7200);
            $model = $this->loadModel($id);
            if ($model) {
                Listing::SavePhotoListing($model);
            }
            //photo
            $photo = new ProListingPhotos();
            $photo->listing_id = $model->id;
            //cea form
            $cea = new ProListingUploadCea();
            $cea->listing_id = $model->id;
            $messagePhoto = '';
            $this->render('create', array('model' => $model, 
                'view' => 'manage_photos',
                'actions' => $this->listActionsCanAccess,
                'arrOrther' => array('photo' => $photo->search(),
                                    'cea' => $cea->search(),
                                    'messagePhoto'=>$messagePhoto)
                ));
        } catch (Exception $ex) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }    
    
    public function actionAjax_upload_photo_by_ku_toan($id) {
        $model = $this->loadModel($id);
        if ($model) {
            if (isset($_FILES['Listing'])) {
                $totalImgupload = ProListingPhotos::model()->countByAttributes(array('listing_id' => $id));
                if (!ProListingPhotos::checkLimitFileUpload($id)) {
                    die("limit");
                }

//                $error = Listing::model()->validateFileUpload($_FILES['Listing'], 'image_photo', 'image');
//                if (empty($error)) {
//                    $type = explode("/", $_FILES['Listing']["type"]['image_photo'][0]);
//                    $name = date('d-m-Y h-i-s') . "." . $type[1];
//
//                    $photo = new ProListingPhotos();
//                    $photo->listing_id = $id;
//                    $photo->image = $name;
//                    $photo->created_date = date('Y-m-d h:i:s');
//                    $photo->default = ($totalImgupload == 0) ? 1 : 0;
//                    if ($photo->save()) {
//                        //create folder
//                        $ImageProcessing = new ImageProcessing();
//                        $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");
//                        //save file
//                        move_uploaded_file($_FILES['Listing']["tmp_name"]['image_photo'][0], YII_UPLOAD_DIR . "/listing/$id/$name");
//                        //rezie image = 
//                        $ImageProcessing->folder = "/upload/listing/$id";
//                        $ImageProcessing->file = $name;
//                        $ImageProcessing->thumbs = ProListingPhotos::$szie;
//                        $ImageProcessing->create_thumbs();
//                    }
//                }

                $data = CUploadedFile::getInstances($model, 'image_photo');
                if (!empty($data) && is_array($data) && count($data) > 0) {
                    foreach ($data as $k => $file) {
                        $name = date('d-m-Y-h-i-s') . "." . $file->getExtensionName();
                        $photo = new ProListingPhotos();
                        $photo->listing_id = $id;
                        $photo->image = $file;
                        $photo->created_date = date('Y-m-d h:i:s');
                        $photo->default = ($totalImgupload == 0) ? 1 : 0;
                        $photo->validate();
                        if ($photo->hasErrors()) {
                            die('maxsize');
                        } else {
                            $photo->image = $name;
                            if ($photo->save()) {
                                //create folder
                                $ImageProcessing = new ImageProcessing();
                                $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");
                                $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id/root");
                                //save file
                                $file->saveAs(YII_UPLOAD_DIR . "/listing/$id/$name");

                                //warter mark
                                ImageProcessing::addWarterMark(YII_UPLOAD_DIR . "/listing/$id/root/$name", YII_UPLOAD_DIR . "/listing/$id/$name");

                                //rezie image
                                $ImageProcessing->folder = "/upload/listing/$id";
                                $ImageProcessing->file = $name;
                                $ImageProcessing->thumbs = ProListingPhotos::$szie;
                                $ImageProcessing->create_thumbs();
                            }
                        }
                    }
                }
            }
        }
    }

    /*
     * upload file doc step 3
     */

    public function actionAjax_upload_doc($id) {
        $model = $this->loadModel($id);
        if ($model) {

            if (isset($_FILES['Listing']) && isset($_POST['Listing']['title_cea'])) {
                $totalImgupload = ProListingUploadCea::model()->countByAttributes(array('listing_id' => $id));
                if (!ProListingUploadCea::checkLimitFileUpload($id)) {
                    die("limit");
                }
                $data = CUploadedFile::getInstances($model, 'file_upload');
                if ($_POST['Listing']['title_cea'] != '' && !empty($data)) {
                    foreach ($data as $k => $file) {
                        $name = date('d-m-Y-h-i-s') . "." . $file->getExtensionName();
                        $cea = new ProListingUploadCea();
                        $cea->attributes = $_POST['Listing'];
                        $cea->listing_id = $id;
                        $cea->file_upload = $file;
                        $cea->file = $name;
                        $cea->title = isset($_POST['Listing']['title_cea']) ? $_POST['Listing']['title_cea'] : '';
                        $cea->created_date = date('Y-m-d h:i:s');
                        $cea->validate();
                        if ($cea->hasErrors()) {
                            die('maxsize');
                        } else {
                            if ($cea->save()) {
                                $ImageProcessing = new ImageProcessing();
                                $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");
                                $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id/cea");
                                $file->saveAs(YII_UPLOAD_DIR . "/listing/$id/cea/$name");
                            }
                        }
                    }
                }
            }
        }
    }

    /*
     * DTOAN
     * Delete photo step 3
     */

    public function actionAjaxdelete_photo($listing, $photo) {
        if (Listing::model()->findByAttributes(array('id' => $listing))) {
            $model = ProListingPhotos::model()->findByPk($photo);
            if ($model->delete()) {
                ProListingPhotos::removePhoto($model);
                Listing::AutoSetCoverPhotoListing($listing);
            }
        }
    }

    /*
     * DTOAN
     * Delete photo step 3
     */

    public function actionDelete($id) {
        $model = Listing::model()->findByAttributes(array('id' => $id));
        if ($model) {
            $model->save();
            if ($model->delete())
                Yii::log('Delete Record');
        }
    }

    /*
     * DTOAN
     * Delete document step3
     */

    public function actionAjaxdelete_doc($listing, $doc) {
        if (Listing::model()->findByAttributes(array('id' => $listing))) {
            $model = ProListingUploadCea::model()->findByPk($doc);
            if ($model->delete()) {
                ProListingUploadCea::removefileDoc($model);
            }
        }
    }

    public function actionSetdefault($listing, $photo) {
        $model = ProListingPhotos::model()->findByPk($photo);
        if ($model) {
            ProListingPhotos::model()->updateAll(array('default' => 0), "listing_id=$listing");
            $model->default = 1;
            $model->save();
        }
    }

    /**
     * @Author: ANH DUNG Jan 26, 2015
     * @Note: không rõ action này dùng khi nào nên chưa đưa vào phân quyền
     */
    public function actionPublishlisting($id) {
        $model = $this->loadModel($id);
        if ($model) {
            $model->status_listing = STATUS_LISTING_ACTIVE;
            $model->date_listed = date('Y-m-d h:i:s');
            $model->update(array('status_listing', 'date_listed'));
        }
    }

    /**
     * @Author: ANH DUNG Jan 26, 2015
     * @Note: không rõ action này dùng khi nào nên chưa đưa vào phân quyền
     */
    public function actionTake_off($id) {
        $model = $this->loadModel($id);
        if ($model) {
            $model->status_listing = STATUS_LISTING_PAST;
            $model->update(array('status_listing'));
        }
    }

    /**
     * @Author: ANH DUNG Jan 26, 2015
     * @Todo: handle update, it not good for DToan code
     */
    public function actionUpdate($id) {
        $this->redirect(Yii::app()->createAbsoluteUrl("admin/listing/create", array("id"=>$id)));
    }
    /**
     * @Author: ANH DUNG Jul 14, 2014
     * @Todo: repost listing. Listing ma duoc repost se coi nhu la Listing moi binh thuong
     * @Param: $id pk listing
     */
    public function actionRepost_listing($id) {
        $model = $this->loadModel($id);
        if($model){
            Listing::SetStatusActiveListingRelisted($id);
            Yii::log('Repost Record');
        }
    }
    
}

?>