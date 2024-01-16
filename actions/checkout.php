<?php

use models\cart;
use models\session;
use models\User;
use models\Role;
use models\product;
use models\cart_product;

require_once "../database.php";
require_once "../models/user.php";
require_once "../models/session.php";
require_once "../models/role.php";
require_once "../models/product.php";
require_once "../models/cart.php";
require_once "../models/cart_product.php";

session_start();
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}

$choice = $_POST["checkout"];
var_dump($choice);
if ($choice == "checkout") {
    header('Location: http://localhost:8000/views/cart.php');
    exit;
}