<?php

/**
 * @inheritdoc
 */
class ServiceCategory extends OurService
{
	public $imageFile;
	
	/**
	 * @inheritdoc
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$rules = array(
			array('imageFile', 'file', 'on'=>'create,update',
				'allowEmpty'=>true,
				'types'=> 'jpg,gif,png',
				'wrongType'=>'Only jpg,gif,png are allowed.',
				'maxSize' => ActiveRecord::getMaxFileSizeImage(), // 3MB
				'tooLarge' => 'The file was larger than '.(ActiveRecord::getMaxFileSize()/1024).' KB. Please upload a smaller file.',
			),
			array(
				'imageFile','match',
				'pattern'=>'/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:;{}\\\\]{3}$/', 
				'message'=>'Image files name cannot include special characters: &%$#',
			),
		);
		return array_merge(parent::rules(), $rules);
	}
	
	protected function beforeDelete() {
		$this->removeImage();
		return parent::beforeDelete();
	}
}
