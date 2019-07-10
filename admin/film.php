<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btnFilmKaydet'])) {
        if (!isset($_POST['film']['id'])) {
            if ($new_id = $db->insert(\Database\MySqlDb::TABLE_FILM, $_POST['film'])) {
                if (isset($_POST['yonetmens']))
                    foreach ($_POST['yonetmens'] as $yonetmen) {
                        $db->insert(\Database\MySqlDb::TABLE_FILM_YONETMEN, [
                            'film_id' => $new_id,
                            'yonetmen_id' => $yonetmen
                        ]);
                    }
                if (isset($_POST['oyuncus']))
                    foreach ($_POST['oyuncus'] as $oyuncu) {
                        $db->insert(\Database\MySqlDb::TABLE_FILM_OYUNCU, [
                            'film_id' => $new_id,
                            'oyuncu_id' => $oyuncu
                        ]);
                    }
                alert('Yeni Film Kaydedildi', 'success');
            } else {
                alert('Film Kaydedilemedi', 'danger');
            }
        } else {
            if ($db->update(\Database\MySqlDb::TABLE_FILM, $_POST['film'])) {
                $db->delete(\Database\MySqlDb::TABLE_FILM_YONETMEN, 'film_id=' . $_POST['film']['id']);
                $db->delete(\Database\MySqlDb::TABLE_FILM_OYUNCU, 'film_id=' . $_POST['film']['id']);
                if (isset($_POST['yonetmens']))
                    foreach ($_POST['yonetmens'] as $yonetmen) {
                        $db->insert(\Database\MySqlDb::TABLE_FILM_YONETMEN, [
                            'film_id' => $_POST['film']['id'],
                            'yonetmen_id' => $yonetmen
                        ]);
                    }
                if (isset($_POST['oyuncus']))
                    foreach ($_POST['oyuncus'] as $oyuncu) {
                        $db->insert(\Database\MySqlDb::TABLE_FILM_OYUNCU, [
                            'film_id' => $_POST['film']['id'],
                            'oyuncu_id' => $oyuncu
                        ]);
                    }
                alert('Film Güncellendi', 'success');
            } else {
                alert('Film Kaydedilemedi', 'danger');
            }
        }
    } else if (isset($_POST['btnFilmSil'])) {
        if (isset($_POST['film']['id'])) {
            if ($db->delete(\Database\MySqlDb::TABLE_FILM, 'id=' . $_POST['film']['id'])) {
                $db->delete(\Database\MySqlDb::TABLE_FILM_YONETMEN, 'film_id=' . $_POST['film']['id']);
                $db->delete(\Database\MySqlDb::TABLE_FILM_OYUNCU, 'film_id=' . $_POST['film']['id']);
                alert('Film Silindi', 'success');
            } else {
                alert('Film Silinemedi', 'danger');
            }
        } else {
            alert('Film Seçmediniz', 'danger');
        }
    }
}

$films = $db->get(\Database\MySqlDb::TABLE_FILM, '1=1 ORDER BY stamp_created DESC');
$yonetmens = $db->get(\Database\MySqlDb::TABLE_YONETMEN, '1=1 ORDER BY ad ASC');
$oyuncus = $db->get(\Database\MySqlDb::TABLE_OYUNCU, '1=1 ORDER BY ad ASC');

$yonetmens_cmbOpt = '';
foreach ($yonetmens as $yonetmen) {
    $yonetmens_cmbOpt .= '<option value="' . $yonetmen['id'] . '">' . $yonetmen['ad'] . '</option>';
}

$oyuncus_cmbOpt = '';
foreach ($oyuncus as $oyuncu) {
    $oyuncus_cmbOpt .= '<option value="' . $oyuncu['id'] . '">' . $oyuncu['ad'] . '</option>';
}


$tab = isset($_GET['tab']) ? $_GET['tab'] : 'filmler';


?>
<div class="row">
    <div class="col-md-4">
        <form id="frmFilm" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Film</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Ad:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-film" aria-hidden="true"></i></span>
                            <input type="text" required="required" class="form-control" id="txtFilmAd"
                                   placeholder="Film Adı Giriniz" name="film[ad]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Yıl:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-times-o"
                                                               aria-hidden="true"></i></span>
                            <input type="number" min="1900" max="2099" step="1" required="required" class="form-control"
                                   id="txtFilmYil"
                                   placeholder="Film Yılı Giriniz" name="film[yil]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Dil:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-language" aria-hidden="true"></i></span>
                            <input type="text" required="required" class="form-control" id="txtFilmDil"
                                   placeholder="Film Dili Giriniz" name="film[dil]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Süre:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            <input type="number" required="required" class="form-control" id="txtFilmSure"
                                   placeholder="Film Süresi Giriniz" name="film[sure]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Yönetmen:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-male" aria-hidden="true"></i></span>
                            <select class="form-control" name="yonetmens[]" id="cmbFilmYonetmen" multiple>
                                <?= $yonetmens_cmbOpt; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Oyuncular:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-male" aria-hidden="true"></i></span>
                            <select class="form-control" name="oyuncus[]" id="cmbFilmOyuncu" multiple>
                                <?= $oyuncus_cmbOpt; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-danger pull-left" name="btnFilmSil"
                                   value="Sil"/>
                            <input type="submit" class="btn btn-danger pull-right" name="btnFilmKaydet"
                                   value="Kaydet"/>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-8" style="background-color: #fff; border-radius: 4px;">


        <ul class="nav nav-tabs">
            <li class="<?= $tab == 'filmler' ? 'active' : '' ?>"><a data-toggle="tab" href="#tab_filmler">Filmler</a>
            </li>
            <li class="<?= $tab == 'yonetmenler' ? 'active' : '' ?>"><a data-toggle="tab" href="#tab_yonetmenler">Yönetmenler</a>
            </li>
            <li class="<?= $tab == 'oyuncular' ? 'active' : '' ?>"><a data-toggle="tab"
                                                                      href="#tab_oyuncular">Oyuncular</a></li>
        </ul>

        <div class="tab-content" style="padding: 10px">
            <div id="tab_filmler" class="tab-pane fade <?= $tab == 'filmler' ? 'in active' : '' ?>">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Yıl</th>
                        <th>Dil</th>
                        <th>Süre</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($films as $film) {
                        ?>
                        <tr style="cursor: pointer;" film_id="<?= $film['id']; ?>">
                            <td><?= $film['id']; ?></td>
                            <td><?= $film['ad']; ?></td>
                            <td><?= $film['yil']; ?></td>
                            <td><?= $film['dil']; ?></td>
                            <td><?= $film['sure']; ?></td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>

            <div id="tab_yonetmenler" class="tab-pane fade <?= $tab == 'yonetmenler' ? 'in active' : '' ?>">
                <form action="service.php?op=yonetmenEkle" method="POST">
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="text" size="30" class="form-control" name="yonetmen[ad]" required="required"
                                   placeholder="Eklemek istediğiniz yönetmen adı giriniz"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger btn-sm" value="Ekle">
                        </div>
                    </div>
                </form>
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($yonetmens as $yonetmen) {
                        ?>
                        <tr style="cursor: pointer;" yonetmen_id="<?= $yonetmen['id']; ?>">
                            <td><?= $yonetmen['id']; ?></td>
                            <td><?= $yonetmen['ad']; ?></td>
                            <td><a href="service.php?op=yonetmenSil&id=<?= $yonetmen['id']; ?>"
                                   class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Sil</a></td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>

            <div id="tab_oyuncular" class="tab-pane fade <?= $tab == 'oyuncular' ? 'in active' : '' ?>">
                <form action="service.php?op=oyuncuEkle" method="POST">
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="text" size="30" class="form-control" name="oyuncu[ad]" required="required"
                                   placeholder="Eklemek istediğiniz oyuncu adı giriniz"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger btn-sm" value="Ekle">
                        </div>
                    </div>
                </form>
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($oyuncus as $oyuncu) {
                        ?>
                        <tr style="cursor: pointer;" oyuncu_id="<?= $oyuncu['id']; ?>">
                            <td><?= $oyuncu['id']; ?></td>
                            <td><?= $oyuncu['ad']; ?></td>
                            <td><a href="service.php?op=oyuncuSil&id=<?= $oyuncu['id']; ?>"
                                   class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Sil</a></td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
