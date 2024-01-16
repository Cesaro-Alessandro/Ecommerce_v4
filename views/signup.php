<?php ?>
<html lang="it">
<body>
<link rel="stylesheet" href="../../style/Sito.css">
<header>
    <h1>ZAMAZON</h1>
</header>
<div class="login">
    <form action="../actions/signup.php" method="POST" >
        <input type="text" name="email" placeholder="Email">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br> <br>
        <input type="submit" value="Signup" class="standardButton">
    </form>
</div>
<?php
if (isset($_GET['creationSuccess']) && $_GET['creationSuccess'] == false) {
    ?>
    <div>
        <p class="loginFail">L'account esiste già</p>
    </div>
    <?php
}
?>
</body>

</html>
