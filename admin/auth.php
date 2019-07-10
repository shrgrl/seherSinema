<?php
@session_start();

if (isset($_SESSION['sinema_login_admin']) && !empty($_SESSION['sinema_login_admin'])) {

} else {
    header('Location: login.php');
    die();
}