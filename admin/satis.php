<?php

$from = " FROM so_satis 
INNER JOIN so_bilet ON so_satis.bilet_id = so_bilet.id
INNER JOIN so_gosterim ON so_bilet.gosterim_id = so_gosterim.id
INNER JOIN so_film ON so_gosterim.film_id = so_film.id
INNER JOIN so_kullanici ON so_satis.user_id = so_kullanici.id ";

$orderby = " ORDER BY so_satis.stamp_created DESC";


$columns = "SELECT 
so_satis.*,
so_bilet.ucret as ucret,
so_film.ad as film_ad,
so_kullanici.ad as musteri_ad
";
$satislar = $db->query($columns . $from . $orderby)->fetchAll();

$columns = "SELECT 
COUNT(so_satis.id) as satis_miktar,
SUM(so_bilet.ucret) as hasilat,
so_film.ad as film_ad
";
$groupby = " GROUP BY so_film.id ";
$satislar_film_bazinda = $db->query($columns . $from . $groupby . $orderby)->fetchAll();

?>

<div class="col-md-12" style="background-color: #fff; border-radius: 4px;">


    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab_satislar">Satışlar</a></li>
        <li><a data-toggle="tab" href="#tab_film_bazinda">Film Bazında</a></li>
    </ul>

    <div class="tab-content" style="padding: 10px">
        <div id="tab_satislar" class="tab-pane fade in active">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Müşteri Adı</th>
                    <th>Film</th>
                    <th>Ücret</th>
                    <th>Koltuk No</th>
                    <th>Satış Tarihi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($satislar as $satis) {
                    ?>
                    <tr style="cursor: pointer;" satis_id="<?= $satis['id']; ?>">
                        <td><?= $satis['id']; ?></td>
                        <td><?= $satis['musteri_ad']; ?></td>
                        <td><?= $satis['film_ad']; ?></td>
                        <td><?= $satis['ucret']; ?></td>
                        <td><?= $satis['koltuk_no']; ?></td>
                        <td><?= $satis['stamp_created']; ?></td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        </div>

        <div id="tab_film_bazinda" class="tab-pane fade">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Film</th>
                    <th>Satış Miktarı</th>
                    <th>Hasılat</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($satislar_film_bazinda as $satis) {
                    ?>
                    <tr style="cursor: pointer;" satis_id="<?= $satis['id']; ?>">
                        <td><?= $satis['film_ad']; ?></td>
                        <td><?= $satis['satis_miktar']; ?></td>
                        <td><?= $satis['hasilat']; ?></td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
