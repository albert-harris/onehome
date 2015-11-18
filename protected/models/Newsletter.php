<?php

/**
 * This is the model class for table "{{_newsletter}}".
 *
 * The followings are the available columns in table '{{_newsletter}}':
 * @property integer $id
 * @property string $subject
 * @property string $content
 * @property string $created_time
 * @property string $remain_subscribers
 * @property integer $total_subscriber
 */
class Newsletter extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Newsletter the static model class
	 */
        public $newsletter_group_subscriber;// Add By Nguyen Dung
        public $total_read; // Add By Nguyen Dung
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_newsletter}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('subject, content, send_time', 'required'),
                        array('newsletter_group_subscriber','required'),//,'on'=>'create,update'
			array('total_subscriber', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
                        array('send_time', 'date', 'format'=>'yyyy-M-d H:m:s'),
			array('id, subject, content, created_time, remain_subscribers, total_subscriber, newsletter_group_subscriber,status,send_time', 'safe'),
//                    	array('id, subject, content, created_time, newsletter_group_subscriber,status,send_time', 'safe','on'=>'search'),

		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
                    'newsletter_subscriber' => array(self::HAS_MANY, 'NewsletterGroupSubscriber', 'newsletter_id'),
                    'newsletter_tracking' => array(self::HAS_MANY, 'NewsletterTracking', 'newsletter_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'content' => 'Content',
			'created_time' => 'Created Time',
			'send_time'		=>	"Sent time",
			'remain_subscribers' => 'Remain Subscribers',
			'total_subscriber' => 'Total Subscriber',
			'newsletter_group_subscriber' => 'Group Sent',
			'total_read' => 'Total Read',
                        'status'=>'Status',
                        'dedicate_list'=>'Group Sent',
		);
	}

    public function countRemain()
    {
        $str = preg_replace('/^\,/', '', $this->remain_subscribers);
        $str = preg_replace('/\,$/', '', $str);
        $s = explode(',', $str);
        if(count($s) == 1 && empty($s[0]))
            return 0;
        return count($s);
    }

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.subject',$this->subject,true);
		$criteria->compare('t.content',$this->content,true);
		$criteria->compare('t.created_time',$this->created_time,true);
		$criteria->compare('t.remain_subscribers',$this->remain_subscribers,true);
		$criteria->compare('t.total_subscriber',$this->total_subscriber);
                $criteria->order = 'created_time DESC';
		return new CActiveDataProvider($this, array(
                        'criteria'=>$criteria,
                        'Pagination' => array (
                            'PageSize' => 10, //edit your number items per page here
                        ),  
		));
	}

    
    public function activate()
    {
        $this->status = 1;
        $this->update();
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	

	public function defaultScope()
	{
		return array(
			//'condition'=>'',
		);
	}
        
        // Add By Nguyen Dung
        public static function getNewsletterByPk($pk){
            return Newsletter::model()->findByPk((int)$pk);            
        }
        //HTram
         public static function getDedicateByStr($str){
            if(empty($str)) return '';
            $str = explode(',', $str);
            $res ='';
            foreach($str as $key=>$item){
                if($key==0)
                    $res .= SubscriberGroup::model()->findByPk($item)->name;
                else 
                    $res .= '<br />'.SubscriberGroup::model()->findByPk($item)->name;
            }
            return $res;
        }   
}