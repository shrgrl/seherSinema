<?php
require 'auth.php';
require 'header.php';

$sinema_id = isset($_GET['sinemalar']) ? $_GET['sinemalar'] : null;
$film_id = isset($_GET['filmler']) ? $_GET['filmler'] : null;
$tarih = isset($_GET['tarihler']) ? $_GET['tarihler'] : null;

$sql = "SELECT 
so_gosterim.id as gosterim_id, 
so_salon.sinema_id,
so_sinema.ad as sinema_ad,
so_gosterim.salon_id, 
so_salon.ad as salon_ad, 
so_salon.kapasite,
so_gosterim.film_id, 
so_film.ad as film_ad,
so_gosterim.seans_id,
so_seans.zaman,
so_gosterim.tarih 
FROM so_gosterim 
INNER JOIN so_salon ON so_gosterim.salon_id = so_salon.id
INNER JOIN so_seans ON so_gosterim.seans_id = so_seans.id
INNER JOIN so_sinema ON so_salon.sinema_id = so_sinema.id
INNER JOIN so_film ON so_gosterim.film_id = so_film.id";

$where = ' WHERE 1=1';
if ($sinema_id) $where .= " AND so_salon.sinema_id=" . $sinema_id;
if ($film_id) $where .= " AND so_film.id=" . $film_id;
if ($tarih) $where .= " AND so_gosterim.tarih='" . $tarih . "'";

$groupby = ' GROUP BY so_film.id';

$qs = $db->query($sql . $where . $groupby . ' ORDER BY so_film.id')->fetchAll(PDO::FETCH_ASSOC);
//println($qs);

?>
<div class="container">
    <form method="get" id="mainForm">
        <div class="row">
            <div class="col-sm-3" style="background-color: #1b6d85; cursor: pointer; border-radius: 5px"
                 onclick="$('#mainForm').submit();">
                <div class="row"><h3 class="text-center" style="color: #fff; margin-bottom: 15px; margin-top: 15px;">
                        ARA</h3></div>
            </div>
            <div class="col-sm-9 hidden" style="background-color: #1b6d85; cursor: pointer; border-radius: 5px"
                 onclick="$('#mainForm').submit();">
                <div class="row"><h3 class="text-center" style="color: #fff; margin-bottom: 15px; margin-top: 15px;">
                        ARA</h3></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="row">
                    <h3 style="color: #1b6d85;">Sinema</h3>
                    <div class="form-group">
                        <select class="form-control" id="sinemalar" name="sinemalar" multiple></select>
                    </div>
                </div>
                <div class="row">
                    <h3 style="color: #1b6d85;">Film</h3>
                    <div class="form-group">
                        <select class="form-control" id="filmler" name="filmler" multiple></select>
                    </div>
                </div>
                <div class="row">
                    <h3 style="color: #1b6d85;">Tarih</h3>
                    <div class="form-group">
                        <select class="form-control" id="tarihler" name="tarihler" multiple></select>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row" style="margin-top: 50px">
                    <div class="col-md-12">
                        <?php foreach ($qs as $q) { ?>
                            <div class="col-md-4 text-center">
                                <div class="well"
                                     onclick="window.location.href = 'gosterim.php?film_id=<?= $q['film_id'] ?>'"
                                     style="height: 200px; background: #c7254e; color: #fff; border-radius: 10px; cursor: pointer"
                                     onmouseover="this.style.background='#A11135'"
                                     onmouseout="this.style.background='#c7254e'">

                                    <hr style="border-color: wheat; margin-top: 40px; margin-bottom: 0px">
                                    <h3><strong><?= $q['film_ad'] ?></strong></h3>
                                    <hr style="border-color: wheat; margin-top: 0px; margin-bottom: 0px">

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>