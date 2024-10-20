<?php

// example script

require 'vendor/autoload.php'; // Load Composer dependencies

use Jaybizzle\CrawlerDetect\CrawlerDetect;

if (!isset($sRetry)) {
    $sRetry = 1;

    // Initialize CrawlerDetect
    $CrawlerDetect = new CrawlerDetect;

    // Get the user's User-Agent string
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Check if the User-Agent is a crawler
    if ($CrawlerDetect->isCrawler($userAgent)) {
        // Get additional data
        $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
        $domainName = filter_var($_SERVER['HTTP_HOST'], FILTER_SANITIZE_URL);
        $fullPath = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $checkValue = isset($_GET['check']) ? filter_var($_GET['check'], FILTER_SANITIZE_STRING) : '';

        // Store the data in the database
        $pdo = new PDO('mysql:host=localhost;dbname=bot_analytics', 'your_db_user', 'your_db_password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO bot_data (ip, user_agent, domain_name, full_path, check_value) VALUES (:ip, :user_agent, :domain_name, :full_path, :check_value)");
        $stmt->execute([
            ':ip' => $ip,
            ':user_agent' => $userAgent,
            ':domain_name' => $domainName,
            ':full_path' => $fullPath,
            ':check_value' => $checkValue
        ]);

        // Log bot information to a file
        $logData = date('Y-m-d H:i:s') . " - Bot detected: IP - $ip, User-Agent - $userAgent, Domain - $domainName, Full Path - $fullPath, Check - $checkValue" . PHP_EOL;
        file_put_contents(__DIR__ . '/logs/bot-analytics.log', $logData, FILE_APPEND);

        // Optional: Send an email notification (if required)
        // mail('admin@example.com', 'Bot Detected', $logData);

    } else {
        // If not a crawler, you can perform some other logic if needed
        echo "This request is not from a known bot.";
    }
}
