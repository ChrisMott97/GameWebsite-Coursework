<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("password.php");

$models = array_slice(scandir('./models'), 2);
foreach ($models as $model){
    $model_path = "./models/".$model;
    if(file_exists($model_path)){
        include_once($model_path);
    }
};


$db = new mysqli('localhost', 'cm740', 'cm740', 'cm740');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

UserFactory::setDependencies($db);
// $user = UserFactory::create("cm740", "newpass", "Chris", "Mott", 1);
// $user->save();
// var_dump(UserFactory::auth("cm740", "newpass"));