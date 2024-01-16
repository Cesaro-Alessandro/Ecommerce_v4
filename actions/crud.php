<?php

use models\session;
use models\User;
use models\Role;
use models\product;

require_once "../database.php";
require_once "../models/user.php";
require_once "../models/session.php";
require_once "../models/role.php";
require_once "../models/product.php";

if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
} elseif ($_SESSION['ruolo'] != "admin") {
    header("Location: index.php");
}

$product = new product();
$product->setId($_POST['id']);
$product->setMarca($_POST['marca']);
$product->setNome($_POST['nome']);
$product->setPrezzo($_POST['prezzo']);
$choice = $_POST["submit"];
if ($choice == "Update") {
    $product->Update();
    header('Location: http://localhost:8000/views/adminpage.php');
    exit;
} else if ($choice == "Delete") {
    $product->Delete();
    header('Location: http://localhost:8000/views/adminpage.php');
    exit;
} else if ($choice == "Create") {
    $params = array("id" => $product->getId(), "nome" => $product->getNome(), "marca" => $product->getMarca(), "prezzo" => $product->getPrezzo());
    product::Create($params);
    header('Location: http://localhost:8000/views/adminpage.php');
    exit;
}

