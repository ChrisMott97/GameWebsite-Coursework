<?php
include_once("./setup.php");

$user = UserFactory::auth($_POST['username'], $_POST['password']);
if($user != null){
    $_SESSION['username'] = $user->getUsername();;
}else{
    http_response_code(401);
}
// header("Location: /cm740/coursework/#/home");