<?php

/**
 * This is the model class for table "{{_pro_testimonial}}".
 *
 * The followings are the available columns in table '{{_pro_testimonial}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property integer $sort_order
 * @property string $created_date
 */
class ProTestimonial extends CActiveRecord {

    public static $ARR_TYPE = array(
        ROLE_LANDLORD=> "Landlord",
        ROLE_TENANT=>"Tenant",
        ROLE_AGENT=>"Salesperson"
    );
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProTestimonial the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{_pro_testimonial}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name,description,type', 'required', 'on'=>'create,update'),
            array('name', 'length', 'max' => 256),
            array('type, id, title, name, description, status, sort_order, created_date', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'rUser' => array(self::BELONGS_TO, 'Users', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Display Name',
            'description' => 'Message',
            'status' => 'Status',
            'sort_order' => 'Sort Order',
            'created_date' => 'Created Date',
            'title'=>'Title',
            'is_member'=>'Created By',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.type', $this->type);
        $criteria->compare('t.title', $this->title, true);
        $criteria->compare('t.name', $this->name, true);
        $criteria->compare('t.description', $this->description, true);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.sort_order', $this->sort_order);
        $criteria->compare('t.created_date', $this->created_date, true);
         $sort = new CSort();
                $sort->attributes = array(
                    'created_date'=>array(
                            'asc'=>'t.created_date',
                            'desc'=>'t.created_date desc',
                            'default'=>'asc',
                    ),
                    'name'=>array(
                            'asc'=>'name',
                            'desc'=>'name desc',
                            'default'=>'asc',
                    ),
                    'title'=>array(
                            'asc'=>'title',
                            'desc'=>'title desc',
                            'default'=>'asc',
                    ),
                );    
         $sort->defaultOrder = 'created_date DESC'; 
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ),
             'sort'=>$sort,
        ));
    }

    public function activate() {
        $this->status = 1;
        $this->update();
    }

    public function deactivate() {
        $this->status = 0;
        $this->update();
    }

    public function defaultScope() {
        return array(
                //'condition'=>'',
        );
    }
    public function getTestimonial(){
        $criteria = new CDbCriteria;
        $criteria->compare('t.status', 1);
        $criteria->order = 't.created_date DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 4,
            ),
        ));
    }

    protected function beforeSave() {
        $this->user_id = Yii::app()->user->id;
        return parent::beforeSave();
    }
    
}