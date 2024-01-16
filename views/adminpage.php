<?php
session_start();
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
} elseif ($_SESSION['ruolo'] != "admin") {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../style/Sito.css">
<link rel="stylesheet" href="../style/Admin.css">
<header>
    <h1>ZAMAZON</h1>
</header>
<body>
<nav>
    <a href="index.php">Prodotti</a>
    <a href="cart.php">Carrello</a>
    <a href="adminpage.php">Pannello di Controllo</a>
    <a href="../actions/logout.php">Logout</a>
</nav>
<table>
    <tbody>

    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Marca</th>
            <th>Prezzo</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <tr>
            <?php

            use models\product;

            require_once "..\models\product.php";
            $products = product::FindAll();
            $n = count($products);
            $i = 0;
            while ($i < $n)
            {
            ?>
            <form action="../actions/crud.php" method="post">
                <td>
                    <input type="text" name="id" value="<?php echo $products[$i]["id"] ?>" readonly/>
                </td>
                <td>
                    <input type="text" name="nome" value="<?php echo $products[$i]["nome"] ?>"/>
                </td>
                <td>
                    <input type="text" name="marca" value="<?php echo $products[$i]["marca"] ?>"/>
                </td>
                <td>
                    <input type="text" name="prezzo" value="<?php echo $products[$i]["prezzo"] ?>"/>
                </td>
                <td>
                    <input type="submit" name="submit" value="Update" class="standardButton"/>
                </td>
                <td>
                    <input type="submit" name="submit" value="Delete" class="standardButton"/>
                </td>
            </form>
        </tr>

        <?php
        $i++;
        }
        ?>
        <tr>
            <form action="../actions/crud.php" method="post">
                <td>

                </td>
                <td>
                    <input type="text" name="nome" value=""/>
                </td>
                <td>
                    <input type="text" name="marca" value=""/>
                </td>
                <td>
                    <input type="text" name="prezzo" value=""/>
                </td>
                <td>
                    <input type="submit" name="submit" value="Create" class="standardButton"/>
                </td>
            </form>
        </tr>
    </table>
    </tbody>
</table>

</body>
</html>

