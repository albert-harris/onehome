<?php 
class AdsBannerMiddleWidget extends CWidget
{
    public $limit;
    public function run()
    {
        $this->getBanner();
    }
    public function getBanner()
    {
        $adsMiddle = Banners::getAdsBannerMiddle();
        $this->render("banner/banner_middle",array(
            'banner'=>$adsMiddle,
        ));
    }
}
?>