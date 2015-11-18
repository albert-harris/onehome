<?php

/**
 * This is the model class for table "{{_pro_agent_district}}".
 *
 * The followings are the available columns in table '{{_pro_agent_district}}':
 * @property string $id
 * @property string $agent_id
 * @property string $district_id
 */
class ProAgentDistrict extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProAgentDistrict the static model class
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
            return '{{_pro_agent_district}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('agent_id, district_id', 'length', 'max'=>11),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, agent_id, district_id', 'safe', 'on'=>'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
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
                    'district_id' => 'District',
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

            $criteria->compare('t.id',$this->id,true);
            $criteria->compare('t.agent_id',$this->agent_id,true);
            $criteria->compare('t.district_id',$this->district_id,true);

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
     * @Author: ANH DUNG May 23, 2014
     * @Todo: save access districts of agent  
     * @Param: $mUser model user
     * @Param: $arrItemId is array post district id
     */    
    public static function saveAgentDistict($mUser, $arrItemId){
        self::deleteByAgentId($mUser->id);
        if(is_array($arrItemId) && count($arrItemId)){
            $aRowInsert = array();
             foreach ($arrItemId as $key=>$item) {
                    $aRowInsert[]="('$mUser->id',
                    '$item'
                    )";
                }
            $tableName = self::model()->tableName();
            $sql = "insert into $tableName (
                    agent_id,
                    district_id
                ) values ".implode(',', $aRowInsert);
            if(count($aRowInsert)>0)
                Yii::app()->db->createCommand($sql)->execute();
        }
    }
    
    /**
     * @Author: ANH DUNG Apr 04, 2014
     * @Todo: delete district by agent id
     * $agent_id
     */    
    public static function deleteByAgentId($agent_id){
        self::model()->deleteAll("agent_id=$agent_id");
    }
            
    /**
     * @Author: ANH DUNG Jul 14, 2014
     * @Todo: get all district by agent id
     * $agent_id
     */    
    public static function GetByAgentId($agent_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.agent_id', $agent_id);
        return CHtml::listData(self::model()->findAll($criteria), 'district_id', 'district_id');
    }
            
        
}