<?php
@session_start();

if (isset($_SESSION['sinema_login']) && !empty($_SESSION['sinema_login'])) {

} else {
    header('Location: login.php');
    die();
}