<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btnGosterimKaydet'])) {
        if (!isset($_POST['gosterim']['id'])) {
            if ($new_id = $db->insert(\Database\MySqlDb::TABLE_GOSTERIM, $_POST['gosterim'])) {
                $db->insert(\Database\MySqlDb::TABLE_BILET, [
                    'gosterim_id' => $new_id,
                    'ucret' => $_POST['bilet']['ucret']
                ]);
                alert('Yeni Gösterim Kaydedildi', 'success');
            } else {
                alert('Gösterim Kaydedilemedi', 'danger');
            }
        } else {
            if ($db->update(\Database\MySqlDb::TABLE_GOSTERIM, $_POST['gosterim'])) {
                $db->delete(\Database\MySqlDb::TABLE_BILET, 'gosterim_id=' . $_POST['gosterim']['id']);
                $db->insert(\Database\MySqlDb::TABLE_BILET, [
                    'gosterim_id' => $_POST['gosterim']['id'],
                    'ucret' => $_POST['bilet']['ucret']
                ]);
                alert('Gösterim Güncellendi', 'success');
            } else {
                alert('Gösterim Kaydedilemedi', 'danger');
            }
        }
    } else if (isset($_POST['btnGosterimSil'])) {
        if (isset($_POST['gosterim']['id'])) {
            if ($db->delete(\Database\MySqlDb::TABLE_GOSTERIM, 'id=' . $_POST['gosterim']['id'])) {
                $db->delete(\Database\MySqlDb::TABLE_BILET, 'gosterim_id=' . $_POST['gosterim']['id']);
                alert('Gösterim Silindi', 'success');
            } else {
                alert('Gösterim Silinemedi', 'danger');
            }
        } else {
            alert('Gösterim Seçmediniz', 'danger');
        }
    }
}

$gosterims = $db->get(\Database\MySqlDb::TABLE_GOSTERIM, '1=1 ORDER BY stamp_created DESC');

$salons = $db->query('SELECT 
so_salon.*,
so_sinema.ad as sinema_ad
FROM so_salon
INNER JOIN so_sinema ON so_salon.sinema_id = so_sinema.id
ORDER BY sinema_ad, ad ASC')->fetchAll(PDO::FETCH_ASSOC);

$films = $db->get(\Database\MySqlDb::TABLE_FILM, '1=1 ORDER BY ad ASC');
$seanss = $db->get(\Database\MySqlDb::TABLE_SEANS, '1=1 ORDER BY zaman ASC');

$salons_cmbOpt = '<option value="">-- Salon Seç --</option>';
foreach ($salons as $salon) {
    $salons_cmbOpt .= '<option value="' . $salon['id'] . '">' . $salon['sinema_ad'] . ' - ' . $salon['ad'] . '</option>';
}

$films_cmbOpt = '<option value="">-- Film Seç --</option>';
foreach ($films as $film) {
    $films_cmbOpt .= '<option value="' . $film['id'] . '">' . $film['ad'] . '</option>';
}

$seanss_cmbOpt = '<option value="">-- Seans Seç --</option>';
foreach ($seanss as $seans) {
    $seanss_cmbOpt .= '<option value="' . $seans['id'] . '">' . $seans['zaman'] . '</option>';
}

?>
<div class="row">
    <div class="col-md-4">
        <form id="frmGosterim" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Gosterim</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Salon:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-camera" aria-hidden="true"></i></span>
                            <select class="form-control" name="gosterim[salon_id]" id="cmbGosterimSalon"
                                    required="required">
                                <?= $salons_cmbOpt; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Film:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-film" aria-hidden="true"></i></span>
                            <select class="form-control" name="gosterim[film_id]" id="cmbGosterimFilm"
                                    required="required">
                                <?= $films_cmbOpt; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tarih:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                            <input type="date" required="required" class="form-control" id="txtGosterimTarih"
                                   placeholder="Tarih Giriniz" name="gosterim[tarih]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Seans:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            <select class="form-control" name="gosterim[seans_id]" id="cmbGosterimSeans"
                                    required="required">
                                <?= $seanss_cmbOpt; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Bilet Ücreti:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                            <input type="number" step="0.01" required="required" class="form-control" id="txtGosterimBiletUcret"
                                   placeholder="Ücret Giriniz" name="bilet[ucret]"
                                   autocomplete="off"/>
                            <span class="input-group-addon"><i class="fa fa-try" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-danger pull-left" name="btnGosterimSil"
                                   value="Sil"/>
                            <input type="submit" class="btn btn-danger pull-right" name="btnGosterimKaydet"
                                   value="Kaydet"/>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-8" style="background-color: #fff; border-radius: 4px;">


        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_gosterimler">Gösterimler</a></li>
        </ul>

        <div class="tab-content" style="padding: 10px">
            <div id="tab_gosterimler" class="tab-pane fade in active">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Salon</th>
                        <th>Film</th>
                        <th>Tarih</th>
                        <th>Seans</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($gosterims as $gosterim) {
                        $salon = array_filter($salons, function ($a) use ($gosterim) {
                            return $a['id'] == $gosterim['salon_id'];
                        });
                        $salon = array_values($salon)[0];

                        $film = array_filter($films, function ($a) use ($gosterim) {
                            return $a['id'] == $gosterim['film_id'];
                        });
                        $film = array_values($film)[0];

                        $seans = array_filter($seanss, function ($a) use ($gosterim) {
                            return $a['id'] == $gosterim['seans_id'];
                        });
                        $seans = array_values($seans)[0];
                        ?>
                        <tr style="cursor: pointer;" gosterim_id="<?= $gosterim['id']; ?>">
                            <td><?= $gosterim['id']; ?></td>
                            <td><?= $salon['sinema_ad'] . ' - ' . $salon['ad']; ?></td>
                            <td><?= $film['ad']; ?></td>
                            <td><?= $gosterim['tarih']; ?></td>
                            <td><?= $seans['zaman']; ?></td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
