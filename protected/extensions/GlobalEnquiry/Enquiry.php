<?php
/**
 * @author kvan
 * @copyright (c) 19/6/2013, bb Verz Design
 */
class Enquiry extends CWidget
{    

    public function init() {
        parent::init();

    }

    public function run()
    {
        $model = new ProGlobalEnquiry();
        $box = Pages::getPageById(PAGE_ENGAGE_US_BOX);
        if(isset($_POST['ProGlobalEnquiry'])){
            echo "aaaaaaaaa";
            $model->attributes = $_POST['ProGlobalEnquiry'];
        }
        $this->render('index',array(
            'model'=>$model,
            'box' =>$box
            ));
    }    
}








