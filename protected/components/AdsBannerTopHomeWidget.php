<?php 
class AdsBannerTopHomeWidget extends CWidget
{
    public function run()
    {
        $this->getBanner();
    }
    public function getBanner()
    {
        $adsTopHome = Banners::getAdsBannerTopHome(TOP_HOME);
        $this->render("banner/banner_top_home",array(
            'banner'=>$adsTopHome,
        ));
    }
}
?>