<?php

/**
 * This is the model class for table "{{_pro_property_type}}".
 *
 * The followings are the available columns in table '{{_pro_property_type}}':
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $display_order
 * @property integer $status
 * @property string $parent_id
 */
class ProPropertyType extends CActiveRecord
{
    public $strOptionGroup='';
    public static $TYPE_GURU = array(
        "Residential"=>"Residential",
        "Commercial"=>"Commercial",
    );
    
    // Mar 13, 2015 ANH DUNG
    const PROPERTY_TYPE_RETAIL = 28; // Retail
    const PROPERTY_TYPE_OFFICE = 34; // Office
    const PROPERTY_TYPE_INDUSTRIAL = 37; // Industrial 
    const PROPERTY_TYPE_LAND = 42; // Land
    public static $ARR_TYPE_COMMERCIAL = array(
        ProPropertyType::PROPERTY_TYPE_RETAIL,
        ProPropertyType::PROPERTY_TYPE_OFFICE,
        ProPropertyType::PROPERTY_TYPE_INDUSTRIAL,
        ProPropertyType::PROPERTY_TYPE_LAND,
    );
    
    // Mar 13, 2015 ANH DUNG
    
    
    // Jun 24, 2014 ANH DUNG
    public static $A_GROUP_SHOW = array(
        'gsv1'=>'gsv1 Apartment/Condo - Condominium - and Other type same',// class show hide dưới view
        'gsv2'=>'gsv2 Apartment/Condo - Cluster House -',
        'gsv3'=>'gsv3 Landed House - Terraced House and Other type same',
        'gsv4'=>'gsv4 Landed House - Land Only',
        'gsv5'=>'gsv5 - HDB Apartment',
        'gsv6'=>'gsv6 - Retail',
        'gsv7'=>'gsv7 - Office',
        'gsv8'=>'gsv8 - Industrial',
        'gsv9'=>'gsv9 - Land',
    );
    
    public static $A_FIELD_MAP = array(
        'unit_from'=>array('gsv1','gsv2','gsv5','gsv6','gsv7','gsv8'),// class show hide dưới view
        'unit_to'=>array('gsv1','gsv2','gsv5','gsv6','gsv7','gsv8'),// class show hide dưới view
        'price'=>array('gsv1','gsv2','gsv3','gsv4','gsv5','gsv6','gsv7','gsv8','gsv9'),// class show hide dưới view
        'price_select'=>array('gsv1','gsv2','gsv3','gsv4','gsv5','gsv6','gsv7','gsv8','gsv9'),// class show hide dưới view
        'price_select_other'=>array('gsv1','gsv2','gsv3','gsv4','gsv5','gsv6','gsv7','gsv8','gsv9'),// class show hide dưới view
        'office_bkank_valuation'=>array('gsv1','gsv2','gsv3','gsv4','gsv5','gsv6','gsv7','gsv8','gsv9'),// class show hide dưới view
        'of_bedroom'=>array('gsv1','gsv2','gsv3','gsv5'),// class show hide dưới view
        'of_bathrooms'=>array('gsv1','gsv2','gsv3','gsv4','gsv5'),// class show hide dưới view
        'floor_area'=>array('gsv1','gsv2','gsv3','gsv5','gsv6','gsv7','gsv8'),// class show hide dưới view
        'land_area'=>array('gsv2','gsv3','gsv4','gsv9'),// class show hide dưới view
        'hdb_town_estate'=>array('gsv5'),// class show hide dưới view
    );
    
    public static $A_FIELD_REQUIRED = array( // cái này hình như chưa dùng
        // mà hình như sẽ không dùng đến, vì nó dc fix cứng cho từng rule rồi, chỉ để xem
        'gsv1'=>array('of_bedroom','floor_area'),
        'gsv2'=>array('of_bedroom','floor_area','land_area'),
        'gsv3'=>array('of_bedroom'),// class show hide dưới view
        'gsv4'=>array('land_area'),
        'gsv5'=>array('hdb_town_estate','of_bedroom','floor_area'),
        'gsv6'=>array('floor_area'),
        'gsv7'=>array('floor_area'),
        'gsv8'=>array('floor_area'),
        'gsv9'=>array('land_area'),
    );

    public static $A_FIELD_OF_SCENARIO = array(
        'gsv1'=>array('unit_from','unit_to','price','asking_price_select',
                    'asking_price_select_other','of_bedroom','floor_area'
                    ,'of_bathrooms',
                    ), // Apartment / Condo
        'gsv2'=>array('unit_from','unit_to','price','asking_price_select',
                    'asking_price_select_other','of_bedroom','floor_area','land_area'
                    ,'of_bathrooms',
                    ),
        'gsv3'=>array('price','asking_price_select', 
                    'asking_price_select_other','of_bedroom','floor_area','land_area'
                    ,'of_bathrooms',
                    ),// Landed House
        'gsv4'=>array('price','asking_price_select',
                    'asking_price_select_other','land_area'),
        'gsv5'=>array('unit_from','unit_to','hdb_town_estate','price','asking_price_select',
                    'asking_price_select_other','of_bedroom','floor_area'
                ,'of_bathrooms',
            ),// HDB Apartment
        'gsv6'=>array('unit_from','unit_to','price','asking_price_select', // Retail
                    'asking_price_select_other','floor_area'
                ,'of_bathrooms',
            ),
        'gsv7'=>array('unit_from','unit_to','price','asking_price_select',
                    'asking_price_select_other','floor_area'), // Office
        'gsv8'=>array('unit_from','unit_to','price','asking_price_select',
                    'asking_price_select_other','floor_area'), // Industrial
        'gsv9'=>array('unit_from','unit_to','price','asking_price_select',
                    'asking_price_select_other','land_area'), // Land

    );

    public static $AD_NB_PRICE_SIGN = array(
        '$'=>'$',
        'psf'=>'psf',
    );
    
    const P_BEFORE = 'before';
    const P_AFTER = 'after';
    
    public static $AD_NB_PRICE_SIGN_POSITION = array(
        ProPropertyType::P_BEFORE=>'before',
        ProPropertyType::P_AFTER=>'after',
    );
    
    public static function getListOptionPriceSign(){
        return ProPropertyType::$AD_NB_PRICE_SIGN;
    }
    public static function getListOptionPriceSignPosition(){
        return ProPropertyType::$AD_NB_PRICE_SIGN_POSITION;
    }
    
    const SEARCH_ALL = -1;
    const SEARCH_APARTMENT_CONDO = 1;
    const SEARCH_LANDED_HOUSE = 2;
    const SEARCH_HDB = 18;
    const SEARCH_RETAIL = 28;
    const SEARCH_INDUSTRIAL = 37;
    const SEARCH_OFFICE = 34;
    const SEARCH_LAND = 42;
    
    public static $ARR_TYPE_SEARCH = array(
        ProPropertyType::SEARCH_ALL=>'All property types',
        ProPropertyType::SEARCH_APARTMENT_CONDO=>'Apartment/Condo',
        ProPropertyType::SEARCH_LANDED_HOUSE=>'Landed House',
        ProPropertyType::SEARCH_HDB=>'HDB Apartment',
        ProPropertyType::SEARCH_RETAIL=>'Retail',
        ProPropertyType::SEARCH_INDUSTRIAL=>' Industrial',
        ProPropertyType::SEARCH_OFFICE=>'Office',
        ProPropertyType::SEARCH_LAND=>'Land',
    );
    
    public static $ARR_TYPE_SEARCH_HAVE_SUB = array(
        ProPropertyType::SEARCH_APARTMENT_CONDO,
        ProPropertyType::SEARCH_LANDED_HOUSE,
    );    
    
    /**
     * @Author: ANH DUNG Jul 23, 2014
     * @Todo: format view list property type of engage us , bank request
     * AT: zii.widgets.CDetailView
     * @Param: $model model BankRequest OR model GlobalEnquiry
     */
    public static function FormatViewProperyType($model){
        $PropertyTypeList = isset(ProPropertyType::$ARR_TYPE_SEARCH[$model->choosetype])?ProPropertyType::$ARR_TYPE_SEARCH[$model->choosetype]:'';
        $aPropertyType='';
        if(in_array($model->choosetype, ProPropertyType::$ARR_TYPE_SEARCH_HAVE_SUB) && $model->property_type_code!=''){
            $aPropertyType = explode(',', $model->property_type_code);
            $aPropertyType = ProPropertyType::getListOptionByListId($aPropertyType, 'name', 'name');
            $aPropertyType = '- ' . implode('<br>- ', $aPropertyType);

        }
        return $PropertyTypeList = "<b>$PropertyTypeList</b> <br> " . $aPropertyType;        
    }
    

    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    public function tableName()
    {
            return '{{_pro_property_type}}';
    }

    public function rules()
    {
        return array(
            array('name', 'required'),
            array('id, name, slug, display_order, status, parent_id, type', 'safe'),
            array('group_show', 'safe'),
            array('price_min,price_max,price_sign,price_sign_position', 'safe'),
        );
    }

    public function relations()
    {
            return array(
                'parent' => array(self::BELONGS_TO, 'ProPropertyType', 'parent_id'),
                'rParent' => array(self::BELONGS_TO, 'ProPropertyType', 'parent_id'),
            );
    }

    public function attributeLabels()
    {
            return array(
                    'id' => 'ID',
                    'name' => 'Name',
                    'slug' => 'Slug',
                    'display_order' => 'Display Order',
                    'status' => 'Status',
                    'parent_id' => 'Parent',
                    'type' => 'Type',
                    'price_min' => 'Price Minimum',
                    'price_max' => 'Price Maximum',
            );
    }

    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('t.id',$this->id,true);
        $criteria->compare('t.name',$this->name,true);
        $criteria->compare('t.slug',$this->slug,true);
        $criteria->compare('t.display_order',$this->display_order,true);
        $criteria->compare('t.status',$this->status);
        $criteria->compare('t.parent_id',$this->parent_id);
        $criteria->compare('t.type',$this->type);
        $sort = new CSort();
        $sort->attributes = array(
            'name'=>'name',
            'status'=>'status',
            'status'=>'status',
            'parent_id'=>'parent_id',
            'type'=>'type',
        );    
        $sort->defaultOrder = 't.id DESC'; 
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
            ),
            'sort' => $sort,
        ));
    }

    
    public function activate()
    {
        $this->status = 1;
        $this->update(array('status'));
    }

    public function deactivate()
    {
        $this->status = 0;
        $this->update(array('status'));
    }
	

    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }

    public static function haschild($id, $arrobj) {
	foreach ($arrobj as $obj)
	    if ($obj->parent_id == $id)
		return 1;
	return 0;
    }    
    
    public static function oMenu($parent_id,$menus,$value,$res = '',$sep = ''){
        foreach($menus as $m){
            $temp_id        = $m->id;
            $temp_parent_id = $m->parent_id;
            if($temp_parent_id == $parent_id)
            {
                if($temp_id == $value ){
                    $selected = 'selected="selected"';
                    $style = " style='color:#AD0000;font-weight:bold;' ";
                }
                else{ 
                    $selected='';
                    $style = '';
                }

                if($m->parent_id == $parent_id)
                {
                    $re = '<option value="'.$m->id.'" '.$selected.$style.'>'.$sep.$m->name.'</option>';
                    $res .= ProPropertyType::oMenu($m->id,$menus,$value,$re,$sep."--> ");
                }

            }

        }
        return $res;
    }	
    
    /** use at BE
     * @Author: ANH DUNG Apr 07, 2014
     * @Todo: build html select 
     */
    public static function getDropDownList($name,$id ,$value='', $hasEmpty=false,$classSelect=null){
        $criteria = new CDbCriteria();
        $criteria->order = 'parent_id ASC, name asc';
        $menus = ProPropertyType::model()->findAll($criteria);

        $strSelect = '<select  class="'.$classSelect.'" name='.$name.' id='.$id.'>';

        if($hasEmpty)
                $strSelect .= '<option value="">Select</option>';
        $strSelect .= ProPropertyType::oMenu(0,$menus,$value);
        $strSelect .= '</select>';

        return $strSelect;
    }    
    
    
    public function buildSelectGroup($parent_id,$menus,$value,$res = '',$sep = '', $level = ""){
        
        foreach($menus as $m){
            $temp_id        = $m->id;
            $temp_parent_id = $m->parent_id;
            if($temp_parent_id == $parent_id)
            {
                if($temp_id == $value ){
                    $selected = 'selected="selected"';
                    $style = " style='color:#AD0000;font-weight:bold;' ";
                }
                else{ 
                    $selected='';
                    $style = '';
                }
                
                /***** new code add for optgroup *********/
                $name = $m->name;
		if(!self::haschild($temp_id,$menus)==1){
                    $countLV = count(explode('=', $level));// ANH DUNG FIX Jun 25, 2014
//                    $this->strOptionGroup.='<option ad_nb="'.$m->group_show.'" parent="'.$m->parent_id.'" value="'.$m->id.'" '.$selected.$style.'>'.$level.$sep.$m->name.'</option>';
                    $this->strOptionGroup.="<option class='ad_nb_recur_$countLV' ad_nb='$m->group_show' parent='$m->parent_id' value='$m->id' $selected $style > $m->name </option>";
                }

                if(self::haschild($temp_id,$menus)==1)
                {
                    $countLV = count(explode('=', $level));// ANH DUNG FIX Jun 25, 2014
                    $this->strOptionGroup.="<optgroup class='ad_nb_recur_".$countLV."' label='".$m->name."'>";                    
                    $this->buildSelectGroup($m->id,$menus,$value,'',$sep."", $level.'=');                    
//                    $this->buildSelectGroup($m->id,$menus,$value,'',$sep."&nbsp;&nbsp; ", $level.'=');                    
                    $this->strOptionGroup.="</optgroup>";
                }
                /***** new code add for optgroup *********/

            }

        }
    }	

    /**  use for FE search and Member module
     * @Author: ANH DUNG Apr 07, 2014
     * @Todo: render ra select group cho property type
     * @Param: $name select
     * @Param: $id model user
     * @Param: $value value selected
     * @Param: $hasEmpty is string for empty value: ex: Select, All property types
     * @Return: string html select
     */
    public static function getDropDownSelectGroup($name,$id ,$value='', $hasEmpty='',$classSelect=null){
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = 'parent_id ASC, name asc';
        $aPropertyType = ProPropertyType::model()->findAll($criteria);

        $strSelect = '<select  class="'.$classSelect.'" name='.$name.' id='.$id.'>';
        $mPropertyType = new ProPropertyType();
        if(trim($hasEmpty)!='')
                $strSelect .= "<option value=''>$hasEmpty</option>";
        $mPropertyType->buildSelectGroup(0,$aPropertyType,$value);
        $strSelect .= $mPropertyType->strOptionGroup;
        
        $strSelect .= '</select>';

        return $strSelect;
    }        
        
        
    public function behaviors()
    {
        return array('sluggable' => array(
        'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
        'columns' => array('name'),
        'unique' => true,
        'update' => true,
        ), );
    }          
    
    protected function beforeSave()
    {
//        if(parent::beforeSave())
//        {
            if(!$this->isNewRecord)
            {
                // Begin không cho update menu thụt cấp sâu vào trong, chỉ cho update lên cấp trên
                $old_record = ProPropertyType::model()->findByPk($this->id);
                $parent_old = $old_record->parent_id;
                $menus = ProPropertyType::model()->findAll();
                $idChild = ProPropertyType::model()->findAllChild($this->id,$menus);
                if(in_array($this->parent_id, $idChild))
                {
                    self::updateParent($this->id, $parent_old);
//                    $this->parent_id = $old_record->parent_id;
                }
                // End không cho update menu thụt cấp sâu vào trong, chỉ cho update lên cấp trên
                //  Mar 25, 2014 sửa lại chỗ này, cho phép update parent_id kể cả thụt cấp sâu vào trong
                // ta sẽ cập nhật hết các record có parent là thằng A = parent của A
            }
//        }
            
          if($this->rParent){
              $this->type = $this->rParent->type;
          }
            
       return parent::beforeSave(); 
    }    
    
    // Truyền vào 1 đối tượng 
    // Trả về mảng đối tượng là tất cả các con của đối tượng truyền vào
    public function findAllChild($menu_id){
        $queue = array($menu_id);
        $d=0;$c=0;
        while($d<=$c){
            $item_id = $queue[$d];
            $d++;
            $arr_child = self::findchildLevel1($item_id);
            //var_dump($arr_child);die;
            for($i=0;$i<count($arr_child);$i++){
                    $queue[] = $arr_child[$i]->id;;
                    $c++;
            }
        }
        return $queue;
    }

    public function findchildLevel1($id)
    {
        if(!empty($id))
            return self::model()->findAll(array('condition'=>'parent_id='.$id));
        return array();
    }    
   
    public static function findParentById($id){
        $model = self::model()->findByPk($id);
        if (isset($model)) {
            if($model->parent_id != 0){
                return self::findParentById($model->parent_id);
            }
            else {
                return $model;
            }
        }
        else{
            return null;
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 25, 2014
     * @Todo: cập nhật parent id cho các record khi một parent bị update đẩy lùi vào cấp con của parent đó
     * @Param: $parent_id_old 
     * @Param: $parent_id_new 
     */
    public static function updateParent($parent_id_old, $parent_id_new){
        $criteria = new CDbCriteria();
        $criteria->compare('t.parent_id', $parent_id_old);
        $models = self::model()->findAll($criteria);
        $sql='';
        $tableName = self::model()->tableName();
        if(count($models)){
            foreach($models as $item){
                $sql .= "UPDATE $tableName SET `parent_id`=$parent_id_new WHERE `id`=$item->id ;";
            }
            //UPDATE mytable SET (id, column_a, column_b) FROM VALUES ( (1, 12, 6), (2, 1, 45), (3, 56, 3), … );
            Yii::app()->db->createCommand($sql)->execute();
        }
    }
    
    //HThoa
    public static function findForSearch() {
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->order = 't.display_order ASC';
        $result = self::model()->findAll($criteria);
        return  CHtml::listData($result, 'id', 'name');
    }

    //Kvan
    public static function getListDataPropertyType(){
        $model = self::model()->findAll(array('condition'=>'status = '.STATUS_ACTIVE.' AND parent_id <> 0'));
        return CHtml::listData($model, 'id', 'name','parent.name');
    }
    
    /**
     * @Author: ANH DUNG Apr 29, 2014
     * @Todo: get name of Property Type
     * @Param: number $pk
     * @Return: string name
     */
    public static function getName($pk){
        $model = self::model()->findByPk($pk);
        if($model)
            return $model->name;
        return '';
    }
    
    /** use at FE
     * @Author: ANH DUNG Jun 24, 2014
     * @Todo: get data select property type
     */
    public static function getListOptionParent($needMore=array()){
        $criteria = new CDbCriteria();
        $criteria->compare("t.parent_id", 0);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->addCondition("t.type<>'' AND t.type IS NOT NULL ");
        $criteria->order = 'type DESC';
        $models = ProPropertyType::model()->findAll($criteria);
        if(isset($needMore['model_only'])){
            return $models;
        }
        if(isset($needMore['normal_select'])){
            return CHtml::listData($models,'id','name');
        }
        return CHtml::listData($models,'id','name','type');
    }
    
    /**  use for FE search and Member module
     * @Author: ANH DUNG Apr 07, 2014
     * @Todo: render ra select group cho property type
     * @Param: $name select
     * @Param: $id model user
     * @Param: $value value selected
     * @Param: $hasEmpty is string for empty value: ex: Select, All property types
     * @Return: string html select
     */
    public static function getOptionSelectGroupByParent($parent_id, $name,$id ,$value='', $hasEmpty='',$classSelect=null){
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', STATUS_ACTIVE);
//        $criteria->compare('t.parent_id', $parent_id);
        
        $criteria->order = 'parent_id ASC, name asc';
        $aPropertyType = ProPropertyType::model()->findAll($criteria);

        $strSelect = '<select  class="'.$classSelect.'" name='.$name.' id='.$id.'>';
        $mPropertyType = new ProPropertyType();
        if(trim($hasEmpty)!='')
                $strSelect .= "<option value=''>$hasEmpty</option>";
        $mPropertyType->buildSelectGroup($parent_id, $aPropertyType,$value);
        $strSelect .= $mPropertyType->strOptionGroup;
        
        $strSelect .= '</select>';
        return $strSelect;
    }    
    
    /**
     * @Author: ANH DUNG Jun 26, 2014
     * @Todo: get group show đồng thời là scenario validate
     * @Param: $pk
     * @Return: string
     */    
    public static function getScenarioGroupShow($pk){
        if(empty($pk)) return '';
        $model = self::model()->findByPk((int)$pk);
        if($model)
            return $model->group_show;
        return '';
    }
    /**
     * @Author: ANH DUNG Jun 27, 2014
     * @Todo: format price min max of this property
     * @Param: $model
     * @Return: string
     */    
    public static function formatPriceMinMax($model, $fieldName){
        $price = MyFormat::formatPrice($model->$fieldName);
        if($model->price_sign_position==ProPropertyType::P_BEFORE)
            $price = "$model->price_sign".$price;
        else
            $price = $price."$model->price_sign";
        return $price;
    }
    
        
    /**
     * @Author: ANH DUNG Jul 01, 2014
     * @Todo: get listoption for search index
     * @Param: $parent_id
     * @Return: chtm list
     */    
    public static function getListOptionByParent($parent_id) {
//        if(!in_array($parent_id, ProPropertyType::$ARR_TYPE_SEARCH_HAVE_SUB))
//            return array();
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.parent_id', $parent_id);
        $criteria->order = 't.name ASC';
        $result = self::model()->findAll($criteria);
        return  CHtml::listData($result, 'id', 'name');
    }
    
    /**
     * @Author: ANH DUNG Jul 17, 2014
     * @Param: $aId, $key, $value
     * @Return: chtm list
     */    
    public static function getListOptionByListId($aId, $key, $value) {        
        $criteria = new CDbCriteria();
//        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->addInCondition('t.id', $aId);
        $criteria->order = 't.name ASC';
        $result = self::model()->findAll($criteria);
        return  CHtml::listData($result, $key, $value);        
    }
    
    
}