<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btnSeansKaydet'])) {
        if (!isset($_POST['seans']['id'])) {
            if ($db->insert(\Database\MySqlDb::TABLE_SEANS, $_POST['seans'])) {
                alert('Yeni Seans Kaydedildi', 'success');
            } else {
                alert('Seans Kaydedilemedi', 'danger');
            }
        } else {
            if ($db->update(\Database\MySqlDb::TABLE_SEANS, $_POST['seans'])) {
                alert('Seans Güncellendi', 'success');
            } else {
                alert('Seans Kaydedilemedi', 'danger');
            }
        }
    } else if (isset($_POST['btnSeansSil'])) {
        if (isset($_POST['seans']['id'])) {
            if (!$db->get(\Database\MySqlDb::TABLE_GOSTERIM, 'seans_id=' . $_POST['seans']['id'])) {
                if ($db->delete(\Database\MySqlDb::TABLE_SEANS, 'id=' . $_POST['seans']['id'])) {
                    alert('Seans Silindi', 'success');
                } else {
                    alert('Seans Silinemedi', 'danger');
                }
            } else {
                alert('Seans Gösterimde Olduğu İçin Silinemez !', 'danger');
            }

        } else {
            alert('Seans Seçmediniz', 'danger');
        }
    }
}

$seanss = $db->get(\Database\MySqlDb::TABLE_SEANS, '1=1 ORDER BY zaman asc');

?>
<div class="row">
    <div class="col-md-4">
        <form id="frmSeans" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Seans</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Zaman:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                            <input type="time" required="required" class="form-control" id="txtSeansZaman"
                                   placeholder="Zaman Giriniz" name="seans[zaman]"
                                   autocomplete="off"/>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-danger pull-left" name="btnSeansSil"
                                   value="Sil"/>
                            <input type="submit" class="btn btn-danger pull-right" name="btnSeansKaydet"
                                   value="Kaydet"/>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-8" style="background-color: #fff; border-radius: 4px;">


        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_seanslar">Seanslar</a></li>
        </ul>

        <div class="tab-content" style="padding: 10px">
            <div id="tab_seanslar" class="tab-pane fade in active">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Zaman</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($seanss as $seans) {
                        ?>
                        <tr style="cursor: pointer;" seans_id="<?= $seans['id']; ?>">
                            <td><?= $seans['id']; ?></td>
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
