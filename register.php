<?php
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST;
    if (isset($post['ad']) && !empty($post['ad']) &&
        isset($post['kadi']) && !empty($post['kadi']) &&
        isset($post['parola']) && !empty($post['parola']) &&
        isset($post['parola_tekrar']) && !empty($post['parola_tekrar'])
    ) {
        if ($post['parola'] != $post['parola_tekrar']) {
            alert('Parolalar eşleşmiyor', 'danger');
        } else {
            unset($post['parola_tekrar']);
            $post['parola'] = md5($post['parola']);
            if (!$db->get(\Database\MySqlDb::TABLE_KULLANICI, "kadi='" . $post['kadi'] . "'")) {
                $insert = $db->insert(\Database\MySqlDb::TABLE_KULLANICI, $post);
                if ($insert) {
                    alert('Başarıyla kayıt oldunuz :)', 'success');
                } else {
                    alert('Hata oluştu', 'danger');
                }
            } else {
                alert('Kullanıcı adı sistemde zaten kayıtlı', 'warning');
            }
        }
    }
}

?>


<div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default panel-collapse">
                    <div class="panel-heading">
                        Kullanıcı Kayıt
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ad Soyad:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"
                                                                           aria-hidden="true"></i></span>
                                        <input type="text" required="required" class="form-control"
                                               placeholder="Ad-Soyad Giriniz" name="ad"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">E-mail:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"
                                                                           aria-hidden="true"></i></span>
                                        <input type="email" class="form-control"
                                               placeholder="E-mail Adresi Giriniz" name="email"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Cep Telefonu:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"
                                                                           aria-hidden="true"></i></span>
                                        <input type="tel" class="form-control"
                                               placeholder="Cep Telefonu Giriniz" name="tel"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kullanıcı Adı:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"
                                                                           aria-hidden="true"></i></span>
                                        <input type="text" required="required" class="form-control"
                                               placeholder="Kullanıcı Adını Giriniz" name="kadi"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Parola:</label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-unlock"
                                                                       aria-hidden="true"></i></span>
                                        <input type="password" class="form-control"
                                               placeholder="Parola Giriniz"
                                               name="parola" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Parola Tekrar:</label>
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-unlock"
                                                                       aria-hidden="true"></i></span>
                                        <input type="password" class="form-control"
                                               placeholder="Parolayı Tekrar Giriniz"
                                               name="parola_tekrar" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success pull-right" type="submit">Kayıt Ol</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
