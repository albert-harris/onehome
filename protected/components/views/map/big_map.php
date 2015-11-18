<?php
    if(isset($_GET['type']) && $_GET['type'] !='location'){
        if($_GET['type']=='car') require_once($data['dir'] .'car.php');
        if($_GET['type']=='building') require_once($data['dir'] .'building.php');
        if($_GET['type']=='sign') require_once($data['dir'] .'sign.php');
    }else{
          require_once($data['dir'] .'location.php');
    }

?>



