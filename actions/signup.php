<?php

use models\User;

require_once "..\database.php";
require_once "..\models\user.php";
require_once "..\models\session.php";

$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);
$params = array("email" => $email, "password" => $password);
if (User::Find($params))
{
    $queryString = http_build_query(array("creationSuccess" => false));
    header('Location: http://localhost:8000/views/signup.php?'.$queryString);
    exit;
}
$user = User::Create($params);
header('Location: http://localhost:8000/views/login.php');

