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
    }
