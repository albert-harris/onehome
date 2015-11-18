<?php

/**
 * This is the model class for table "{{_categories}}".
 *
 * The followings are the available columns in table '{{_categories}}':
 * @property integer $id
 * @property string $category_name
 * @property integer $display_order
 * @property integer $published
 * @property integer $parent_id
 */
class Categories extends CActiveRecord {
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{_categories}}';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
            return array (
                array ('category_name', 'required' ), 
                array ('category_name', 'length', 'max' => 255 ), // The following rule is used by search().
		array ('id, category_name, slug, display_order, published, parent_id', 'safe' ) );
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations() {
            return array(
              'getparent' => array(self::BELONGS_TO, 'Categories', 'parent_id'),
              'childs' => array(self::HAS_MANY, 'Categories', 'parent_id',  'order'=>'category_name ASC'),
           );
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array ('id' => 'ID', 'category_name' => 'Category Name', 'display_order' => 'Display Order', 'published' => 'Published', 'parent_id' => 'Parent' );
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		

		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'category_name', $this->category_name, true );
		$criteria->compare ( 'display_order', $this->display_order );
		$criteria->compare ( 'published', $this->published );
		$criteria->compare ( 'parent_id', $this->parent_id );
		
		return new CActiveDataProvider ( $this, array ('criteria' => $criteria ) );
	}
	
	public function searchFE() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		

		$criteria = new CDbCriteria ();
		
		$criteria->compare ( 'id', $this->id );
		$criteria->compare ( 'category_name', $this->category_name, true );
		$criteria->compare ( 'display_order', $this->display_order );
		$criteria->compare ( 'published', $this->published );
		$criteria->compare ( 'parent_id', $this->parent_id );
		//$criteria->order = " category_name ASC";
		return new CActiveDataProvider ( $this, array ('criteria' => $criteria, 'pagination' => false) );
	}
	
	public function getCatBySlug($slug)
	{
	    $criteria = new CDbCriteria ();
	    $criteria->compare ( 'category_slug', $slug);
	    return Categories::model ()->find($criteria);
	}
	
	public function categoryDropdown()
	{
		$listCategories = $this->getCategoryTree();
		$data = array(''=>'-- All --');
		foreach ($listCategories as $item)
		{
			$tree = "";
			if ($item->level > 0) 
			{
				$tree = "";
				for ($i = 0 ; $i < $item->level; $i++ )
					$tree .= "---- ";
			}
			 
			$data [$item->category_slug]= $tree . $item->category_name;
		}
		return $data;
	}
	
	public function categoryDropdownBackend()
	{
		$listCategories = $this->getCategoryTree();
		
		$data = array(''=>'--All--');
		foreach ($listCategories as $item)
		{
			$tree = "";
			if ($item->level > 0) 
			{
				$tree = "";
				for ($i = 0 ; $i < $item->level; $i++ )
					$tree .= "---";
			}
			 
			$data [$item->id]= $tree . $item->category_name;
		}
		return $data;
	}

	
	public function getCategoryTree()
	{
            $criteria = new CDbCriteria ();
            $criteria->compare ('parent_id', 0);
            $criteria->compare ('published', 1);  
            $criteria->order = " category_name ASC";
            $items = array();
            $categories = Categories::model ()->findAll($criteria);
            $level = 0;
            foreach($categories as $child) {
                //var_dump($child->attributes);
                $this->getListed($child, $level, $items);
            }   
            return $items; 
    }

	
	public function getListed($child, $level, &$return) {
	    $child->level = $level;
	    $return[] = $child;
	    $childItem = $child->childs;
	    if(count($childItem) > 0) 
	    {
		    foreach($childItem as $item) {
		    	if ($item->published == 1)
		    	{
			    	$level++;
			        $this->getListed($item, $level, $return);
			        $level--;
		    	}
		    }
	    }   
	}
	
	public static function getDropDownList($name, $id, $value = '', $hasEmpty = false) {
		
		$category = Categories::model ()->findAll ();
		
		$strSelect = '<select name=' . $name . ' id=' . $id . '>';
		
		if ($hasEmpty)
			$strSelect .= '<option value="0">Root</option>';
		$strSelect .= Categories::model ()->categoryList ( 0, $category, $value );
		$strSelect .= '</select>';
		
		return $strSelect;
	}
	public function categoryList($parent_id, $category, $value, $res = '', $sep = '') {
		
		//echo 'fix error not run......';die;
		foreach ( $category as $m ) {
			$temp_id = $m->id;
			$temp_parent_id = $m->parent_id;
			if ($temp_parent_id == $parent_id) {
				if ($temp_id == $value) {
					$selected = 'selected="selected"';
					$style = " style='color:#AD0000;font-weight:bold;' ";
				} else {
					$selected = '';
					$style = '';
				}
				
				if ($m->parent_id == $parent_id) {
					$re = '<option value="' . $m->id . '" ' . $selected.$style.'>'.$sep.$m->category_name.'</option>';
					$res .= Categories::model()->categoryList($m->id,$category,$value,$re,$sep."--> ");
				}
                                
                            }
				
			}
			return $res;
	}
        
    public function behaviors()
    {
        return array('sluggable' => array(
        'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
        'columns' => array('category_name'),
        'unique' => true,
        'update' => true,
        ), );
    }  
    
    /**
     * @Author: ANH DUNG Apr 18, 2014
     * @Todo: get array category for dropdown list
     */
    public static function getList(){
        return CHtml::listData(self::model()->findAll(), 'id', 'category_name');
    }    
        
}