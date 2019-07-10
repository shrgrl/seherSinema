<?php
require 'loader.php';

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <title><?= isset($_SESSION['sinema_login_admin']) ? $_SESSION['sinema_login_admin']['ad'].' - ' : ''; ?>Sinema Otomasyonu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon-film.ico" type="image/x-icon">
    <link rel="icon" href="favicon-film.ico" type="image/x-icon">

    <!-- include alertify.css -->
    <link rel="stylesheet" href="css/alertify.css">
    <link rel="stylesheet" href="css/themes/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- include alertify script -->
    <script src="js/alertify.js"></script>
    <script type="text/javascript">
        //override defaults
        alertify.defaults.transition = "pulse";
        alertify.defaults.theme.ok = "btn btn-primary";
        alertify.defaults.theme.cancel = "btn btn-danger";
        alertify.defaults.theme.input = "form-control";
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <style>
        .input-group-addon {
            min-width: 40px;
            text-align: left;
        }

        .btn span.glyphicon {
            opacity: 0;
        }

        .btn.active span.glyphicon {
            opacity: 1;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= 'http://' . getDir(); ?>" style="color:#d32f2f;"><i
                        class="fa fa-film"></i> Sinema <sub>Yönetici</sub></a>
        </div>
        <div class="collapse navbar-collapse " id="myNavbar">
            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="<?= isset($_SESSION['sinema_login_admin']) ? '' : 'hidden' ?>"><a href="logout.php"><span
                                class="glyphicon glyphicon-log-in"></span> Yönetimden Çıkış Yap</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="row" style="height: 20px"></div>