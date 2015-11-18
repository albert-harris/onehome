<?php
/**
 * User: Kvan
 * Date: 4/23/14
 * Time: 10:08 AM
 * To change this template use File | Settings | File Templates.
 * class manage Enquiries of member
 */
class EnquiriesController extends MemberController
{
    public function actionIndex() {
        try {
            $enquiryReply = new ProEnquiryPropertyReply();
            $this->pageTitle = 'Enquiries - ' . Yii::app()->params['title'];
            $enquiries = ProEnquiryProperty::getAllByUserId(Yii::app()->user->id);
            $this->render('index',array(
                'enquiries' => $enquiries,
                'enquiryReply' => $enquiryReply
            ));
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function actionView($id) {
        try{
             $this->pageTitle = 'View Enquiries - ' . Yii::app()->params['title'];
            $model = ProEnquiryProperty::getItemById($id);
            if($model->status == ENQUIRY_PROPERTY_NEW){
                //set status to read
                $model->status = ENQUIRY_PROPERTY_READ;
                $model->scenario = null;
                $model->update(array('status'));
            }

            $replyList = new ProEnquiryPropertyReply();
            $replyList->enquiry_property_id = $id;
            $replyListData = $replyList->search();
            if(!empty($model) && $model->listing->user_id == Yii::app()->user->id){
                $this->render('view',array(
                    'model'=>$model,
                    'replyListData'=>$replyListData
                ));
            }else{
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }

        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e->getMessage(), true));
        }
    }

    public function actionDelete($id)
    {
        try
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = ProEnquiryProperty::getItemById($id);
                // we only allow deletion via POST request
                if(!empty($model) && $model->listing->user_id == Yii::app()->user->id)
                {
                    if($model->delete()){
                        //delete replied email of $id
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

    public function actionReply(){
        try
        {
            $model = new ProEnquiryPropertyReply();
            if(isset($_POST['ProEnquiryPropertyReply'])){
                $model->attributes=$_POST['ProEnquiryPropertyReply'];
                if($model->save()){
                    //set replied status
                    $enquiryProperty = ProEnquiryProperty::getItemById($model->enquiry_property_id);
                    $enquiryProperty->status = ENQUIRY_PROPERTY_REPLIED;
                    $enquiryProperty->scenario = null;
                    $enquiryProperty->update(array('status'));
                    //send email
                    SendEmail::sendEmailReplyEnquiryAgent($model);
                    Yii::app ()->user->setFlash('success', 'Your email has been sent.');
                    $this->redirect(array('index'));
                }else
                {
                    Yii::app ()->user->setFlash('error', 'Your email could not send. Please try again.');
                    $this->redirect(array('index'));
                }

            }else
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

}
