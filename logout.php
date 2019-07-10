<?php

@session_start();
unset($_SESSION['sinema_login']);
header('Location: index.php');
die();
