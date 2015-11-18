<?php 
class AdsBannerMiddleHomeWidget extends CWidget
{
    public $limit;
    public function run()
    {
        $this->getBanner();
    }
    public function getBanner()
    {
        $adsMiddle = Banners::getAdsBannerMiddleHome();
        $this->render("banner/banner_middle_home",array(
            'banner'=>$adsMiddle,
        ));
    }
}
?>