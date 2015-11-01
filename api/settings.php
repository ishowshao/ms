<?php
session_start();
if (!isset($_SESSION['login'])) {
    exit;
}

require_once 'mongo.php';

if (!isset($_POST['money'])) {
    $response = array('success' => true, 'money' => 0);
    // read
    $db = connectMongo();
    $collection = $db->selectCollection('settings');
    $result = $collection->findOne(array('_id' => 'money'));
    if ($result && isset($result['value'])) {
        $response['money'] = intval($result['value']);
    }
    echo json_encode($response);
    exit;
}

if (isset($_POST['money'])) {
    $value = intval($_POST['money']);

    $response = array('success' => true, 'money' => $value);

    $db = connectMongo();
    $collection = $db->selectCollection('settings');

    $collection->update(array('_id' => 'money'), array('value' => $value));

    echo json_encode($response);
    exit;
}