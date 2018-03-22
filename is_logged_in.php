<?php
include_once("./setup.php");

if(isset($_SESSION['username'])){
    echo json_encode(true);
}else{
    echo json_encode(false);
}