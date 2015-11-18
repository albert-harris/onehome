<?php


class NewsletterCommand extends CConsoleCommand
{
    protected $max = 10;
    protected $index = 0;
    protected $data = array();

    public function run($arg)
    {
        
        /* ANH DUNG MAR 05, 2015 dùng chỗ này để chạy import update database cuar singpost www.singpost.com
        $from = time();
        if( Yii::app()->setting->getItem('rss') == 0 ){
            Yii::app()->setting->setDbItem('rss', 1);
            ApiPostcode::HandleUpdateLonLatTableBuilding();
            
            $to = time();
            $second = $to-$from;
            $res = ' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';
            Yii::app()->setting->setDbItem('linkedin', $res);
        }
        Yii::app()->setting->setDbItem('facebook', time());
        die;
         * end ANH DUNG MAR 05, 2015 dùng chỗ này để chạy import update database cuar singpost www.singpost.com
         */
        
//        if(Yii::app()->params['mailchimp_on'] == 'yes')
//            return;        
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
        $this->doJob($arg);
        CmsEmail::mailAll($this->data);
        echo "Sent {$this->index} emails";
        Yii::app()->setting->setDbItem('last_working', date('Y-m-d h:i:s'));        
    }

    protected function doJob($arg)
    {
        $models = Newsletter::model()->findAll(array(
            'condition'=>'t.remain_subscribers IS NOT NULL AND length(t.remain_subscribers) > 0 AND t.send_time <= NOW()',
            'order'=>'t.id ASC',
        ));
        foreach ($models as $model)
        {
            $mail_models = ProNewsletterMail::model()->findAll(array(
                'condition'=>'t.newsletter_id = '.$model->id,
                'order'=>'t.id ASC',
            ));            
            if(count($mail_models)){
                $receivers = explode(',', $model->remain_subscribers);
                $subscriber_count=0;
                foreach ($mail_models as $key=>$k)
                {
                    $revei = array_shift($receivers);// need update this field
                    $s = Subscriber::model()->getSubscriberByEmail($k->email);
                    if(empty($s)) continue;               
                    if($s)
                        if($s->status==0) continue; // add by Nguyen Dung

                    $url=Yii::app()->setting->getItem('server_name').'/site/track_newsletter?newsletter_id='.$model->id.'&subscriber_email='.$s->email;
                    $img_track_read_email = '<img src="'.$url.'" alt="" height="1" width="1"/>';
                    $r = array(
                        'subject'=>$model->subject,
                        'params'=>array(
                            'content'=>$model->content.$img_track_read_email,
                            'newsletterName'=> Yii::app()->params['title'],
                            'unsubscribe'=> Yii::app()->setting->getItem('server_name').'/site/unsubscribe?id='.$s->id.'&code='.md5($s->id.$s->email),
                        ),
                        'view'=>'newsletter',
                        'to'=>$s->email,
                        'from'=>Yii::app()->params['autoEmail'],
                    );
                    $this->data []= $r;
                    
                    //Delete record in newsletter mail
                    ProNewsletterMail::model()->deleteByPk($k->id);
                    
                    $subscriber_count++;//count subscriber is served for current newsletter job
                    $this->index++;//count email is sent for current cron job
                    if($this->index >= $this->max)
                        break;  
                }

                $model->total_sent = $model->total_sent+$subscriber_count; // track amount mail sent
                $model->remain_subscribers = implode(',', $receivers);
                $model->update(array('remain_subscribers','total_sent'));
            }
            
             
        }

        //when sent all subscriber of a newsletter job but the
//        if($this->index < $this->max)
//            $this->doJob($arg);
    }
}