<?php
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST;
    if (isset($post['kadi']) && !empty($post['kadi']) &&
        isset($post['parola']) && !empty($post['parola'])) {
        if ($post['kadi'] = 'admin' && $post['parola'] == 'admin') {
            $_SESSION['sinema_login_admin'] = [
                'kadi' => 'admin',
                'ad' => 'Yönetici'
            ];
            header('Location: index.php');
        } else {
            alert('Bilgiler Yanlış', 'danger');
        }
    }
}

?>


<div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default panel-collapse login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-12">Admin Girişi</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label class="control-label">Kullanıcı Adı:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"
                                                                           aria-hidden="true"></i></span>
                                        <input maxlength="300" type="text" required="required" class="form-control"
                                               placeholder="Kullanıcı Adınızı Giriniz" name="kadi"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Parola:</label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-unlock"
                                                                       aria-hidden="true"></i></span>
                                        <input maxlength="300" type="password" class="form-control"
                                               placeholder="Parolanızı Giriniz"
                                               name="parola" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success pull-right" type="submit">Giriş Yap</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
