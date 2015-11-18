<?php 
class AdsBannerBottomWidget extends CWidget
{
    public function run()
    {
        $this->getBanner();
    }
    public function getBanner()
    {
        $adsBottom = Banners::getAdsBannerByType(BOTTOM);
        $this->render("banner/banner_bottom",array(
            'allBanner'=>$adsBottom,
        ));
    }
}
?>