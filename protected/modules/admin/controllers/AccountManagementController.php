<?php
/**
 * @Author: ANH DUNG Aug 19, 2014
 * @Todo: display full name of user
 * @Param: $model model 
 * @Return: full name with salution of user
 */
class AccountManagementController extends AdminController
{
    public function actionInvoice()
    {
        try{
            
        $this->render('Invoice',array(
                'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }

    public function actionAccountReceivables()
    {
        try{
            
        $this->render('AccountReceivables',array(
                'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }		
    }

    public function actionPaymentVouchers()
    {
        try{
            $model = new FiPaymentVoucher();
            $model->created_date = date('d-m-Y');
            if(isset($_POST['FiPaymentVoucher'])) {

            }
            $this->render('PaymentVouchers',array(
                    'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,'model'=>$model
            ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    public function actionAccountPayable()
    {
        try{
            
        $this->render('AccountPayable',array(
                'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    public function actionProfitLossAccounts()
    {
        try{
            
        $this->render('ProfitLossAccounts',array(
                'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }
    
    public function actionBalanceSheet()
    {
        try{
            
        $this->render('BalanceSheet',array(
                'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }    
    
    public function actionReport()
    {
        try{
            
        $this->render('Report',array(
                'model'=>$this->loadModel($id), 'actions' => $this->listActionsCanAccess,
        ));
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }
    }    
   
}
