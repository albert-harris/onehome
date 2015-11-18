<?php
/**
 * @author dtoan  <toan.pd@verzdesign.com.sg>
 * @copyright (c) 2/4/2014
 * Upload file with Ajax
 */

class uploadFileAjax extends CWidget
{    
    public $assets;
    public $url;
    public $model;
    public $attribute;
    public $class;
    public $success;
    public $idFormdata;
    public $buttonChange=true;
    public $buttonSubmit;
    public $allowFile;
    public $function='sendImage';
    public $Maxfile=1;
    public $multiple=false;

    public function init() {
            parent::init();
            $this->assets =  Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
    }

    public function run() {  
        $this->render('form',array(
                                    'url'=>$this->url,
                                    'model'=>$this->model,
                                    'attribute'=>$this->attribute,
                                    'multiple'=>$this->multiple,
                                    'class'=>$this->class,
                                    'success'=>$this->success,
                                    'idFormdata'=>$this->idFormdata,
                                    'buttonChange'=>$this->buttonChange,
                                    'buttonSubmit'=>$this->buttonSubmit,
                                    'allowFile'=>$this->allowFile,
                                    'Maxfile'=>$this->Maxfile,
                                    'function'=>$this->function,
                                    'assets'=>$this->assets,
                            )
                        );
    }    
}