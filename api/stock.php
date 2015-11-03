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
    $data = json_decode($body);

    if ($data) {

        $db = connectMongo();
        $collection = $db->selectCollection('settings');

        $collection->update(array('_id' => 'default'), $data);
    }
    echo $body;
    exit;
}