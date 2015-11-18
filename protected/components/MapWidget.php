<?php
class MapWidget extends CWidget
{
    public $postal_code;
    public $title;
    public $dist;
    public $json_map;
    public $sizeMap ='small_map';
    public $arrCat;
    public $model;
    public $dir ;
    public $fullScreen='map';


    public function run()
    {
        $position = explode('-', $this->postal_code);
        $this->arrCat = Listing::$nearBy;
        $this->dir = Yii::getPathOfAlias('application.components.views') .'/map/tab/';
        $data= array(
            'x'=>isset($position[0]) ? trim($position[0]) :0,
            'y'=>isset($position[1]) ? trim($position[1]) :0,
            'title'=>$this->title,
            'json_map'=>$this->json_map,
            'arrCat'=>$this->arrCat,
            'model'=>$this->model,
            'dir'=>$this->dir,
            'fullScreen'=>$this->fullScreen
        );
        $view = ($this->sizeMap=='small_map') ? 'small_map' : 'big_map';
        $this->render("map/$view",array('data'=>$data));
    }

    
    
}

