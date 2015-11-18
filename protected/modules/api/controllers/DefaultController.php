<?php

class DefaultController extends CController
{
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error = Yii::app()->errorHandler->error)
        {
            $arr = array(
                'status'=>1,
                'code'=>$error['code'],
                'message'=>$error['message']
            );
            
//             $arr = array(
//                'message'=>'OK',
//                'code'=>'999',
//                'result'=>'true',
//            );
            Apimodule::sendResponse($arr);
        }
    }
    
}
