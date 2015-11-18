<?php

/**
 * This is the model class for table "{{_actions_roles}}".
 *
 * The followings are the available columns in table '{{_actions_roles}}':
 * @property integer $id
 * @property integer $roles_id
 * @property integer $action_id
 * @property string $can_access
 */
class ActionsRoles extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ActionsRoles the static model class
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
            return '{{_actions_roles}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('roles_id, controller_id', 'numerical', 'integerOnly'=>true),
                    array('can_access', 'length', 'max'=>10),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, roles_id, can_access', 'safe', 'on'=>'search'),
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
                    'roles_id' => 'Roles',
                    'action_id' => 'Action',
                    'can_access' => 'Can Access',
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
            $criteria->compare('roles_id',$this->roles_id);
            $criteria->compare('can_access',$this->can_access,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }
    
    //bb code - ANH DUNG ADD MAY 08, 2014
    public static function getActionArrayByRoleIdAndControllerId($roles_id, $controller_id, $can_access = 'allow')
    {
        $aActions = array();
        $criteria = new CDbCriteria;
        $criteria->compare('t.roles_id', $roles_id);
        $criteria->compare('t.controller_id', $controller_id);
        $criteria->compare('t.can_access', $can_access);
        $model = self::model()->find($criteria);
        if ($model)
        {
            if(!empty($model->actions))
            {
                $aActions = explode(',', $model->actions); // bug: ANH DUNG FIX NOW 14, 2014( remove space explode)
            }
        }
        
        // Jan 26, 2015 fix only for this project, một số project cũ thì chỗ này nó còn khoảng trắng sau khi explode ra
        $aActions = array_map('trim', $aActions);
        // Jan 26, 2015 fix only for this project
        
        return $aActions;
    }
    //bb code - ANH DUNG ADD MAY 08, 2014    
    
}