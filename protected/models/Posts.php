<?php

/**
 * This is the model class for table "{{_posts}}".
 *
 * The followings are the available columns in table '{{_posts}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property integer $layout_id
 * @property integer $user_id
 * @property string $post_type
 * @property integer $meta_keywords
 * @property integer $meta_desc
 * @property string $featured_image
 * @property integer $order
 * @property string $created
 * @property string $modified
 * @property string $slug
 */
class Posts extends CActiveRecord
{
    public $category;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posts the static model class
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
		return '{{_posts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				
			array('title ,content, status', 'required'),
			array('status, layout_id, user_id, order', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>63),
			array('post_type', 'length', 'max'=>20),
			array('featured_image', 'length', 'max'=>250),
			array('slug', 'length', 'max'=>45),
			array('content, created, modified', 'safe'),
            array('featured_image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array('id, category, title, content, status, layout_id, user_id, title_tag, post_type, meta_keywords, meta_desc,
            featured_image, order, created, modified, slug, show_on_homepage', 'safe'),
			array('id, category, title, content, status, layout_id, user_id, title_tag, post_type, meta_keywords, meta_desc,
            featured_image, order, created, modified, slug, show_on_homepage', 'safe', 'on'=>'search,create'),
		);
	}
    
    public function behaviors(){
            return array(
              'sluggable' => array(
                'class'=>'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('title'),
                'unique' => true,
                'update' => true,
              ),
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
			'categoriesPost'	=> array(self::HAS_MANY, 'CategoriesPosts', 'post_id'),
            'tagPosts' => array(self::HAS_MANY, 'TagPosts', 'post_id'),
            'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'media' => array(self::BELONGS_TO, 'Medias', 'featured_image'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'status' => 'Status',
			'layout_id' => 'Layout',
			'user_id' => 'User',
			'post_type' => 'Post Type',
            'title_tag' => 'Title Tag',
			'meta_keywords' => 'Meta Keywords',
			'meta_desc' => 'Meta Description',
			'featured_image' => 'Featured Image',
			'order' => 'Order',
			'created' => 'Created',
			'modified' => 'Modified',
			'slug' => 'Slug',
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
        
        $criteria->with = array('categoriesPost');
        $criteria->together = true;

        $criteria->compare('categoriesPost.category_id', $this->category);

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('layout_id',$this->layout_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('post_type',$this->post_type,true);
		$criteria->compare('meta_keywords',$this->meta_keywords);
		$criteria->compare('meta_desc',$this->meta_desc);
		$criteria->compare('featured_image',$this->featured_image,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
	
	
    public function defaultScope() {
        parent::defaultScope();
        return array(
            'condition'=>"post_type='post'"
        );
    }
        
	//Get slug 
    public function getslug($id){
    	if(empty($id)) return;
    	$id = (int)$id;
    	return $this->model()->findByPk($id)->slug;
    }
    
    public static function searchKeyword($keyword)
    {
        $keyword = Helper::toRegularString($keyword);
        
        //paging post        
        $model_post=new Posts;
        $criteria=new CDbCriteria;
        $criteria->condition='title like "%'.$keyword.'%" or content like "%'.$keyword.'%"';
        $total = $model_post->count($criteria);
        $pages=new CPagination($total);
        $pages->pageSize=4;
        $pages->applyLimit($criteria);
        $list = $model_post->findAll($criteria);
        
        $posts_paging = array();
        $posts_paging[] = $list;
        $posts_paging[] = $pages;        

        return $posts_paging;
    }
    


     
}



