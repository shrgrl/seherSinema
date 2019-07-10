<?php
require 'auth.php';
require 'header.php';

if (!isset($_GET['film_id'])) {
    header('Location: index.php');
}

$film_id = $_GET['film_id'];

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
so_gosterim.tarih,
(select so_bilet.id from so_bilet where so_bilet.gosterim_id = so_gosterim.id) as bilet_id,
(select so_bilet.ucret from so_bilet where so_bilet.gosterim_id = so_gosterim.id) as bilet_ucret,
IF((select so_bilet.id from so_bilet where so_bilet.gosterim_id = so_gosterim.id) IS NOT NULL, (select COUNT(*) from so_satis where so_satis.bilet_id = (select so_bilet.id from so_bilet where so_bilet.gosterim_id = so_gosterim.id)), 0) as satis_count  
FROM so_gosterim 
INNER JOIN so_salon ON so_gosterim.salon_id = so_salon.id
INNER JOIN so_seans ON so_gosterim.seans_id = so_seans.id
INNER JOIN so_sinema ON so_salon.sinema_id = so_sinema.id
INNER JOIN so_film ON so_gosterim.film_id = so_film.id";

$where = ' WHERE so_gosterim.tarih >= DATE(NOW()) AND so_gosterim.film_id=' . $film_id;

$groupby = ' GROUP BY so_film.id';

$qs = $db->query($sql . $where . ' ORDER BY so_film.id')->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container">
    <form action="index.php" method="get" id="mainForm">
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
                                     onclick="window.location.href = 'bilet.php?gosterim_id=<?= $q['gosterim_id'] ?>'"
                                     style="height: 200px; background: #5cb85c; color: #fff; border-radius: 10px; cursor: pointer; <?= ($q['kapasite'] - $q['satis_count']) == 0 ? 'pointer-events: none; opacity: 0.5;' : '' ?>"
                                     onmouseover="this.style.background='#3c763d'"
                                     onmouseout="this.style.background='#5cb85c'">
                                    <h4><strong><?= $q['film_ad'] ?></strong></h4>
                                    <hr style="border-color: wheat; margin-top: 0px; margin-bottom: 0px">
                                    <h5><i class="fa fa-calendar"></i> <?= $q['tarih'] ?> <i
                                                class="fa fa-clock-o"></i> <?= $q['zaman'] ?></h5>
                                    <hr style="border-color: wheat; margin-top: 0px; margin-bottom: 0px">
                                    <h5><i class="fa fa-map-marker"></i> <?= $q['sinema_ad'] ?> - <?= $q['salon_ad'] ?>
                                    </h5>
                                    <hr style="border-color: wheat; margin-top: 0px; margin-bottom: 0px">
                                    <h5><i class="fa fa-bookmark-o"></i> <?= $q['kapasite'] - $q['satis_count'] ?>
                                        koltuk müsait</h5>
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
