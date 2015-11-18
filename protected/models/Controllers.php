<?php

/**
 * This is the model class for table "{{_controllers}}".
 *
 * The followings are the available columns in table '{{_controllers}}':
 * @property integer $id
 * @property string $controller_name
 * @property integer $module_id
 */
class Controllers extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Controllers the static model class
     */
    public static function model($className = __CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return '{{_controllers}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('controller_name, module_name', 'required'),
            array('controller_name, module_name', 'checkExistController'),
            array('id, controller_name, module_name, actions', 'safe'),
        );
    }

    public function checkExistController($attribute,$params)
    {
        if ($this->controller_name != '' && $this->module_name) 
        {
            if ($this->isNewRecord)
            {
                    $criteria = new CDbCriteria;
                    $criteria->compare('controller_name', $this->controller_name);
                    $criteria->compare('module_name', $this->module_name);
                    $existRecord = Controllers::model()->find($criteria);
                    if (!empty($existRecord))
                            $this->addError($attribute, 'This controller exists in our database!');
            }
            else {
                    $criteria = new CDbCriteria;
                    $criteria->compare('controller_name', $this->controller_name);
                    $criteria->compare('module_name', $this->module_name);
                    $criteria->addCondition('t.id <> ' . $this->id);
                    $existRecord = Controllers::model()->find($criteria);
                    if (!empty($existRecord))
                            $this->addError($attribute, 'This controller exists in our database!');
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
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
            'controller_name' => 'Controller Name',
            'module_name' => 'Module',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('controller_name', $this->controller_name, true);
        $criteria->compare('module_name', $this->module_name);
        $criteria->order = 't.id DESC';

        return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'Pagination' => array(
                        'PageSize' => 50, //edit your number items per page here
                ),
        ));
    }

    public function getControllerByName($name)
    {
        $criteria = new CDbCriteria;
        $criteria->compare('controller_name', $name);
        return Controllers::model()->find($criteria);
    }
    
    //save group roles - PDQuang
//	public function addGroupRoles($post) // ANH DUNG FIX Dec 19, 2014
    public function addGroupRoles($post, $roles = NULL)
    {
        try {
            $allow_actions = $deny_actions = array();

            foreach($post as $key => $value)
            {
                if($value == 'allow')
                {
                    $allow_actions[] = $key;
                }
                if($value == 'deny')
                {
                    $deny_actions[] = $key;
                }
            }
            $allow_actions = implode(',', $allow_actions);  
            $deny_actions = implode(',', $deny_actions);

            if($roles == NULL)
                $roles = Yii::app()->session['roles'] ;
            $allow_actionsRole = ActionsRoles::model()->find('controller_id = '.$this->id.' and roles_id = '.$roles.' and can_access like "allow"');
            $deny_actionsRole = ActionsRoles::model()->find('controller_id = '.$this->id.' and roles_id = '.$roles.' and can_access like "deny"');

            if($allow_actionsRole)
            {
                $allow_actionsRole->actions = $allow_actions;
            }
            else
            {
                $allow_actionsRole = new ActionsRoles;
                $allow_actionsRole->roles_id = $roles;
                $allow_actionsRole->controller_id = $this->id;
                $allow_actionsRole->can_access = 'allow';
                $allow_actionsRole->actions = $allow_actions;                        
            }

            if($deny_actionsRole)
            {
                $deny_actionsRole->actions = $deny_actions;
            }
            else
            {
                $deny_actionsRole = new ActionsRoles;
                $deny_actionsRole->roles_id = $roles;
                $deny_actionsRole->controller_id = $this->id;
                $deny_actionsRole->can_access = 'deny';
                $deny_actionsRole->actions = $deny_actions;                        
            }

            $allow_actionsRole->save();
            $deny_actionsRole->save();
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }

    }

    //save user roles - PDQuang
    // ANH DUNG FIX Dec 19, 2014
    public function addUserRoles($post, $user_id = NULL)
    {
        try {
            $allow_actions = $deny_actions = array();

            foreach($post as $key => $value)
            {
                if($value == 'allow')
                {
                    $allow_actions[] = $key;
                }
                if($value == 'deny')
                {
                    $deny_actions[] = $key;
                }
            }
            $allow_actions = implode(',', $allow_actions);  
            $deny_actions = implode(',', $deny_actions);  

            if($user_id == NULL)
            {
                die('Dec 19, 2014 yêu cầu không hợp lệ - by ANH DUNG');
                $roles = Yii::app()->session['roles'] ;
                $user_id = Users::model()->find("username like '$roles'")->id;
            }
            $allow_actionsRole = ActionsUsers::model()->find('controller_id = '.$this->id.' and user_id = '.$user_id.' and can_access like "allow"');
            $deny_actionsRole = ActionsUsers::model()->find('controller_id = '.$this->id.' and user_id = '.$user_id.' and can_access like "deny"');

            if($allow_actionsRole)
            {
                $allow_actionsRole->actions = $allow_actions;
            }
            else
            {
                $allow_actionsRole = new ActionsUsers;
                $allow_actionsRole->user_id = $user_id;
                $allow_actionsRole->controller_id = $this->id;
                $allow_actionsRole->can_access = 'allow';
                $allow_actionsRole->actions = $allow_actions;                        
            }

            if($deny_actionsRole)
            {
                $deny_actionsRole->actions = $deny_actions;
            }
            else
            {
                $deny_actionsRole = new ActionsUsers;
                $deny_actionsRole->user_id = $user_id;
                $deny_actionsRole->controller_id = $this->id;
                $deny_actionsRole->can_access = 'deny';
                $deny_actionsRole->actions = $deny_actions;                        
            }

            $allow_actionsRole->save();
            $deny_actionsRole->save();
        }
        catch (Exception $e)
        {
            Yii::log("Exception ".  print_r($e, true), 'error');
            throw  new CHttpException("Exception ".  print_r($e, true));     
        }

    }

    public static function canAccess($action, $controller_id, $class)
    {
        try
        {
            $roles = Yii::app()->session['roles'];
            $obj = new $class;

            if ($class == 'ActionsRoles')
            {
                    $actions = ActionsRoles::model()->findAll('controller_id = ' . $controller_id . ' and roles_id = ' . $roles);
            }
            else
            {
                    $user_id = Users::model()->find("username like '$roles'")->id;
                    $actions = ActionsUsers::model()->findAll('controller_id = ' . $controller_id . ' and user_id = ' . $user_id);
            }

            foreach ($actions as $key => $model)
            {
                    $array_action = array_map('trim', explode(",", trim($model->actions)));
                    foreach ($array_action as $key2 => $value)
                    {
                            if (strtolower($value) == strtolower($action))
                            {
                                    return $model->can_access;
                            }
                    }
            }
            return 'allow';
        }
        catch (Exception $e)
        {
                Yii::log("Exception " . print_r($e, true), 'error');
                throw new CHttpException("Exception " . print_r($e, true));
        }
    }

    //bb code - ANH DUNG ADD Jan 26, 2015
    public static function getByName($name)
    {
        return Controllers::model()->find('LOWER(controller_name)="'.  strtolower($name).'"');
    }        
    //bb code - ANH DUNG ADD Jan 26, 2015
}
