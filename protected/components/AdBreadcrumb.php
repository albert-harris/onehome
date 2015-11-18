<?php 
class AdBreadcrumb extends CWidget
{
    public function run()
    {
        $this->getContent();
    }
    public function getContent()
    {
        $this->render("anhdung/AdBreadcrumb",array());
    }
    
}
?>