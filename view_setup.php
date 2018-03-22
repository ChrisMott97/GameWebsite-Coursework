<?php
$files = array_slice(scandir('./views'), 2);
foreach ($files as $file) {
    $link = "./views/".$file;
    if(file_exists($link)){
        include_once($link);
    }
}