<?php

/**
 * This is the model class for table "{{_pro_agent_tier_manager}}".
 *
 * The followings are the available columns in table '{{_pro_agent_tier_manager}}':
 * @property string $id
 * @property string $agent_id
 * @property string $tier_manager_id
 * @property integer $type
 */
class ProAgentTierManager extends CActiveRecord
{
    const TYPE_AGENT_TIER=1;
    const TYPE_1ST = 1;
    const TYPE_2ND = 2;
    
    public static $ARR_NUMBER = array(
        1=> 'st',
        2=> 'nd',
        3=> 'rd',
    );
    
    public static $TYPE = array(
        1 => '1st Tier',
        2 => '2nd Tier',
    );
    
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_pro_agent_tier_manager}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('type', 'numerical', 'integerOnly'=>true),
            array('agent_id, tier_manager_id', 'length', 'max'=>11),
            array('id, agent_id, tier_manager_id, type', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rAgent' => array(self::BELONGS_TO, 'Users', 'agent_id'),
            'rTier' => array(self::BELONGS_TO, 'Users', 'tier_manager_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'agent_id' => 'Agent',
            'tier_manager_id' => 'Tier Manager',
            'type' => 'Type',
        );
    }


    public function search()
    {
            $criteria=new CDbCriteria;

            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.agent_id',$this->agent_id,true);
            $criteria->compare('t.tier_manager_id',$this->tier_manager_id,true);
            $criteria->compare('t.type',$this->type);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
        'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
        ),
            ));
    }

    /*
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
	*/

    public function defaultScope()
    {
        return array(
                //'condition'=>'',
        );
    }
    
    /**
     * @Author: ANH DUNG Apr 04, 2014
     * @Todo: save agent 
     * @Param: $mUser model user
     * @Param: $arrItemId is array post tier id
     */    
    public static function saveAgentTier($mUser, $arrItemId){
        $type = ProAgentTierManager::TYPE_AGENT_TIER;
        self::deleteByAgentId($mUser->id, $type);
        if(is_array($arrItemId) && count($arrItemId)){
            $aRowInsert = array();
             foreach ($arrItemId as $key=>$item) {
                    $type_tier = $_POST['type_tier'][$key];
                    $aRowInsert[]="('$mUser->id',
                    '$item',
                    '$type_tier',
                    '$type'    
                    )";
                }
            $tableName = self::model()->tableName();
            $sql = "insert into $tableName (
                    agent_id,
                    tier_manager_id,
                    type_tier,
                    type
                ) values ".implode(',', $aRowInsert);
            if(count($aRowInsert)>0)
                Yii::app()->db->createCommand($sql)->execute();
        }
    }
    
    /**
     * @Author: ANH DUNG Apr 04, 2014
     * @Todo: delete tier by agent id
     * $agent_id
     * $type ProAgentTierManager::TYPE_AGENT_TIER=1
     */    
    public static function deleteByAgentId($agent_id, $type){
        self::model()->deleteAll("agent_id=$agent_id AND type=$type");
    }
    
    /**
     * @Author: ANH DUNG Jul 04, 2014
     * @Todo: get second tier of this first tier ($tier_manager_id is agent_id )
     * @Param: $tier_manager_id
     * @Return: uid
     */    
    public static function getSecondTier($tier_manager_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.agent_id', $tier_manager_id);
        $criteria->compare('t.type', ProAgentTierManager::TYPE_AGENT_TIER);
        $criteria->compare('t.type_tier', 1);
        $model = self::model()->find($criteria);
        if($model)
            return $model->tier_manager_id;
        return 0;
    }
    
    
    /**
     * @Author: ANH DUNG Jan 23, 2015
     * @Todo: get Downline  Sales Persons
     * http://localhost/verz/propertyinfo/member/dashboard
     * @Param: $user_id
     */
    public static function GetListIdDownlineSalesPersons( $user_id,  $type_tier) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.tier_manager_id', $user_id);
        $criteria->compare('t.type', ProAgentTierManager::TYPE_AGENT_TIER);
        $criteria->compare('t.type_tier', $type_tier);
        return self::model()->findAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Jan 23, 2015
     * @Todo: get array model user Downline  Sales Persons
     * @Param: $user_id
     */
    public static function GetArrModelDownlineSalesPersons($user_id, $type_tier) {
        $aModelAgentTier = self::GetListIdDownlineSalesPersons($user_id, $type_tier);
        $aUid = CHtml::listData($aModelAgentTier,'agent_id','agent_id');
        return Users::getModelByListUid($aUid);
    }
    
}