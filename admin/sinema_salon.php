<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['btnSinemaKaydet'])) {
        if (!isset($_POST['sinema']['id'])) {
            if ($db->insert(\Database\MySqlDb::TABLE_SINEMA, $_POST['sinema'])) {
                alert('Yeni Sinema Kaydedildi', 'success');
            } else {
                alert('Sinema Kaydedilemedi', 'danger');
            }
        } else {
            if ($db->update(\Database\MySqlDb::TABLE_SINEMA, $_POST['sinema'])) {
                alert('Sinema Güncellendi', 'success');
            } else {
                alert('Sinema Kaydedilemedi', 'danger');
            }
        }
    } else if (isset($_POST['btnSalonKaydet'])) {
        if (!isset($_POST['salon']['id'])) {
            if ($db->insert(\Database\MySqlDb::TABLE_SALON, $_POST['salon'])) {
                alert('Yeni Salon Kaydedildi', 'success');
            } else {
                alert('Salon Kaydedilemedi', 'danger');
            }
        } else {
            if ($db->update(\Database\MySqlDb::TABLE_SALON, $_POST['salon'])) {
                alert('Salon Güncellendi', 'success');
            } else {
                alert('Salon Kaydedilemedi', 'danger');
            }
        }

    } else if (isset($_POST['btnSinemaSil'])) {
        if (isset($_POST['sinema']['id'])) {
            if (!$db->get(\Database\MySqlDb::TABLE_SALON, 'sinema_id=' . $_POST['sinema']['id'])) {
                if ($db->delete(\Database\MySqlDb::TABLE_SINEMA, 'id=' . $_POST['sinema']['id'])) {
                    alert('Sinema Silindi', 'success');
                } else {
                    alert('Sinema Silinemedi', 'danger');
                }
            } else {
                alert('Sinemanın Salonları Olduğu İçin Silinemez !', 'danger');
            }
        } else {
            alert('Sinema Seçmediniz', 'danger');
        }
    } else if (isset($_POST['btnSalonSil'])) {
        if (isset($_POST['salon']['id'])) {
            if (!$db->get(\Database\MySqlDb::TABLE_GOSTERIM, 'salon_id=' . $_POST['salon']['id'])) {
                if ($db->delete(\Database\MySqlDb::TABLE_SALON, 'id=' . $_POST['salon']['id'])) {
                    alert('Salon Silindi', 'success');
                } else {
                    alert('Salon Silinemedi', 'danger');
                }
            } else {
                alert('Salon Gösterimde Olduğu İçin Silinemez !', 'danger');
            }
        } else {
            alert('Salon Seçmediniz', 'danger');
        }
    }
}

$sinemas = $db->get(\Database\MySqlDb::TABLE_SINEMA);
$salons = $db->get(\Database\MySqlDb::TABLE_SALON);

$sinemas_cmbOpt = '';
foreach ($sinemas as $sinema) {
    $sinemas_cmbOpt .= '<option value="' . $sinema['id'] . '">' . $sinema['ad'] . '</option>';
}
?>
<div class="row">
    <div class="col-md-4">
        <form id="frmSinema" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Sinema</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Sinema Adı:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-video-camera" aria-hidden="true"></i></span>
                            <input type="text" required="required" class="form-control" id="txtSinemaAd"
                                   placeholder="Sinema Adı" name="sinema[ad]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Yer:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <input type="text" required="required" class="form-control" id="txtSinemaYer"
                                   placeholder="Sinema Yer" name="sinema[yer]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-danger pull-left" name="btnSinemaSil"
                                   value="Sil"/>
                            <input type="submit" class="btn btn-danger pull-right" name="btnSinemaKaydet"
                                   value="Kaydet"/>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-8">
        <form id="frmSalon" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Salon</strong>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Sinema:</label>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-video-camera"
                                                                   aria-hidden="true"></i></span>
                                    <select required="required" class="form-control" id="cmbSinemalar"
                                            name="salon[sinema_id]"
                                            autocomplete="off">
                                        <option value="0">--Sinema Seçiniz--</option>
                                        <?= $sinemas_cmbOpt; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Salon Adı:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-film" aria-hidden="true"></i></span>
                                    <input type="text" required="required" class="form-control" id="txtSalonAd"
                                           placeholder="Salon Adı" name="salon[ad]"
                                           autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kapasite:</label>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"
                                                                   aria-hidden="true"></i></span>
                                    <input type="number" required="required" class="form-control" id="txtSalonKapasite"
                                           placeholder="Salon Kapasitesi" name="salon[kapasite]"
                                           autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ses Sistemi:</label>
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"
                                                                   aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" id="txtSalonSesSistemi"
                                           placeholder="Ses Sistemi" name="salon[ses_sistemi]"
                                           autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-danger pull-left" name="btnSalonSil"
                                   value="Sil"/>
                            <input type="submit" class="btn btn-danger pull-right" name="btnSalonKaydet"
                                   value="Kaydet"/>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<div class="row" style="background-color: #fff; border-radius: 4px;">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab_sinemalar">Sinemalar</a></li>
        <li><a data-toggle="tab" href="#tab_salonlar">Salonlar</a></li>
    </ul>

    <div class="tab-content" style="padding: 10px">
        <div id="tab_sinemalar" class="tab-pane fade in active">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Sinema Adı</th>
                    <th>Sinema Yeri</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sinemas as $sinema) {
                    ?>
                    <tr style="cursor: pointer;" sinema_id="<?= $sinema['id']; ?>">
                        <td><?= $sinema['id']; ?></td>
                        <td><?= $sinema['ad']; ?></td>
                        <td><?= $sinema['yer']; ?></td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        </div>
        <div id="tab_salonlar" class="tab-pane fade">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Sinema Adı</th>
                    <th>Salon Adı</th>
                    <th>Kapasite</th>
                    <th>Ses Sistemi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($salons as $salon) {
                    $salon_sinema = array_filter($sinemas, function ($a) use ($salon) {
                        return $a['id'] == $salon['sinema_id'];
                    });
                    $salon_sinema = array_values($salon_sinema)[0];
                    ?>
                    <tr style="cursor: pointer;" sinema_id="<?= $salon['id']; ?>">
                        <td><?= $salon['id']; ?></td>
                        <td><?= $salon_sinema['ad']; ?></td>
                        <td><?= $salon['ad']; ?></td>
                        <td><?= $salon['kapasite']; ?></td>
                        <td><?= $salon['ses_sistemi']; ?></td>
                    </tr>
                    <?php
                } ?>
                </tbody>
            </table>
        </div>

    </div>

</div>