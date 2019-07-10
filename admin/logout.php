<?php

@session_start();
unset($_SESSION['sinema_login_admin']);
header('Location: index.php');
die();