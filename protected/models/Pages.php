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
class Pages extends CActiveRecord
{
    public static $aSizeBanner = array(
        '960x252' => array('width'=>960, 'height'=>252),
    );
    
    public static $aSizeHomePage = array(
        '204x94' => array('width'=>204, 'height'=>94),
    );
    
            
    
    public $imageFile;
    public $thumbFile;
    public static $folderUpload = 'pages';    
    
    public $short_content;
    public $content;
    public $banner_description;
    public $title;
    public $parent_id;
    public $level = 0;
    public $count = 0;
    
    /**  ANH DUNG JAN 09, 2015
     * for feedback => Main Menu -> Property Search -> For Rent/For Sales, can show list of particular properties – (like at For Rent/Sales Tabs at home page) instead of contents.
     */
    const PAGE_FOR_RENT = 87; // id of page in database
    const PAGE_FOR_SALE = 88; // id of page in database    
    public static $aPageSaleRent = array(
        Pages::PAGE_FOR_RENT,
        Pages::PAGE_FOR_SALE
    ) ;
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Pages the static model class
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
                array('title', 'required'),
                //array('thumbFile', 'required', 'on'=>'create'),
                    array('external_link', 'validateLink'),
//                        array('imageFile', 'required','on'=>'create_banner'),                    
//                        array('title, content', 'required', 'on' => 'create_banner, update_banner'),
                    array('status, layout_id, user_id, order', 'numerical', 'integerOnly'=>true),
                    array('title', 'length', 'max'=>200),
                    array('post_type', 'length', 'max'=>20),
                    array('featured_image', 'length', 'max'=>250),
                    array('slug', 'length', 'max'=>250),
//                        array('featured_image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
                                // The following rule is used by search().
                                // Please remove those attributes that should not be searched.
                    array('id, title, show_footer,show_home_page, content, status, layout_id, user_id, post_type, meta_keywords, meta_desc, featured_image, order, created, modified, slug, title_tag, external_link', 'safe'),
//                                    array('id, title, content, status, layout_id, user_id, post_type, meta_keywords, meta_desc, featured_image, order, created, modified, slug,color_code, external_link', 'safe'),
                    array('imageFile', 'file', 'on'=>'create,update',
                        'allowEmpty'=>true,
                        'types'=> 'jpg,gif,png',
                        'wrongType'=>'Only jpg,gif,png are allowed.',
                        'maxSize' => ActiveRecord::getMaxFileSize(), // 5MB
                        'tooLarge' => 'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
                    ),
                    array(
                        'imageFile','match',
                        'pattern'=>'/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:;{}\\\\]{3}$/', 
                        'message'=>'Image files name cannot include special characters: &%$#',
                    ),

                    array('thumbFile', 'file', 'on'=>'create,update',
                        'allowEmpty'=>true,
                        'types'=> 'jpg,gif,png',
                        'wrongType'=>'Only jpg,gif,png are allowed.',
                        'maxSize' => ActiveRecord::getMaxFileSize(), // 5MB
                        'tooLarge' => 'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
                    ),
                    array(
                        'thumbFile','match',
                        'pattern'=>'/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:;{}\\\\]{3}$/', 
                        'message'=>'Thumb files name cannot include special characters: &%$#',
                    ),
                    /* Lam Huynh */
                    array('banner', 'file', 'allowEmpty' => true, 
                            'types'=> 'jpg, jpeg, gif, png',
                            'maxSize' => ActiveRecord::getMaxFileSize(),
                            'wrongType'=>'Only jpg, jpeg, gif, png are allowed.',
                            'tooLarge' => 'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',	
                            'on'=>'create, update'
                    ),
//			array('banner', 'file', 'allowEmpty' => false, 'on'=>'create'),
            );  

    }

    public function getAjaxAction()
    {
        return array('actionAjaxActivate', 'actionAjaxDeactivate');
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                'pages_translate' => array(self::HAS_MANY, 'PagesTranslate', 'post_id'),
                    'tagPosts' => array(self::HAS_MANY, 'TagPosts', 'post_id'),
                    'layouts' => array(self::BELONGS_TO, 'Layouts', 'layout_id'),
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
                    'color_code' => 'Background Color Code',
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
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.
    $criteria = new CDbCriteria();

            $criteria->compare('title', true);
            $criteria->compare('status',$this->status);
            $criteria->compare('show_footer',$this->show_footer);


            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
        'pagination'=>array(
            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
        ),
            ));
    }


public static function searchPageBacked()
{
    $dataProvider = new CArrayDataProvider(Pages::model()->getPageTree(true, 0), array(
                        'id'=>'pages',
                        'pagination'=>array(
                            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                        ),
                    ));
    return $dataProvider;
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
            'condition'=>"post_type='page'"
        );
    }

    protected function beforeSave() {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->user_id = Yii::app()->user->id;
                $this->post_type='page';
                $this->created=date('Y-m-d H:i:s');
                if(!is_null($this->slug)){
                        $this->page_slug = $this->slug;
                }                        
            }
            else
            {
                $this->modified=date('Y-m-d H:i:s');
            }
            return parent::beforeSave();   
        }
        else
            return false;
    }

    public static function findBySlug($slug){
        $criteria=new CDbCriteria;
        $criteria->compare('slug',$slug);
        $model = Pages::model()->find($criteria);
        return $model;
    }
    /**
     * <Jason>
     * <Date: 20131025>
     * <To get child of pages>
     * @param type $id
     * @return child
     */
    public static function findChildOfPages($id, $statusAll = false){
        $criteria=new CDbCriteria;
        $criteria->compare('parent_id',$id);
        if ($statusAll == false) {
            $criteria->compare('status',STATUS_ACTIVE);
        }

        $criteria->order = 't.order asc';

        $model = Pages::model()->findAll($criteria);
        return $model;
    }

    public static function getSlugById($id){
        $model = Pages::model()->findByPk((int)$id);
        if($model)
            return $model->slug;
        return '';
    }  

    public static function getIdBySlug($slug){
        $c = new CDbCriteria();
        $c->compare('slug', $slug);
        $c->compare('status', STATUS_ACTIVE);

        $model = Pages::model()->findAll($c);
        if($model)
            return $model[0]->parent_id;
        return '';
    }  

    /**
     * <Jason>
     * @param type $idParent
     * @return total imaage
     */
    public static function countImagesWithIdparent($idParent){
        $criteria=new CDbCriteria;
        $criteria->compare('t.parent',$idParent);
        $model = Pages::model()->findAll($criteria);
        if($model) return count($model);
        return 0;
    }
    /**
     * <Jason>
     * @param type $idParent
     * @return array images
     */
    public static function getImagesWithIdparent($idParent){
        $criteria=new CDbCriteria;
        $criteria->compare('t.parent',$idParent);
        $model = Pages::model()->findAll($criteria);
        if($model) return $model;
    }
        
        /**
     * <Jason>
     * 20130809
     * @param type $oldBannerFileName
     */
    public function resizeBanner($oldBlogFileName = null)
    {
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = '/upload/admin/pages/'.$this->id;
//        echo 'xxxx';die;    
        
        //delete all old images before resize
        if($oldBlogFileName)
        {
            if($this->featured_image != $oldBlogFileName){
                $ImageProcessing->delete($ImageProcessing->folder.'/'.$oldBlogFileName);
            
                foreach (self::$aSizeBanner as $key=>$value)
                {
                    $ImageProcessing->delete($ImageProcessing->folder.'/'.$key.'/'.$oldBlogFileName);
                }
                
                $ImageProcessing->file = $this->featured_image;
                $ImageProcessing->thumbs = self::$aSizeBanner;    //resize Of banner
                $ImageProcessing->create_thumbs();     
            }
        }
        else{
            $ImageProcessing->file = $this->featured_image;
            $ImageProcessing->thumbs = self::$aSizeBanner;    //resize Of banner
            $ImageProcessing->create_thumbs();     
        }
    }        
        /**
     * <Jason>
     * 20131112
     * @param type $oldHomePageFileName
     */
    public function resizeHomePages($oldHomePageFileName = null)
    {
        $ImageProcessing = new ImageProcessing();
        $ImageProcessing->folder = '/upload/admin/pages/'.$this->id;
        
        //delete all old images before resize
        if($oldHomePageFileName)
        {
            if($this->thumb_image != $oldHomePageFileName){
                $ImageProcessing->delete($ImageProcessing->folder.'/'.$oldHomePageFileName);
            
                foreach (self::$aSizeHomePage as $key=>$value)
                {
                    $ImageProcessing->delete($ImageProcessing->folder.'/'.$key.'/'.$oldHomePageFileName);
                }
                
                $ImageProcessing->file = $this->thumb_image;
                $ImageProcessing->thumbs = self::$aSizeHomePage;    //resize Of banner
                $ImageProcessing->create_thumbs();     
            }
        }
        else{
            $ImageProcessing->file = $this->thumb_image;
            $ImageProcessing->thumbs = self::$aSizeHomePage;    //resize Of banner
            $ImageProcessing->create_thumbs();     
        }
    }        
    
    /**
     * <Jason>
     * 09-08-2013
     * To do: deleteImage of category
     */    
    public static function deleteImage($model, $is_home_page = false)
    {
        $model = Pages::model()->findByPk($model->id);
        
        if ($is_home_page == true) {
            if(is_null($model) || empty($model->thumb_image))return;
            $ImageProcessing = new ImageProcessing();
            $ImageProcessing->folder = '/upload/admin/pages/'.$model->id;
            $ImageProcessing->delete($ImageProcessing->folder.'/'.$model->thumb_image);            
            foreach (Pages::$aSizeHomePage as $key=>$value)
            {
                $ImageProcessing->delete($ImageProcessing->folder.'/'.$key.'/'.$model->thumb_image);
            }            
        }
        else{
            if(is_null($model) || empty($model->featured_image))return;
            $ImageProcessing = new ImageProcessing();
            $ImageProcessing->folder = '/upload/admin/pages/'.$model->id;
            $ImageProcessing->delete($ImageProcessing->folder.'/'.$model->featured_image);            
            foreach (Pages::$aSizeBanner as $key=>$value)
            {
                $ImageProcessing->delete($ImageProcessing->folder.'/'.$key.'/'.$model->featured_image);
            }
        }
    }    
    
        /**
         * <Jason>
         * <Date: 20131025>
         * @param type $emptyOption
         * @return type
         */
        public static function getDropDownList($emptyOption=false,$character='---')
	{
            $listPages = self::model()->getPageTree(true, 0, 1);
            $data = array(0=>'-- None --');
            foreach ($listPages as $item)
            {
                $tree = "";
                if ($item->level > 0)
                {
                    $tree = "";
                    for ($i = 0 ; $i < $item->level; $i++ )
                        $tree .= $character;
                }
                $ti =  $tree . $item->title;

                $data[$item->id] = $ti;
                
            }
            return $data;                
	}   
        
    /**
    * <Jason>
    * <Date: 20131029>
     * @param type $publishedOnly
     * @param type $parent
     * @param type $limitLevel
     * @return array
     */
        public function getPageTree($publishedOnly = false, $parent=0, $limitLevel = 0)
        {
            $criteria=new CDbCriteria;
            
            $criteria->compare ('parent_id', $parent);
            $criteria->order = "t.order ASC";
            
            $items = array();
            $pages = self::model()->findAll($criteria);
            
            $level = 0;
            foreach($pages as $child) {
                self::getListed($child, $level, $items, $publishedOnly, $limitLevel);
            }   
            return $items; 
        }
    
        /**
        * <Jason>
        * <Date: 20131029>
        * @param type $child
        * @param type $level
        * @param array $return
        * @return type
        */

	public static function getListed($child, $level, &$return, $publishedOnly, $limitLevel) {
	    $child->level = $level;
	    $return[] = $child;
        $childItem = self::findChildOfPages($child->id, $publishedOnly);
        
        if(count($childItem) > 0) 
	    {
            foreach($childItem as $item) {
                if ($limitLevel > 0 && $level >= $limitLevel) {return;}
                $level++;
                self::getListed($item, $level, $return, $publishedOnly, $limitLevel);
                $level--;
            }   
        }
	}
        
    /**
     * <Jason>
     * <Date: 20131025>
     * @param type $emptyOption
     * @return type
     */
        
    public static function getPagesName($parent_id, $getModel = false)
	{
            $model=self::model()->findByPk($parent_id);
            if ($model) {
                if ($getModel == false) {
                    return $model->title;
                }else{
                    return $model;
                }
            }
	}    
     
    /**
     * <Jason>
     * <Date: 20131030>
     * @param type $level
     * @return type
     */
    public function buildLevelTreeCharacter($level)
    {
        $ret = '';
        for($i = 0; $i < $level; $i ++)
          $ret .= "—";
        return $ret . " ";
    }        

    /**
     * <Jason>
     * <Date: 20131101>
     * @param type $root_page_id
     * @param type $current_page_model
     * @param type $limitLevel
     * @param type $level
     * @return string
     */
    public static function getNavByNodeID($root_page_id, $current_page_model, $limitLevel, $level, $parent_id) {
        $current_page_model->level = $level;
        if ($limitLevel > 0 && $level >= $limitLevel) {;return '';}
        
        //Find root parent of tree
        $rootModel = self::findRootParentModel($root_page_id);
        
        $html = '';
        $default_language = Language::model()->find(array('condition' => 'default_language = 1'))->id;
        $title_field = 'title_' . $default_language;        
            
        if (isset($rootModel)) {
            $pageChild = self::getPagesName($root_page_id);
            $mNodes = self::findChildOfPages($root_page_id);
            
            if (count($mNodes) > 0) {
                $html .='<div class="left-main">';
                $html .='<h3>'.$pageChild.'</h3>';
                $html .='<div class="menu-left">';
                $html .= '<ul>';
            }
            
            foreach ($mNodes as $value) {
                $level++;
                if (isset($_SESSION['current_slug']) && (($_SESSION['current_slug'] == $value->slug) || ($value->id == $parent_id))) {
                    $active = 'current';
                }
                else{
                    $active = '';
                }
                
                if ($value->external_link != '') {
                     $html .='<li><a class="'.$active.'" href="' . $value->external_link . '">' . $value->$title_field . '</a>';
                } else {
                    $html .= "<li><a class='$active' href='" . Yii::app()->createAbsoluteUrl('site/view_page', array('slug' => $value->slug)) . "'>" . ActiveRecord::getText($value->$title_field, 110) . "</a>";
                }  
                        
                $mNodes2 = self::findChildOfPages($value->id);
                    foreach ($mNodes2 as $value2) {
                        if (isset($_SESSION['current_slug']) && ($_SESSION['current_slug'] == $value2->slug)) {
                            $active = 'current';
                        }
                        else{
                            $active = '';
                        }
                        $html .= "<ul>";
                        if ($value2->external_link != '') {
                             $html .='<li><a class="'.$active.'" href="' . $value2->external_link . '">' . $value2->$title_field . '</a>';
                        } else {
                            $html .= "<li><a class='$active' href='" . Yii::app()->createAbsoluteUrl('site/view_page', array('slug' => $value2->slug)) . "'>" . ActiveRecord::getText($value2->$title_field, 110) . "</a>";
                        }                         
                        $html .= "</ul>";                            
                    }
                $html .="</li>";                
            }
            
            if (count($mNodes) > 0) {
                $html.="</ul>";      
                $html.="</div>";      
                $html.="</div>";  
            }
        }
        return $html;
    }    
    
    /**
     * <Jason>
     * <Date: 20131104>
     * @param type $root_page_id
     */
    public static function findRootParentModel($root_page_id, &$array = null, $breadCrum = false){
        $model=self::model()->findByPk($root_page_id);
        
        if ($breadCrum = true) {
            $array .= $model->id.',';

            if ($model->parent_id == 0) {
                return $model;
            }
            else{
                return self::findRootParentModel($model->parent_id, $array, true);
            }
        }
        else{
            if ($model->parent_id == 0) {
                return $model;
            }
            else{
                return self::findRootParentModel($model->parent_id);
            }
        }
    }
    
    /**
     * <Jason>
     * <Date: 20131112>
     * <Get content of our council pages>
     */
    public static function getOurCouncilPage(){
        $returnHtml = '';
            
        $our_council = ScOurCouncil::model()->findAll('status = '.STATUS_ACTIVE);
        $returnHtml .= "
            <div class='profile'><ul>";
        foreach ($our_council as $value) {
             $img =Yii::app()->createAbsoluteUrl("/upload/admin/OurCouncil/".$value->id."/132x164/".$value->large_image);
             $returnHtml .= "<li>
                            <div class='img-avatar'>
                                <img alt='' src='$img'>
                            </div>
                            <div class='info'>
                                <p class='name-info'>".$value->name."</p> 
                                <p class='pre'>". ScOurCouncil::model()->localized()->findByPk($value->id)->job_post."</p> 
                                <p class='info-name'>".$value->company_name."</p>
                            </div>
                        </li>";
        }
        $returnHtml .= "
                </ul></div>";
        return $returnHtml;
    }
    /**
     * <Jason>
     * <Date: 20131104>
     * @param type $mPages
     * @param type $model
     * @return string
     */
    public static function getContentOfPage($mPages) {
        $default_language = Language::model()->find(array('condition' => 'default_language = 1'))->id;
        $title_field = 'title_' . $default_language;
        $content_field = 'content_' . $default_language;
        
        $pageChild = self::getPagesName($mPages->id);
        
        if (isset($_SESSION['current_page_id'])) {
            $model=self::model()->multilingual()->findByPk($_SESSION['current_page_id']);
            
            if ($model) {
                $sResult .= '<div class="brc">';
                $sResult .= '<a class="home" href="' . Yii::app()->createAbsoluteUrl('site/index') . '">HOME</a>';
                
                self::findRootParentModel($mPages->id, $arr, true);
                $arrs = split(',', $arr);
                for($i = count($arrs); $i >= 0; $i--)
                {
                    $model=self::model()->multilingual()->findByPk($arrs[$i]);
                    if ($model && $i > 0) {
                        if ($model->external_link != '') {
                            $sResult .=' / <a href="' . $model->external_link . '">' . $model->$title_field . '</a>';
                        } else {
                            $sResult .= " / <a href='" . Yii::app()->createAbsoluteUrl('site/view_page', array('slug' => $model->slug)) . "'>" . $model->$title_field . "</a>";
                        }                        
                    }
                    elseif($i == 0){
                        $sResult .= " / " . $model->$title_field ;
                    }
                }
            }
            
        $pattern=array(
             '{OUR_COUNCIL}',
         );
        
        $our_council = self::getOurCouncilPage();
         $values=array(
             $our_council,
         );
         $content = str_replace($pattern, $values, Pages::getPagesName($mPages->id, true)->$content_field);
                        
            $sResult .= '</div>';
            $sResult .= '<div class="box-about">
                    <h3>'.$pageChild.'</h3>
                        '.$content.'
                        </div>';
        }
        return $sResult;
    }
    
    /**
     * Check link of banner
     * <Jason>
     * <Date: 20131105>
     */
        
    public function validateLink($attribute,$params)
    {
        if(trim($this->external_link) != ''){
            $label = $this->getAttributeLabel('external_link');
            $tempUrl = strtolower($this->external_link);
            if(strpos($tempUrl,'http://')!==false || strpos($tempUrl,'https://')!==false)
                    $a=1;
            else
               $this->addError("external_link","$label must have http:// OR https://");
        }
    }


    public static function getSlugPageWithID($id){
        $page = Pages::model()->findByPk($id);
        if($page) return $page;
        return NULL;
    }

    public static function getPosition($value){
        $arrPostion = array(1 => 'Footer', 0 => 'Top',2=>'All');
        if(!is_null($value)){
             if(array_key_exists($value, $arrPostion))
                     return $arrPostion[$value];
        }
       return NULL;
    }

	const BANNER_PATH = 'upload/page';
	
	/**
	 * @author Lam Huynh
	 */
	public function removeBanner($fileName) {
		$fileName = Yii::app()->basePath.'/../'.self::BANNER_PATH.'/'.$fileName;
		if (is_file($fileName)) unlink($fileName);
	}
	
	/**
	 * @author Lam Huynh
	 */
	public function saveBanner($file) {
		$fileName = time() .'-'. (string)$file;
		$file->saveAs(Yii::app()->basePath . '/../'.self::BANNER_PATH.'/'.$fileName);
		$this->banner = $fileName;
	}

	/**
	 * Resize image
	 * 
	 * @author Lam Huynh
	 * @example $this->_resizeImage('c:\abc\a.jpg', 400, 300)
	 * @return boolean
	 */
	public function _resizeImage($filePath, $width, $height) {
		if (!is_file($filePath)) return false;
		$srcDir = dirname($filePath);
		$dstDir = $srcDir . DIRECTORY_SEPARATOR . "{$width}x{$height}";
		$saveName = $dstDir . DIRECTORY_SEPARATOR . basename($filePath);
		
		if (!is_dir($dstDir)) mkdir($dstDir, 0777, true);

		$thumb=new EPhpThumb();
		$thumb->init();
		$thumb->create($filePath)
			->adaptiveResize($width, $height)
			->save($saveName);

		return is_file($saveName);
	}

	/**
	 * Get image url
	 * 
	 * @return string
	 */
	public function getBannerUrl($width=null, $height=null, $displayPlaceHolder=true) {
		$imgPath = self::BANNER_PATH;
		$placeHolder = 'NO_IMAGE.jpg';
		$resizeFolder = "{$width}x{$height}";
		
		$baseImg = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $imgPath . DIRECTORY_SEPARATOR . $this->banner;
		$noImg = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $imgPath . DIRECTORY_SEPARATOR . $placeHolder;

		if (!$width && !$height) {	// base image
			return Yii::app()->baseUrl.'/'.$imgPath.'/'.$this->banner;
		} else if ($this->_resizeImage($baseImg, $width, $height)) {	// thumbnail
			return Yii::app()->baseUrl.'/'.$imgPath.'/'.$resizeFolder.'/'.$this->banner;
		} else if ($displayPlaceHolder && $this->_resizeImage($noImg, $width, $height)) {	// no image
			return Yii::app()->baseUrl.'/'.$imgPath.'/'.$resizeFolder.'/'.$placeHolder;
		}
		
		return null;
	}

    //Kvan
    public static function getPageById($id){
        $models = self::model()->findByPk($id);
        return $models;
    }

}