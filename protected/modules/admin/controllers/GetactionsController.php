<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GetactionsController extends CController
{
        public function actionGetactionsname()
	{
            if(isset($_POST['controller']))
            {
                if(isset($_POST['module']))
                {
                    if(ControllerActionsName::getActions($_POST['controller'],$_POST['module']) != null)
                        echo ControllerActionsName::getActions($_POST['controller'],$_POST['module']);
                    else {
                        return false;
                    }
                }
                else
                {
                    if(ControllerActionsName::getActions($_POST['controller']) != null)
                        echo ControllerActionsName::getActions($_POST['controller']);
                    else {
                        return false;
                    }
                }                          
            }            
	}
        
        public function actionRolessession()
        {
            if(isset($_POST['type']))
            {
                Yii::app()->session['type'] = $_POST['type'];
                Yii::app()->session['roles'] = $_POST['roles'];                
            }
        }        
}


?>
