<?php
$suggestApi = 'http://suggest3.sinajs.cn/suggest/type=&key=%s&name=a';

if (isset($_GET['key'])) {
    $response = array();
    $key = trim($_GET['key']);
//$key = 'dfc';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, sprintf($suggestApi, $key));
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = substr(mb_convert_encoding(curl_exec($ch), 'utf8', 'gbk'), 7, -3);
    curl_close($ch);

    if ($result) {
        $result = explode(';', $result);
        foreach ($result as $k => $v) {
            $item = explode(',', $v);
            $result[$k] = array('code' => $item[2], 'id' => $item[3], 'name' => $item[4]);
        }
        echo json_encode($result);
    } else {
        echo '[]';
    }
} else {
    echo '[]';
}