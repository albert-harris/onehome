<?php 
class AdSidebar extends CWidget
{
    public function run()
    {
        $this->getContent();
    }
    public function getContent()
    {
        $this->render("anhdung/AdSidebar",array());
    }
    
}
?>