<?php
class ResizeImageCommand extends CConsoleCommand
{
    public function run($arg)
    {
        if( Yii::app()->setting->getItem('flag_resize') == 0 ){
           
            $this->doJob($arg);
            Yii::app()->setting->setDbItem('flag_resize', 1);
            
        }
    }
    protected function doJob($arg)
    {
        Listing::FixGenNewSize();
    }
}