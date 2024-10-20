<?php
// logger.php
$config = require __DIR__ . '/config.php';

function logMessage($message, $level = 'INFO') {
    global $config;
    $logFile = $config['log_file'];
    $timestamp = date("Y-m-d H:i:s");
    file_put_contents($logFile, "[$timestamp] [$level] $message" . PHP_EOL, FILE_APPEND);
}
