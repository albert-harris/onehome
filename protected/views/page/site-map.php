<div class="wrapper main clearfix">
    <h1 class="title-page">Site Map</h1>
    <!-- contact info -->
    <div>
        <?php
            $menuFe = new ShowMenu();
            $listMenu = $menuFe->showMenu_siteMap();
            echo $listMenu;
        ?>
    </div>

</div>