<?php

/**
 * DTOAN
 * ListingController
 * Manager listing for user Agent
 * Date 21-03-2014
 */
class ListingController extends MemberController {

    public $userID;

    public function init() {
        parent::init();
        $this->userID = Yii::app()->user->id;
//      $this->userID = 204;
    }

    public function actionIndex($status = null, $listing_type = null, $pro_type = NULL) {
        
        $this->pageTitle ='Listing Management' .' - '.Yii::app()->params['title'];
        $model = new Listing();
        $model->user_id = $this->userID;

        //status
        if (empty($status)) $model->status_listing = STATUS_LISTING_ACTIVE;
        else  $model->status_listing = $status;

        //listing type
        if (!empty($listing_type) && is_numeric($listing_type) && ($listing_type >= 1 && $listing_type <= 2))
            $model->listing_type = $listing_type;

        // ANH DUNG CLOSE JUL 23, 2014 property type
//        if (!empty($pro_type) && is_numeric($pro_type))  $model->property_type_1 = $pro_type;

        if(isset($_GET['Listing'])){
            $model->attributes=$_GET['Listing'];
        }
        $view = Listing::getViewStatus($status, STATUS_LISTING_ACTIVE);
        $this->render("index_$view", array('model' => $model));
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
        $this->pageTitle ='Create New Listing' .' - '.Yii::app()->params['title'];
        if (isset($_GET['id'])) 
            $this->pageTitle ='Update Listing' .' - '.Yii::app()->params['title'];
        if (!isset($_GET['id'])) {
            $model = new Listing('create_listing_step1');
        } else {
            $model = $this->loadModel((int) $_GET['id']);
            $model->scenario = 'create_listing_step1';
        }

        //add company listing
        if(isset($_GET['company']) && is_numeric($_GET['company'])){
            Listing::checkCompanyListingWithId($_GET['company'], $model);
            $model->company_listing_id = $_GET['company'];            
        }
//        Listing::FormatPriceFromDb($model);
        $model->listing_type_transaction = ProTransactionsPropertyDetail::VAR_INDIVIDUAL;

        if (isset($_POST['Listing'])) {
            $model->attributes = $_POST['Listing'];
            $this->setScenarioStep1($model);

            if ($model->validate()) {
                $model->user_id = $this->userID;
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
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/listing', array('status' => $model->status_listing)));
                } else {
                    $this->redirect(Yii::app()->createAbsoluteUrl('member/listing/extradetail', array('id' => $model->id)));
                }
            } else {
                $error = $model->getErrors();
                if (isset($error['unit_to'])) {
                    $model->addError('unit_from', $error['unit_to'][0]);
                }
            }
        } else {
            if (!empty($model->price)) {
                $model->price = Listing::getformatPrice($model->price);
            }
            if (!empty($model->office_bkank_valuation)) {
                $model->office_bkank_valuation = Listing::getformatPrice($model->office_bkank_valuation);
            }
            if($model->listing_type_transaction==2 &&  $model->dnc_expiry_date !=''  ){
                $model->dnc_expiry_date= date('d-m-Y',  strtotime($model->dnc_expiry_date));
            }else{
                 $model->dnc_expiry_date =null;
            }            
        }

        Listing::getCurrentStep($model, 'member', 1);

        $this->render('create', array('model' => $model, 'view' => 'basic_information'));
    }

    /*
     * STEP 2
     */

    public function actionExtradetail($id) {
        $this->pageTitle ='Create New Listing' .' - '.Yii::app()->params['title'];
        $model = $this->loadModel($id);
        if (empty($model)) {
            $this->redirect(Yii::app()->createAbsoluteUrl('member/dashboard'));
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
                        $this->redirect(Yii::app()->createAbsoluteUrl('member/listing', array('status' => $model->status_listing)));
                    } else {
                        $this->redirect(Yii::app()->createAbsoluteUrl('member/listing/managephotos', array('id' => $model->id)));
                    }
                }
            }
        } else {
            $model->special_feature_json = json_decode($model->special_feature_json);
            $model->fixtures_fittings_json = json_decode($model->fixtures_fittings_json);
            $model->outdoor_indoor_space_json = json_decode($model->outdoor_indoor_space_json);
            $model->furnishing_included_json = json_decode($model->furnishing_included_json);
        }
        Listing::getCurrentStep($model, 'member', 2);

        $this->render('create', array('model' => $model, 'view' => 'extra_detail'));
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: handle sort photo
     * @Param: $model is model Listing
     */
    public function HandleSortPhoto($model) {
        try {
            if(isset($_GET['ad_form_sort_photo']) && isset($_POST['photo_display_order']) && is_array($_POST['photo_display_order'])){
                ProListingPhotos::HandleSortPhoto($model);
                die;
            }            
        } catch (Exception $exc) {
            throw  new CHttpException('Invalid Request');
        }
    }

    /**
     * step 3
     */
    public function actionManagephotos($id) {
        $this->pageTitle ='Create New Listing' .' - '.Yii::app()->params['title'];
        $model = $this->loadModel($id);
        $messagePhoto = NULL;
        $this->HandleSortPhoto($model);
        if (empty($model)) {
            $this->redirect(Yii::app()->createAbsoluteUrl('member/dashboard'));
        }
        if (isset($_POST) && count($_POST)>0) {
              //chekcPhoto
            $totalImgupload = ProListingPhotos::model()->countByAttributes(array('listing_id' => $id));
//            if ($totalImgupload > 0) { // ANH DUNG CLOSE AUG 28, 2014
                   if(isset($_POST['releated'])) $model->listing_releated = json_encode($_POST['releated']);
                    //back
                   if (isset($_POST['back'])) {
                       $this->redirect(Yii::app()->createAbsoluteUrl('member/listing/extradetail', array('id' => $model->id)));
                   }

                   if (isset($_POST['save_exit']) || isset($_POST['next']) && $model->status_listing != STATUS_LISTING_ACTIVE) {

                       if ($model->current_step_next == 2) {
                           $model->current_step_next = 3;
                       } else {
                           if ($model->current_step_next == 3) {
                               $model->current_step_next = 4;
                           }
                       }
                       if($model->save()){
                           ProListingReleated::saveListingReleatedWithListingid($model);
                       }
                   }
                   
                   //save & exit
                   if (isset($_POST['save_exit'])) {
                       $this->redirect(Yii::app()->createAbsoluteUrl('member/listing', array('status' => $model->status_listing)));
                   }
                   //next
                   if (isset($_POST['next'])) {
                       if($model->save()){
                           ProListingReleated::saveListingReleatedWithListingid($model);
                       }
                       $this->redirect(Yii::app()->createAbsoluteUrl('member/listing/confrimations', array('id' => $model->id)));
                   }
//            }else{ // ANH DUNG CLOSE AUG 28, 2014
////                 $messagePhoto= 'Please upload photos';
//            }
        }

        Listing::getCurrentStep($model, 'member', 3);
        //photo
        $photo = new ProListingPhotos();
        $photo->listing_id = $model->id;

        //cea form
        $cea = new ProListingUploadCea();
        $cea->listing_id = $model->id;
        
        $this->render('create', array('model' => $model, 
            'view' => 'manage_photos',
            'arrOrther' => array('photo' => $photo->search(), 'cea' => $cea->search(),'messagePhoto'=>$messagePhoto)));
    }

    /**
     * step 4
     */
    public function actionConfrimations($id) {
         $this->pageTitle ='Create New Listing' .' - '.Yii::app()->params['title'];
        $model = $this->loadModel($id);
        if (empty($model)) {
            $this->redirect(Yii::app()->createAbsoluteUrl('member/dashboard'));
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
                    // ANH DUNG Oct 23, 2014
                    // to do with company listing, we need update company_listing_status to STATUS_COMPANY_CLOSED
                    // khong lam cho nay nua xem o => Listing::SetStatusCloseForCompanyListing($pk);
                    // ANH DUNG Oct 23, 2014
                    
                    //back
                    if (isset($_POST['back'])) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('member/listing/managephotos', array('id' => $model->id)));
                    }
                    //save & exit
                    if (isset($_POST['save_exit'])) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('member/listing', array('status' => $model->status_listing)));
                    }
                    //next
                    if (isset($_POST['next'])) {
                        $this->redirect(Yii::app()->createAbsoluteUrl('member/listing', array('status' => $model->status_listing)));
                    }
                }
            }
        } else {
            if (!empty($model->activate_listing_options)) {
                $model->activate_listing_options = json_decode($model->activate_listing_options);
            }
        }

        Listing::getCurrentStep($model, 'member', 4);

        $imageDefault = Listing::getDefaultImgListing($model->id, 'image');
        $this->render('create', array('model' => $model, 'view' => 'confrimations', 'arrOrther' => array('imageDefault' => $imageDefault)));
    }

    public function actionAutocomplete() {
        $this->layout = false;
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.property_name_or_address', ActiveRecord::safeField($_GET['term']), true);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.user_id', $this->userID);
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
                'arrOrther' => array('photo' => $photo->search(),
                                    'cea' => $cea->search(),
                                    'messagePhoto'=>$messagePhoto)
                ));
        } catch (Exception $ex) {
            throw new CHttpException(404, $ex->getMessage());
        }
    }
    
    
    public function actionAjax_upload_photo_by_ku_toan($id) {
        echo '<pre>';
        print_r($_FILES);
        echo '</pre>';
        die;
        $model = $this->loadModel($id);
        if ($model) {
            $totalImgupload = ProListingPhotos::model()->countByAttributes(array('listing_id' => $id));
            if (!ProListingPhotos::checkLimitFileUpload($id)) {
                $result['errorMesage'] = 'Limit '. LIMIT_PHOTO_UPLOAD .' photos upload';
                die(json_encode($result)) ;
            }
            
            //upload file ajax
           Yii::import("ext.EAjaxUpload.qqFileUploader");

           $ImageProcessing = new ImageProcessing();
           $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");             
           $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id/root");  
//           $folder="upload/listing/$id/root/";
           $folder="upload/listing/$id/";

           $allowedExtensions = array("jpg","jpeg","gif","png");
           $sizeLimit = 5 * 1024 * 1024;// maximum file size in bytes
           $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
           $result = $uploader->handleUpload($folder,true);
           $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

           $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
           $fileName=$result['filename'];//GETTING FILE NAME

           if(isset($result['success']) && $result['success']==true){
               $photo = new ProListingPhotos();
               $photo->listing_id = $id;
               $photo->image = $fileName;
               $photo->created_date = date('Y-m-d h:i:s');
               $photo->default = ($totalImgupload == 0) ? 1 : 0;
                if ($photo->save()) {
                    //warter mark                    
                    //rezie image
//                    Listing::ResizePhotoOfListing($photo);
                    
                    //ANH DUNG CLOSE AUG 11, 2014
                    $ImageProcessing->folder = "/upload/listing/$id";
                    $ImageProcessing->file = $fileName;
                    $ImageProcessing->thumbs = ProListingPhotos::$szie;
                    $ImageProcessing->create_thumbs();
                    foreach(ProListingPhotos::$szie as $folder=>$item){
                        ImageProcessing::addWarterMark(YII_UPLOAD_DIR . "/listing/$id/$folder/$fileName",YII_UPLOAD_DIR . "/listing/$id/$folder/$fileName");
                    }
                    ImageProcessing::addWarterMark(YII_UPLOAD_DIR . "/listing/$id/root/$fileName",YII_UPLOAD_DIR . "/listing/$id/$fileName");
               }
           }

           echo $return;// it's array              


            
//            if (isset($_FILES['Listing'])) {
//                $totalImgupload = ProListingPhotos::model()->countByAttributes(array('listing_id' => $id));
//                if (!ProListingPhotos::checkLimitFileUpload($id)) {
//                    echo "limit";
//                    die();
//                }
////
////                $error = Listing::model()->validateFileUpload($_FILES['Listing'], 'image_photo', 'image');
////                if (empty($error)) {
////                    $type = explode("/", $_FILES['Listing']["type"]['image_photo'][0]);
////                    $name = date('d-m-Y h-i-s') . "." . $type[1];
////
////                    $photo = new ProListingPhotos();
////                    $photo->listing_id = $id;
////                    $photo->image = $name;
////                    $photo->created_date = date('Y-m-d h:i:s');
////                    $photo->default = ($totalImgupload == 0) ? 1 : 0;
////                    if ($photo->save()) {
////                        //create folder
////                        $ImageProcessing = new ImageProcessing();
////                        $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");
////                        //save file
////                        move_uploaded_file($_FILES['Listing']["tmp_name"]['image_photo'][0], YII_UPLOAD_DIR . "/listing/$id/$name");
////                        //rezie image = 
////                        $ImageProcessing->folder = "/upload/listing/$id";
////                        $ImageProcessing->file = $name;
////                        $ImageProcessing->thumbs = ProListingPhotos::$szie;
////                        $ImageProcessing->create_thumbs();
////                    }
////                }
////                
//                    $data = CUploadedFile::getInstances($model, 'image_photo');
//                   if(!empty($data)&& is_array($data) && count($data)>0){
//                       foreach ($data as $k => $file) {
//                            $name = date('d-m-Y-h-i-s') . "." . $file->getExtensionName();
//                            $photo = new ProListingPhotos();
//                            $photo->listing_id = $id;
//                            $photo->image = $file;
//                            $photo->created_date = date('Y-m-d h:i:s');
//                            $photo->default = ($totalImgupload == 0) ? 1 : 0;
//                            $photo->validate();
//                            if($photo->hasErrors()){
//                                die('maxsize');
//                            }else{
//                                 $photo->image = $name;
//                                 if ($photo->save()) {
//            //                         //create folder
//                                       $ImageProcessing = new ImageProcessing();
//                                       $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");                              
//                                       $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id/root");                              
//                                       //save file
//                                       $file->saveAs(YII_UPLOAD_DIR . "/listing/$id/root/$name");
//                                       //warter mark
//                                       ImageProcessing::addWarterMark(YII_UPLOAD_DIR . "/listing/$id/root/$name",YII_UPLOAD_DIR . "/listing/$id/$name");
//                                       
//                                        //rezie image
//                                       $ImageProcessing->folder = "/upload/listing/$id";
//                                       $ImageProcessing->file = $name;
//                                       $ImageProcessing->thumbs = ProListingPhotos::$szie;
//                                       $ImageProcessing->create_thumbs();                                    
//                                 }
//                            }
//                       }
//                   }               
//            }
        }
    }

    /*
     * upload file doc step 3
     */

    public function actionAjax_upload_doc($id,$type) {
        if(isset($_GET['title'])){
            $_SESSION['title'] = strip_tags(trim($_GET['title']));
            die();
        }
        
        $model = $this->loadModel($id);
        if ($model) {
            
            $totalImgupload = ProListingUploadCea::model()->countByAttributes(array('listing_id' => $id));
            if (!ProListingUploadCea::checkLimitFileUpload($id)) {
                $result['errorMesage'] = 'Limit '. LIMIT_DOC_UPLOAD .' file upload';
                die(json_encode($result)) ;
            }            
            
            //upload file ajax
           Yii::import("ext.EAjaxUpload.qqFileUploader");

           $ImageProcessing = new ImageProcessing();
           $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");             
           $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id/cea");             
           $folder="upload/listing/$id/cea/";

           $allowedExtensions = array("doc","docx","xls","xlsx","pdf","csv");
           $sizeLimit = 5 * 1024 * 1024;// maximum file size in bytes
           $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
           $result = $uploader->handleUpload($folder,true);
           $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

           $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
           $fileName=$result['filename'];//GETTING FILE NAME
           
           if(isset($result['success']) && $result['success']==true){
                $cea = new ProListingUploadCea();
                $cea->listing_id = $id;
                $cea->file = $fileName;
                $cea->title = isset($_SESSION['title']) ? $_SESSION['title'] : '' ;
                $cea->created_date = date('Y-m-d h:i:s');
                $cea->validate();
                if($cea->save()){
                    unset($_SESSION['title']);
                }    
           }

           echo $return;// it's array         
           
           
           

//            if (isset($_FILES['Listing']) && isset($_POST['Listing']['title_cea'])) {
//                $totalImgupload = ProListingUploadCea::model()->countByAttributes(array('listing_id' => $id));
//                if (!ProListingUploadCea::checkLimitFileUpload($id)) {
//                    echo "limit";
//                    die();
//                }
//                $data = CUploadedFile::getInstances($model, 'file_upload');
//                if ($_POST['Listing']['title_cea'] != '' && !empty($data)) {
//                    foreach ($data as $k => $file) {
//                        $name = date('d-m-Y-h-i-s') . "." . $file->getExtensionName();
//                        $cea = new ProListingUploadCea();
//                        $cea->attributes = $_POST['Listing'];
//                        $cea->listing_id = $id;
//                        $cea->file_upload = $file;
//                        $cea->file = $name;
//                        $cea->title = isset($_POST['Listing']['title_cea']) ? $_POST['Listing']['title_cea'] : '';
//                        $cea->created_date = date('Y-m-d h:i:s');
//                        $cea->validate();
//                        if ($cea->save()) {
//                            $ImageProcessing = new ImageProcessing();
//                            $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id");
//                            $ImageProcessing->createSingleDirectoryByPath("/upload/listing/$id/cea");
//                            $file->saveAs(YII_UPLOAD_DIR . "/listing/$id/cea/$name");
//                        }
//                    }
//                }
//            }
        }
    }

    /*
     * DTOAN
     * Delete photo step 3
     */

    public function actionAjaxdelete_photo($listing, $photo) {
        if (Listing::model()->findByAttributes(array('id' => $listing, 'user_id' => $this->userID))) {
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
    public function actionDeletelisting($id) {
        $model = Listing::model()->findByAttributes(array('id' => $id, 'user_id' => $this->userID));
        if ($model) {
            //update status approve delete
            if ($model->status_listing = STATUS_LISTING_ACTIVE) {
                $model->status_listing = STATUS_LISTING_PENDING;
                $model->status_approve = STATUS_PEDING_REMOVE;
                $model->save();
            } else {
                if ($model->delete())
                    Yii::log('Delete Record');
            }
        }
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
        }
    }
    /**
     * @Author: ANH DUNG Jul 16, 2014 - /propertyfinal/member/company
     * @Todo: user pick company listing. Listing ma duoc post se coi nhu la Listing cua user do
     * @Param: $id pk listing
     */
    public function actionUser_post($id) {
        $model = $this->loadModel($id);
        if($model){
            Listing::UserPostCompanyListing($id);
        }
    }

    /*
     * DTOAN
     * Delete document step3
     */
    public function actionAjaxdelete_doc($listing, $doc) {
        if (Listing::model()->findByAttributes(array('id' => $listing, 'user_id' => $this->userID))) {
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

    public function actionTake_off($listing) {
        $model = Listing::model()->findByAttributes(array('id' => $listing, 'user_id' => $this->userID));
        if ($model) {
            $model->take_off = 1;
            $model->take_off_content = (isset($_GET['takeOff'])) ? strip_tags($_GET['takeOff']) : NULL;
//            $model->status_listing = STATUS_LISTING_PAST;
            $model->status_listing = STATUS_LISTING_PENDING;
            $model->save();
        }
    }
    
    public function actionMap(){
        $this->render('map');
    }

}

?>