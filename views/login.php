<?php ?>
<html lang="it">
<body>
<link rel="stylesheet" href="../../style/Sito.css">
<header>
    <h1>ZAMAZON</h1>
</header>
<div class="login">
    <form action="../actions/login.php" method="POST">
        <input type="text" name="email" placeholder="Email">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br> <br>
        <input type="submit" value="Login" class="standardButton">
    </form>
</div>
<?php
if (isset($_GET['loginSuccess']) && $_GET['loginSuccess'] == false) {
    ?>
    <div>
        <p class="loginFail">Le credenziali inserite sono errate</p>
    </div>
    <?php
}
?>
<a href="signup.php" class="signupLink">
    Non sei registrato? Clicca qui.
</a>

</body>

</html>
