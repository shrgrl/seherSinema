<?php
require 'auth.php';
require 'header.php';

$sayfa = '';
if (isset($_GET['islem']))
    switch ($_GET['islem']) {
        case 'sinema_salon':
        case 'seans':
        case 'film':
        case 'gosterim_bilet':
        case 'satis':
            $sayfa = $_GET['islem'] . '.php';
            break;
    }

?>
<div class="container-fluid" style="margin: 0px 20px 0px 20px;">
    <div class="row">
        <div class="col-sm-2">
            <div class="row">
                <div class="col-md-12">
                    <a href="?islem=sinema_salon" class="btn btn-primary btn-lg btn-block"
                       style="background-color: #1b6d85; cursor: pointer; border-radius: 5px">
                        Sinema & Salon
                    </a>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-12">
                    <a href="?islem=seans" class="btn btn-primary btn-lg btn-block"
                       style="background-color: #1b6d85; cursor: pointer; border-radius: 5px">
                        Seans
                    </a>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-12">
                    <a href="?islem=film" class="btn btn-primary btn-lg btn-block"
                       style="background-color: #1b6d85; cursor: pointer; border-radius: 5px">
                        Film
                    </a>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-12">
                    <a href="?islem=gosterim_bilet" class="btn btn-primary btn-lg btn-block"
                       style="background-color: #1b6d85; cursor: pointer; border-radius: 5px">
                        Gösterim & Bilet
                    </a>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-12">
                    <a href="?islem=satis" class="btn btn-primary btn-lg btn-block"
                       style="background-color: #1b6d85; cursor: pointer; border-radius: 5px">
                        Satış
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ($sayfa)
                        require $sayfa;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
