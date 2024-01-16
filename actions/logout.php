<?php
if (!isset($_SESSION['logged'])) {
    header("Location: login.php");
}
session_start();
session_destroy();
session_unset();
header("Location: http://localhost:8000/views/login.php");
exit();