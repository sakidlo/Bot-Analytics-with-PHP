<?php
// BotAnalytics.php
require_once __DIR__ . '/../libs/CrawlerDetect.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/logger.php';

function saveBotData($ip, $userAgent, $domainName, $fullPath, $checkValue) {
    $conn = getDbConnection();
    $stmt = $conn->prepare("INSERT INTO bot_data (ip, user_agent, domain_name, full_path, check_value) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $ip, $userAgent, $domainName, $fullPath, $checkValue);
    $stmt->execute();

    if ($stmt->error) {
        logMessage('Error inserting bot data: ' . $stmt->error, 'ERROR');
    } else {
        logMessage('Bot data successfully inserted for ' . $ip);
    }

    $stmt->close();
    $conn->close();
}
