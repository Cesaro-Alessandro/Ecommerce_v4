<?php
session_start();
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamazon</title>
</head>

<body>
<link rel="stylesheet" href="../style/Sito.css">
<link rel="stylesheet" href="../style/Cards.css">
<header>
    <h1>ZAMAZON</h1>
</header>
<nav>
    <a href="index.php">Prodotti</a>
    <a href="cart.php">Carrello</a>
    <?php
    if ($_SESSION['ruolo'] == "admin") {
        ?>
        <a href="adminpage.php">Pannello Di Controllo</a>
        <?php
    }
    ?>
    <a href="../actions/logout.php">Logout</a>
</nav>
<div class="card-container">
    <?php

    use models\product;

    require_once "..\models\product.php";
    $products = \models\product::FindAll();
    $n = count($products);
    $i = 0;
    while ($i < $n) {
        if ($i % 3 == 0) {
            ?>
            <br>
            <?php
        }
        ?>
        <div class="filler"></div>
        <div class="product-card">
            <div class="product-name"><?php echo $products[$i]["nome"] ?></div>
            <div class="brand"><?php echo "Marca: " . $products[$i]["marca"] ?></div>
            <div class="price"><?php echo "Prezzo: " . $products[$i]["prezzo"] ?></div>
            <form action="../actions/cart.php" method="POST">
                <input class="quantity" type="number" name="quantita" placeholder="Qta">
                <input type="hidden" name="product_id" value="<?php echo $products[$i]["id"] ?>">
                <input class="buy-button" type="submit" name="submit" value="compra">
            </form>
        </div>


        <?php
        $i++;
    }
    ?>
</div>

</body>
</html>
