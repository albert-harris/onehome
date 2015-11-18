<?php 
class AdsBannerTopWidget extends CWidget
{
    public function run()
    {
        $this->getBanner();
    }
    public function getBanner()
    {
        $adsTop = Banners::getAdsBannerByType(TOP);
        $adsBottom = Banners::getAdsBannerByType(BOTTOM);
        $adsMiddle = Banners::getAdsBannerByType(MIDDLE);
        $this->render("banner/banner_top",array(
            'banner'=>$adsTop,
        ));
    }
}