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
$user_id = $_SESSION["user_id"];
$cart = cart::FindByUser($user_id);
var_dump($_POST);
if (!$cart) {
    $cart = cart::Create($user_id);
    //parametri per creazione del prodotto
    $params = array("quantita" => (int)$_POST["quantita"], "product_id" => (int)$_POST["product_id"], "cart_id" => $cart->getId());
    cart_product::Create($params);
    header('Location: http://localhost:8000/views/index.php');
    exit;
}
else if ($cart)
{
    $params = array("product_id" => (int)$_POST["product_id"], "cart_id" => $cart->getId());
    $cart_product = cart_product::Find($params);
    if($cart_product)
    {
        $quantity = $cart_product->getQuantita();
        $sum = $quantity + $_POST["quantita"];
        $params = array("quantita" => $sum, "product_id" => (int)$_POST["product_id"], "cart_id" => $cart->getId());
        $cart_product->Update($params);
    }
    else
    {
        $params = array("quantita" => (int)$_POST["quantita"], "product_id" => (int)$_POST["product_id"], "cart_id" => $cart->getId());
        $cart_product = cart_product::Find($params);
        cart_product::Create($params);
    }
    header('Location: http://localhost:8000/views/index.php');
    exit;
}