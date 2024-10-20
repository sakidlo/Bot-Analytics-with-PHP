<?php
// db.php
$config = require __DIR__ . '/config.php';

function getDbConnection() {
    global $config;
    $conn = new mysqli(
        $config['db']['host'],
        $config['db']['username'],
        $config['db']['password'],
        $config['db']['dbname']
    );

    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Database connection failed.");
    }
    
    return $conn;
}
