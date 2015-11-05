<?php
session_start();
if (!isset($_SESSION['login'])) {
    exit;
}

require_once 'mongo.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $response = array('money' => 0, 'risk' => 0);
    // read
    $db = connectMongo();
    $collection = $db->selectCollection('settings');
    $result = $collection->findOne(array('_id' => 'default'));
    if ($result) {
        $response['money'] = intval($result['money']);
        $response['risk'] = intval($result['risk']);
    }
    echo json_encode($response);
    exit;
}

if ($method === 'POST') {
    $body = file_get_contents('php://input');
    $data = json_decode($body, true);

    if ($data) {
        $template = array('id' => '', 'code' => '', 'amount' => 100, 'cost' => 1, 'operation' => 'buy', 'date' => '');
        $valid = true;
        foreach ($template as $k => $v) {
            if (empty($data[$k])) { // 肯定不能空，另外cost不太可能0
                $valid = false;
                break;
            } else {
                $template[$k] = $data[$k];
            }
        }

        if ($valid) {
            $db = connectMongo();
            $collection = $db->selectCollection('operations');
            $collection->insert($template);
        }
    }
    echo $body;
    exit;
}