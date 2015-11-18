<?php
/*
 * This script is used for remove resized image files under upload/listing
 * Usage: run it directly in browser
 */

function recursiveRemoveDirectory($directory) {
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }

    if (is_dir($directory)) {
    	rmdir($directory);
    }
}

$basePath = dirname(__FILE__);
$upload = $basePath . '/upload/listing';
$removeDir = array();

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($upload), 
    RecursiveIteratorIterator::SELF_FIRST);

foreach($iterator as $file) {
    if($file->isDir()) {
    	$dir = $file->getRealpath();
        if ( preg_match('/\\d+x\\d+$/', $dir) ) 
        	$removeDir[] = $dir;
    }
}

foreach($removeDir as $dir) {
	recursiveRemoveDirectory($dir);
}

var_dump($removeDir);die;.