<?php

/**
 * This is the model class for table "{{_subscriber}}".
 *
 * The followings are the available columns in table '{{_subscriber}}':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $status
 */
class Subscriber extends ActiveRecord
{
    public static $groupUsers = array(ROLE_AGENT=>'AGENT',
                                        ROLE_LANDLORD=>'LANDLORD',
                                        ROLE_TENANT=>'TENANT',
                                        ROLE_REGISTER_MEMBER=>'REGISTER',
    );
     public static $requestStatus = array('1'    =>	'Active',
    			    	          '0'	 =>	'Inactive');
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Subscriber the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_subscriber}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
            array('email', 'required'),
                    array('email', 'unique','message'=>'This email address has been subscriber'),
                    array('status', 'numerical', 'integerOnly'=>true),
                    array('name', 'length', 'max'=>100),
                    array('email', 'length', 'max'=>200),
                    array('email', 'email'),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, name, email, status,subscriber_group_id', 'safe'),
            );
    }

    public function getAjaxAction()
    {
        return array('actionAjaxActivate', 'actionAjaxDeactivate');
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'subscriber_group' => array(self::BELONGS_TO, 'SubscriberGroup', 'subscriber_group_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'name' => 'Name',
                    'email' => 'Email',
                    'status' => 'Status',
                    'subscriber_group_id' => 'Subscriber Group',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('email',$this->email,true);
            $criteria->compare('status',$this->status);
            $criteria->compare('subscriber_group_id', 1);
            $criteria->order = 'id DESC';

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'Pagination' => array (
                        'PageSize' => 10, //edit your number items per page here
                    ),  			
            ));
    }
    public function search_user()
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('name',$this->name,true);
            $criteria->compare('email',$this->email,true);
            $criteria->compare('status',$this->status);
            $criteria->addCondition('subscriber_group_id != 1');
            $criteria->order = 'id DESC';

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
        if($this->update()){
    $this->mailchimp();
        }
    }

    public function deactivate()
    {
        $this->status = 0;
        if($this->update()){
    $this->mailchimp();       
        }
    }

    public function mailchimp(){
                    set_time_limit(7200);
        $idNameGroup=array();
        $criteria=new CDbCriteria;
//            $criteria->compare('t.status',1);
        $mSubG = SubscriberGroup::model()->findAll($criteria);
        if(count($mSubG)>0)
            foreach($mSubG as $i)
                $idNameGroup[$i->id] = $i->name;

        $criteria=new CDbCriteria;
        $mSubscriber = Subscriber::model()->findAll($criteria);
        $test=array();
        if(count($mSubscriber)>0)
        {
            Yii::import('ext.MailChimp.MailChimp', true); 
            foreach($mSubscriber as $item)
            {
                $mailChimp = new MailChimp();
//                    $mailChimp->removeSubscriber('verzdev2@gmail.com');
//                    die;
                $sGroupName = Yii::app()->params['mailchimp_title_groups'];
                $sGroup = strtolower($idNameGroup[$item->subscriber_group_id]);
                $merge_vars = array(
                        //'FNAME'=>$item->first_name, 'LNAME'=>  $item->last_name, 
                        'GROUPINGS'=>array(
                            array('name'=>$sGroupName, 'groups'=>$sGroup),
                        )
                    );
                if($item->status == 1)
                {
                    $test[]= $mailChimp->addSubscriber($item->email, $merge_vars);
                }
                else
                {
                    $mailChimp->removeSubscriber($item->email);
                }
            }

        }
    }

    public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status=1',
            )
        );
    }

    // Add By Nguyen Dung
    public static function getSubscriberByEmail($email){
        return Subscriber::model()->find('email="'.$email.'"');            
    }
    /**
     * @Author: TRÂM EM Apr 08, 2014
     * @Todo: save suscriber for public email
     * @Param: $email,$group_id,$name
     */
     public static function saveSubscriberPublic($email,$group_id,$name=""){
        $subscriber = self::getSubscriberByEmail($email);
        if(empty($subscriber)){
            $model = new Subscriber('create');
            $model->email = $email;
            $model->subscriber_group_id = $group_id;
            $model->status = 1;
            if(!empty($name))
                $model->name = $name;
            $model->save();
        }
    }

    /**
     * @Author: TRÂM EM Apr 08, 2014
     * @Todo: save user suscriber if check to subscriber
     * @Param: $user_id id user
     */
    public static function saveSubscriberUser($user_id){
        $users = Users::model()->findByPk($user_id);
        $subscriber = self::getSubscriberByEmail($users->email);
        if(empty($subscriber)){
            $model = new Subscriber('create');
            $model->email = $users->email;
            $model->subscriber_group_id = $users->role_id;
            $model->status = $users->status;
            $model->name = $users->first_name." ".$users->last_name;
            $model->save();
        }
    }
    public static function deleteSubscriber($email){
        $subscriber = self::getSubscriberByEmail($email);
        if(!empty($subscriber)){
           Subscriber::model()->deleteAll('email =' . $email);
        }
    }
    public static function updateSubscriberUser($user_id){
        $users = Users::model()->findByPk($user_id);
        if($users->is_subscriber == 1){
            $model = self::getSubscriberByEmail($users->email);
            if(!empty($model)){
                $model->email = $users->email;
                $model->subscriber_group_id = $users->role_id;
                $model->status = $users->status;
                $model->name = $users->first_name." ".$users->last_name;
                $model->save();
            }
        }
    }

}