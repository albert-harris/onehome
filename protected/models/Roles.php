<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: Roles.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */

/**
 * This is the model class for table "{{roles}}".
 *
 * The followings are the available columns in table '{{roles}}':
 * @property integer $id
 * @property string $role_name
 * @property string $role_short_name
 * @property integer $application_id
 */
class Roles extends CActiveRecord
{
//        public static  $aRoleRestrict = array(ROLE_MANAGER);
        public static  $aRoleRestrict = array(ROLE_MANAGER, ROLE_ADMIN);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Roles the static model class
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
		return '{{_roles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            return array(
                array('role_name', 'required'),
                array('role_name, role_short_name', 'length', 'max'=>255),
                array('id, role_name, role_short_name, application_id,status', 'safe'),
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
                    'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
                    'rUser' => array(self::HAS_MANY, 'Users', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_name' => 'Role Name',
			'role_short_name' => 'Role Short Name',
			'application_id' => 'Application',
			'status' => 'Status',                    
		);
	}

	/**
	 * Loads the application items for the specified type from the database.
	 * @param boolean the item is empty
	 */
	public static function loadItems($emptyOption=false)
	{
            $criteria=new CDbCriteria;
            $criteria->compare('application_id',BE);
            $criteria->compare('status', STATUS_ACTIVE);
            $criteria->addNotInCondition('t.id', Roles::$aRoleRestrict);
            $models=self::model()->findAll($criteria);
            return CHtml::listData($models,'id','role_name');
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
            $criteria->addNotInCondition('t.id', Roles::$aRoleRestrict);
            $criteria->compare('id',$this->id);
            $criteria->compare('role_name',$this->role_name,true);
            $criteria->compare('role_short_name',$this->role_short_name,true);
            $criteria->compare('application_id',$this->application_id);
            $criteria->order = "id DESC";

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
	}

	public function adminDelete(){
		
		// 1 delete foreign table Roles
		RolesMenus::model()->deleteAllByAttributes(array('role_id'=>$this->id));

		// 2 delete foreign table Menus
		Users::model()->deleteAllByAttributes(array('role_id'=>$this->id));

		// 4 delete table Applications
		$this->delete();
		
	}
	
	public function userDelete(){
            $this->status = 0;
            $this->update();		
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
    
        public static function getAppicationIdByRoleId($role_id){        
        $model = Roles::model()->findByPk($role_id);
        if($model)
            return $model->application_id;
        return 0;
    }

    public static function getNameRoleById($role_id){
        $model = Roles::model()->findByPk($role_id);
        if($model)
            return $model->role_name;
        return '';
    }
    
    /**
     * @Author: ANH DUNG May 12, 2014
     * @Todo: list option for dropdown
     */
    public static function listOptions(){
        $criteria = new CDbCriteria();
        $criteria->compare("t.application_id", BE);
        $criteria->order = 't.id DESC';
        $models = self::model()->findAll($criteria);
        return CHtml::listData($models, 'id', 'role_name');
    }

                
        
}