<?php

if(!empty($_SESSION))
{
    session_destroy();
    echo 'destroy session';
//    echo '<pre>';
//    print_r($_SESSION);
//    echo '</pre>';
    
    
    if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }


//     echo '<pre>';
//    print_r($_COOKIE);
//    echo '</pre>';
//    exit;
//    header("Location: " . SITE_URL . "/logout.php");
}
else
{
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    exit;
}

?>