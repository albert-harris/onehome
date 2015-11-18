<?php
/**
 * @Author: ANH DUNG Dec 16, 2014
 * @Todo: run some helpfull function when live site
 */
class LiveNeedRun
{
    /**
     * @Author: ANH DUNG Dec 16, 2014
     * @Todo: run replace url in CMS page 
     * LiveNeedRun::ReplaceCmsLinkLiveSite();
     */
    public static function ReplaceCmsLinkLiveSite() {
        set_time_limit(7200);
//        $find = 'propertyinfologic.com.sg/demo';
//        $replace = 'propertyinfologic.com.sg';
//        $find = 'propertyinfologic.com.sg'; // Jan 06, 2014
//        $replace = 'www.onehome.sg'; // Jan 06, 2014
        $find = 'www.onehome.sg'; // Feb 10, 2015 for demo new change
//        $replace = 'verzview.com/verzpropertyinfo/demo2'; // Feb 10, 2015
        $replace = 'localhost/verz/propertyinfo'; // Feb 10, 2015
        
        $models = Pages::model()->findAll();
        foreach($models as $item){
            $item->external_link = str_replace($find, $replace, $item->external_link);
            $item->content = str_replace($find, $replace, $item->content);
            $item->update(array('content','external_link'));
        }
        echo 'Done: '.count($models);die;
    }
}
