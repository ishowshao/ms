<?php
/**
 * @return MongoDB
 */
function connectMongo()
{
    $dbName = 'stock';
    $host = '127.0.0.1';
    $port = '27017';
    try {
        $mongoClient = new MongoClient("mongodb://{$host}:{$port}");
        $mongoDB = $mongoClient->selectDB($dbName);

        return $mongoDB;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}