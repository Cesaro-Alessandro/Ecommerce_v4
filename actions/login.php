<?php

use models\session;
use models\User;
use models\Role;

require_once "../database.php";
require_once "../models/user.php";
require_once "../models/session.php";
require_once "../models/role.php";

if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}
$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);


$params = array("email" => $email, "password" => $password);
$user = User::Find($params);
if (!$user) {
    $queryString = http_build_query(array("loginSuccess" => false));
    header('Location: http://localhost:8000/views/login.php?'.$queryString);
    exit;
}

$role_id = $user->getRoleId();
$role = Role::Find($role_id);
$nomeRuolo = $role->getNome();

session_start();
$params = array("ip" => $_SERVER["REMOTE_ADDR"], "user_id" => $user->getId());
session::Create($params);
$_SESSION['ruolo'] = $nomeRuolo;
$_SESSION['user_id'] = $user->getId();
$_SESSION['logged'] = true;
var_dump($_SESSION);
header('Location: http://localhost:8000/views/index.php');
exit;