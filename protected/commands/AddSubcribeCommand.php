<?php

class AddSubcribeCommand extends CConsoleCommand{
    
    public function run($arg)
    {     
//        $last_working = Yii::app()->setting->getItem('last_working');
//        if(!empty($last_working))
//        {
//            $timestampNext = strtotime(ActiveRecord::timeCalMinutes(-10));
//            if(strtotime($last_working) > $timestampNext)
//            {
////                Yii::log(strtotime($last_working), 'error', 'NewsletterCommand.run');
////                Yii::log($timestampNext, 'error', 'NewsletterCommand.run');
//                echo 'waiting because last working is nearly';
//                return;
//            }
//        }
         $member =  Users::model()->findAll('role_id = '.ROLE_MEMBER);
         if(count($member)>0){
             foreach ($member as $item) {
                 $email = Subscriber::model()->find('email ="'.$item->email.'"');
                   if(count($email)==0) {
                         $subcribe = new Subscriber();
                         $subcribe->email = $item->email;
                         $subcribe->name = $item ->username;
                         $subcribe->subscriber_group_id = GROUP_MEMBER;
                         $subcribe->save();
                   }
            }
         }
    
        //Yii::app()->setting->setDbItem('last_working', date('Y-m-d h:i:s'));
    }
}
?>
