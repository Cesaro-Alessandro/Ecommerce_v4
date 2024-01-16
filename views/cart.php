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
<link rel="stylesheet" href="../style/Table.css">
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

<table>
    <tbody>

    <table>
        <thead>
        <tr>
            <th>Articolo</th>
            <th>Prezzo</th>
            <th>Quantita</th>
        </tr>
        <tr>
            <?php
            use models\product;
            use models\cart_product;
            use models\cart;
            require_once "..\models\product.php";
            require_once "..\models\cart.php";
            require_once "..\models\cart_product.php";
            $cart = cart::FindByUser($_SESSION["user_id"]);
            $params = array("cart_id" => $cart->getId(), "user_id" => $_SESSION["user_id"]);
            $products = cart_product::Test($params);
            $n = count($products);
            $i = 0;
            $temp_products = array("articolo", "prezzo");
            $i=0;

            while ($i < $n)
            {
            ?>
            <td style="text-align: center">
                <p><?php echo $products[$i]["marca"] . " - " . $products[$i]["nome"] ?></p>
            </td>
            <td>
                <p><?php echo $products[$i]["prezzo"] * $products[$i]["quantita"]?></p>
            </td>
            <td>
                <p><?php echo $products[$i]["quantita"]?></p>
            </td>
        </tr>

        <?php
        $i++;
        }
        $totalPrice = 0;
        $quantita = 0;
        foreach ($products as $product) {
            $totalPrice = $product["prezzo"] + $totalPrice;
            $quantita = $product["quantita"] + $quantita;
        }
        ?>
        <tr>
            <form action="../actions/checkout.php" method="POST">
                <td>
                    <input type="submit" name="checkout" value="checkout" class="standardButton" readonly/>
                </td>
                <td>
                    <input type="number" name="totalPrice" value="<?php echo $totalPrice ?>" readonly/>
                </td>
                <td>
                    <input type="number" name="totalQuantity" value="<?php echo $quantita ?>" readonly/>
                </td>
            </form>
        </tr>
    </table>
    </tbody>
</table>
</body>
</html>