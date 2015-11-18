<?php

/**
 * This is the model class for table "{{_pro_opportunity}}".
 *
 * The followings are the available columns in table '{{_pro_opportunity}}':
 * @property integer $id
 * @property string $title
 * @property integer $country_id
 * @property string $department
 * @property string $posted
 */
class ProOpportunity extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProOpportunity the static model class
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
            return '{{_pro_opportunity}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('country_id', 'numerical', 'integerOnly'=>true),
            array('title, department', 'length', 'max'=>255),
            array('job_description, requirements, id, title, country_id, department, posted', 'safe'),
            array('title, country_id, department, posted', 'required', 'on'=>'create, update'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'country' => array(self::BELONGS_TO, 'AreaCode', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Job Title',
            'country_id' => 'Country',
            'department' => 'Department',
            'posted' => 'Posted',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('t.id',$this->id);
        $criteria->compare('t.title',$this->title,true);
        $criteria->compare('t.country_id',$this->country_id);
        $criteria->compare('t.department',$this->department,true);
        $date = DateHelper::toDbDateFormat_tuan($this->posted);
        if (!empty($date)) {
            $criteria->addCondition('DATE(t.posted) = "'.$date.'"'); 
        }
        $criteria->order = 't.id desc';

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

    protected function beforeSave() {
        if(!empty($this->posted) && strpos($this->posted, '/')){
            $this->posted = MyFormat::dateConverDmyToYmd($this->posted);
        }
        return parent::beforeSave();
    }
    
    public function behaviors() {
        return array(
            'sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('title'),
                'unique' => true,
                'update' => true,
            ),
        );
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: get model by slug
     * @Param: $model
     */
    public static function GetBySlug($slug) {
//        self::SlugUpdateAll();
        $criteria = new CDbCriteria();
        $criteria->compare('t.slug', $slug);
        return self::model()->find($criteria);
    }
    
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: update all slug
     * @Param: $model
     */
    public static function SlugUpdateAll() {
        $models = self::model()->findAll();
        foreach($models as $item)
            $item->update();
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: something
     * @Param: $model
     */
    public static function GetCountry($model) {
        $mCountry = $model->country;
        if($mCountry){
            return $mCountry->area_name;
        }
        return '';
    }
}