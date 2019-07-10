<?php


function cURL($url, $post = null, $requestHeader = null, $cookie = 'cookie.txt')
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, realpath($cookie));
    curl_setopt($ch, CURLOPT_COOKIEFILE, realpath($cookie));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    if ($requestHeader)
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader);

    if ($post) {
        if (!is_array($post)) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        } else {
            $postvars = http_build_query($post);
            curl_setopt($ch, CURLOPT_POST, count($post));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        }
    }

    $result = curl_exec($ch);
    //$result = iconv('ISO-8859-9','UTF-8',$result);


    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($result, 0, $header_size);
    $body = substr($result, $header_size);

    curl_close($ch);
    $arr = array(
        'header_size' => $header_size,
        'header' => $header,
        'body' => $body
    );
    return $arr;
}

function getMilliseconds()
{
    return round(microtime(true) * 1000);
}

function println($data)
{
    if (is_array($data)) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    } else {
        echo $data . '<br>';
    }
}

function parse_query($query_string)
{
    $queries = array();
    $query_pairs = explode('&', trim($query_string));
    foreach ($query_pairs as $pair) {
        $pair = explode('=', $pair);
        $queries[$pair[0]] = $pair[1];
    }
    return $queries;
}

function only_number($string)
{
    //trim($string, "a..zA..Z")
    //filter_var("AR3,373.31", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);
    return preg_replace("/[^0-9,.]/", "", $string);
}

function getBase64Image($img_src)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $img_src);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
    $res = curl_exec($ch);
    $rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    //$type 		= 	pathinfo($img_src, PATHINFO_EXTENSION);
    $base64 = base64_encode($res);

    return $base64;
}

function mysql_unreal_escape_string($string)
{
    $characters = array('x00', 'n', 'r', '\\', '\'', '"', 'x1a');
    $o_chars = array("\x00", "\n", "\r", "\\", "'", "\"", "\x1a");
    for ($i = 0; $i < strlen($string); $i++) {
        if (substr($string, $i, 1) == '\\') {
            foreach ($characters as $index => $char) {
                if ($i <= strlen($string) - strlen($char) && substr($string, $i + 1, strlen($char)) == $char) {
                    $string = substr_replace($string, $o_chars[$index], $i, strlen($char) + 1);
                    break;
                }
            }
        }
    }
    return $string;
}

function array_to_xml($data, &$xml_data)
{
    foreach ($data as $key => $value) {
        if (is_numeric($key)) {
            $key = 'item' . $key; //dealing with <0/>..<n/> issues
        }
        if (is_array($value)) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

function getDir()
{
    $url = $_SERVER['REQUEST_URI']; //returns the current URL
    $parts = explode('/', $url);
    $dir = $_SERVER['SERVER_NAME'];
    for ($i = 0; $i < count($parts) - 1; $i++) {
        $dir .= $parts[$i] . "/";
    }
    return $dir;
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}


function alert($alertMsg, $alertType = 'info')
{
    echo '<div class="alert alert-dismissable alert-' . $alertType . '">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            ' . $alertMsg . '
           </div>';
}

function json(array $array)
{

    $json = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    $result = '[]';
    if ($json && json_last_error() == JSON_ERROR_NONE) {
        $result = $json;
    } else {
        $result = '{"HATA": "JSON HATASI OLUŞTU. MESAJ: ' . json_last_error_msg() . '"}';
    }

    header('Content-type: application/json; charset=utf8');
    echo $result;
}

function array_sort($array, $on, $order = SORT_ASC)
{

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}