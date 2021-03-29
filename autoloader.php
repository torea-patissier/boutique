<?php

spl_autoload_register('myAutoloader');

function myAutoloader($class){
    $path = "Classes/";
    $extension = ".class.php";
    $fullPath = $path . $class . $extension;

    include_once $fullPath;
}

?>