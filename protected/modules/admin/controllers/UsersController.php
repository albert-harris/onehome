<?php
class UsersController extends AdminController
{
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
        
        //bb
        public function actionCreate()
        {
            $model = new Users('register');

            $model->membership_fee = Yii::app()->params['membership_fee'];
            if(isset($_POST['Users']))
            {
                $model->attributes=$_POST['Users'];
                $model->confirm_email = $model->email;
                $model->created_date = date('Y-m-d H:i:s');
                $model->role_id = ROLE_MEMBER;
                $model->application_id = FE;
                $model->verify_code = ActiveRecord::generateVerifyCode();
                $model->temp_password = $model->password_hash;
                if($model->validate())
                {
                    $model->dob = DateHelper::toDbDateFormat ($model->dob);
                   $model->password_hash = md5($model->password_hash);
                   $model->password_confirm = $model->password_hash;
                    if($model->save()){
                        Yii::app()->user->setFlash('msg', "New Member has been successfully saved.");                                                                                                    
                        $this->redirect(array('update','id'=>$model->id));
                    }
                }
            }   
            else
            {
                $model->affiliate_code = SpAffiliateCodeTemp::gen();
                $model->dob = !empty($model->dob) ? DateHelper::toDatePickerFormat ($model->dob) : "";
                $model->mailing_country_id = 229;
                $model->shipping_country_id = 229;
            }
            $this->render('create',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));  
        }
                
        //bb
	public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            $model->scenario = 'editUser';
            $before_payment_status = $model->payment_status;
            
            if(isset($_POST['Users']))
            {
                $old_password = $model->password_hash;
                $model->attributes=$_POST['Users'];
                
                if($model->validate())
                {
                    $model->dob = DateHelper::toDbDateFormat ($model->dob);
                    if(empty($model->password_hash) && empty($model->password_confirm)){
                        $model->password_hash = $old_password;
                    } else{
                        $model->temp_password = $model->password_hash;
                        $model->password_hash = md5($model->password_hash);
                    }
                    if($model->update())
                    {
                        $after_payment_status = $model->payment_status;
                        if($after_payment_status!= $before_payment_status && $after_payment_status == PAYMENT_STATUS_PAID)
                        {
                            //PENDING to PAID
                            //save transaction
                            SpTransactions::saveRecord($model->id, TRANSACTION_JOIN_MEMBER, $model->id, $model->membership_fee);
                            //add commission
                            SpTransactionsCommission::saveRegisterCommission($model);  
                            //send email
                            SendEmail::registrationSuccessAndBecomeMemberToUser($model);
                        }
                        Yii::app()->user->setFlash('msg', "Information has been successfully updated.");                                                                                                    
                        $this->redirect(array('update','id'=>$model->id));
                    }
                }
            }   
            else
                $model->dob = DateHelper::toDatePickerFormat ($model->dob);
            $this->render('update',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));              
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
                            if($model->delete()){
                                Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
                            }
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
                    throw new CHttpException(400,$e->getMessage());
                }
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
//                try
//                {
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('index',array(
			'model'=>$model, 'actions' => $this->listActionsCanAccess,
		));
//                }
//                catch (Exception $e)
//                {
//                    Yii::log("Exception ".  print_r($e, true), 'error');
//                    throw  new CHttpException("Exception ".  print_r($e, true));     
//                }
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
		$model=Users::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
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
        
//     public function actionAjaxActivate($id) {
//         if(Yii::app()->request->isPostRequest)
//        {
//            $model = $this->loadModel($id);
//            if(method_exists($model, 'activate'))
//            {
//                $model->activate($_GET['col']);
//            }
//            Yii::app()->end();
//        }
//        else
//        {
//            Yii::log('Invalid request. Please do not repeat this request again.');
//            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//        }                
//     }    
//     public function actionAjaxDeactivate($id) {
//         if(Yii::app()->request->isPostRequest)
//        {
//            $model = $this->loadModel($id);
//            if(method_exists($model, 'deactivate'))
//            {
//                $model->deactivate($_GET['col']);
//            }
//            Yii::app()->end();
//        }
//        else
//        {
//            Yii::log('Invalid request. Please do not repeat this request again.');
//            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
//        }                
//     }            
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
        
/**
    * <jason>
    * <Date: 20130913>
    * Update to export of entire list
    */
    public function actionExportExcel()
    {
        Yii::import('application.extensions.phpexcel.Classes.PHPExcel');
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("VerzDesign")
                                        ->setLastModifiedBy("Jason")
                                        ->setTitle('Export Current List')
                                        ->setSubject("Office 2007 XLSX Document")
                                        ->setDescription("Members")
                                        ->setKeywords("office 2007 openxml php")
                                        ->setCategory("Members");
        $objPHPExcel->getActiveSheet()->setTitle('Export Current List'); 
        $objPHPExcel->setActiveSheetIndex(0);

         //render HEADER BEGIN  
        $objPHPExcel->getActiveSheet()->setCellValue("A1" ,'S/N', true);
        $objPHPExcel->getActiveSheet()->setCellValue("B1" ,'Email', true);
        $objPHPExcel->getActiveSheet()->setCellValue("C1" ,'Full Name', true);
        $objPHPExcel->getActiveSheet()->setCellValue("D1" ,'Company Name', true);
        $objPHPExcel->getActiveSheet()->setCellValue("E1" ,'Phone', true);
        $objPHPExcel->getActiveSheet()->setCellValue("F1" ,'Created Date', true);
        $objPHPExcel->getActiveSheet()->setCellValue("G1" ,'Status', true);

        $index = 1;            
        $sn = 1;            
        $d = $_SESSION['data_user-excel'];
        foreach ($d->data as $k=> $item) {
            $model = Users::model()->findByPk($item->id);
            if (!empty($model)) {
                $index++;
//                $full_name = $model->first_name.' '.$model->last_name;

                if($model->status == STATUS_ACTIVE){
                    $status = 'Active';
                }
                elseif($model->status == STATUS_INACTIVE){
                    $status = 'Inactive';
                }

                $objPHPExcel->getActiveSheet()->setCellValue("A".$index ,$sn, true);
                $objPHPExcel->getActiveSheet()->setCellValue("B".$index ,$model->email, true);
//                $objPHPExcel->getActiveSheet()->setCellValue("C".$index ,$full_name, true);
                $objPHPExcel->getActiveSheet()->setCellValue("C".$index ,$model->username, true);
                $objPHPExcel->getActiveSheet()->setCellValue("D".$index ,$model->company_name , true);
                $objPHPExcel->getActiveSheet()->setCellValue("E".$index ,$model->phone, true);
                $objPHPExcel->getActiveSheet()->setCellValue("F".$index ,$model->created_date != NULL?DateHelper::toDateFormat($model->created_date):'', true);
                $objPHPExcel->getActiveSheet()->setCellValue("G".$index ,$status, true);

                $objPHPExcel->getActiveSheet()->getStyle("A".$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle("B".$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle("C".$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle("D".$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle("E".$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHPExcel->getActiveSheet()->getStyle("F".$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle("G".$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

                $sn++;
            }
        }
        //Format bold
        $styleArray2 =  array(                         
                        'borders' => array(
                                           'allborders'     => array(
                                               'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                                               'color' => array(
                                                   'rgb' => 'FFFFFF'
                                               )
                                           ),
                                       )
                    );
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(13)->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->getStartColor()->setRGB('DBEAF9');
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->getColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray2);    

        //save file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        for($level=ob_get_level();$level>0;--$level)
        {
            @ob_end_clean();
        }
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Pragma: public');
                            header('Content-type: '.'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                            header('Content-Disposition: attachment; filename="'.'All_Members'.'.'.'xlsx'.'"');

                            header('Cache-Control: max-age=0');				
                            $objWriter->save('php://output');			
                            Yii::app()->end();                   
    }
    
}