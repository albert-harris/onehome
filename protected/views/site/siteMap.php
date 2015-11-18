<div class="wrapper main clearfix">
    <h1 class="title-page">Site Map</h1>
    <!-- contact info -->
    <div>
        <?php
        echo "asd";
            $menuFe = new ShowMenu();
            $listMenu = $menuFe->showMenu_siteMap();
            echo "<pre>";
echo print_r($listMenu);
echo "</pre>";
            echo $listMenu;
        ?>
    </div>

</div>