<?php
require 'auth.php';
require 'loader.php';

if (isset($_GET['op']))
    switch ($_GET['op']) {
        case 'sinemalar':

            $sinemalar = $db->get(\Database\MySqlDb::TABLE_SINEMA);
            $res = '';
            foreach ($sinemalar as $sinema)
                $res .= '<option value="' . $sinema['id'] . '">' . $sinema['ad'] . '</option>';

            json([
                'html' => $res
            ]);

            break;

        case 'filmler':

            $filmler = $db->get(\Database\MySqlDb::TABLE_FILM);
            $res = '';
            foreach ($filmler as $film)
                $res .= '<option value="' . $film['id'] . '">' . $film['ad'] . '</option>';

            json([
                'html' => $res
            ]);

            break;

        case 'tarihler':

            $res = '';
            for ($i = 1; $i <= 7; $i++) {
                $date = date("Y-m-d", strtotime("+$i days"));
                $res .= '<option value="' . $date . '">' . $date . '</option>';
            }


            json([
                'html' => $res
            ]);
            break;

        case 'getSinema':
            if (isset($_GET['id'])) {
                $sinema_id = $_GET['id'];
                $sinema = $db->get(\Database\MySqlDb::TABLE_SINEMA, 'id=' . $sinema_id);
                if ($sinema) {
                    $sinema = $sinema[0];

                    json([
                        'status' => 'success',
                        'result' => $sinema
                    ]);

                } else {
                    json([
                        'status' => 'failure',
                        'result' => 'Sinema Bulunamadı!'
                    ]);
                }

            } else {
                json([
                    'status' => 'failure',
                    'result' => 'Hatalı İstek !'
                ]);
            }
            break;

        case 'getSalon':
            if (isset($_GET['id'])) {
                $salon_id = $_GET['id'];
                $salon = $db->get(\Database\MySqlDb::TABLE_SALON, 'id=' . $salon_id);
                if ($salon) {
                    $salon = $salon[0];

                    json([
                        'status' => 'success',
                        'result' => $salon
                    ]);

                } else {
                    json([
                        'status' => 'failure',
                        'result' => 'Salon Bulunamadı!'
                    ]);
                }

            } else {
                json([
                    'status' => 'failure',
                    'result' => 'Hatalı İstek !'
                ]);
            }
            break;

        case 'getSeans':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $seans = $db->get(\Database\MySqlDb::TABLE_SEANS, 'id=' . $id);
                if ($seans) {
                    $seans = $seans[0];

                    json([
                        'status' => 'success',
                        'result' => $seans
                    ]);

                } else {
                    json([
                        'status' => 'failure',
                        'result' => 'Seans Bulunamadı!'
                    ]);
                }

            } else {
                json([
                    'status' => 'failure',
                    'result' => 'Hatalı İstek !'
                ]);
            }
            break;

        case 'getFilm':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $film = $db->get(\Database\MySqlDb::TABLE_FILM, 'id=' . $id);
                if ($film) {
                    $film = $film[0];

                    $yonetmens = $db->get(\Database\MySqlDb::TABLE_FILM_YONETMEN, 'film_id=' . $id);
                    //if ($yonetmens)
                    $film['yonetmens'] = array_column($yonetmens, 'yonetmen_id');

                    $oyuncus = $db->get(\Database\MySqlDb::TABLE_FILM_OYUNCU, 'film_id=' . $id);
                    //if ($oyuncus)
                    $film['oyuncus'] = array_column($oyuncus, 'oyuncu_id');

                    json([
                        'status' => 'success',
                        'result' => $film
                    ]);

                } else {
                    json([
                        'status' => 'failure',
                        'result' => 'Seans Bulunamadı!'
                    ]);
                }

            } else {
                json([
                    'status' => 'failure',
                    'result' => 'Hatalı İstek !'
                ]);
            }
            break;

        case 'yonetmenEkle':
            if (isset($_POST['yonetmen'])) {
                $db->insert(\Database\MySqlDb::TABLE_YONETMEN, $_POST['yonetmen']);
            }
            header('Location: index.php?islem=film&tab=yonetmenler');
            break;

        case 'yonetmenSil':
            if (isset($_GET['id'])) {
                $db->delete(\Database\MySqlDb::TABLE_YONETMEN, 'id=' . $_GET['id']);
            }
            header('Location: index.php?islem=film&tab=yonetmenler');
            break;

        case 'oyuncuEkle':
            if (isset($_POST['oyuncu'])) {
                $db->insert(\Database\MySqlDb::TABLE_OYUNCU, $_POST['oyuncu']);
            }
            header('Location: index.php?islem=film&tab=oyuncular');
            break;

        case 'oyuncuSil':
            if (isset($_GET['id'])) {
                $db->delete(\Database\MySqlDb::TABLE_OYUNCU, 'id=' . $_GET['id']);
            }
            header('Location: index.php?islem=film&tab=oyuncular');
            break;

        case 'getGosterim':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $gosterim = $db->get(\Database\MySqlDb::TABLE_GOSTERIM, 'id=' . $id);
                if ($gosterim) {
                    $gosterim = $gosterim[0];

                    $bilet = $db->get(\Database\MySqlDb::TABLE_BILET, 'gosterim_id=' . $id);
                    $gosterim['bilet'] = $bilet ? $bilet[0]['ucret'] : '';

                    json([
                        'status' => 'success',
                        'result' => $gosterim
                    ]);

                } else {
                    json([
                        'status' => 'failure',
                        'result' => 'Salon Bulunamadı!'
                    ]);
                }

            } else {
                json([
                    'status' => 'failure',
                    'result' => 'Hatalı İstek !'
                ]);
            }
            break;

    }
