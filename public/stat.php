<?php
// stat.php
require_once __DIR__ . '/../libs/BotAnalytics.php';
require_once __DIR__ . '/../config/logger.php';

// ใช้ CrawlerDetect เพื่อตรวจสอบว่าเป็นบอทหรือไม่
$crawlerDetect = new CrawlerDetect();

// ข้อมูลจาก User-Agent และ URL parameters
$sUserAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
$ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
$domainName = filter_var($_SERVER['HTTP_HOST'], FILTER_SANITIZE_URL);
$fullPath = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
$checkValue = isset($_GET['look']) ? '1' : '0';

if ($crawlerDetect->isCrawler($sUserAgent)) {
    // ถ้าเป็นบอท ให้บันทึกลงฐานข้อมูล
    saveBotData($ip, $sUserAgent, $domainName, $fullPath, $checkValue);
    logMessage("Bot detected: $sUserAgent on $domainName$fullPath");
    
    // ส่งแจ้งเตือนทางอีเมลถ้าจำเป็น
    mail($config['admin_email'], 'Bot Detected', "Bot: $sUserAgent\nIP: $ip\nPath: $fullPath");

    // ป้องกันการแสดงข้อมูลต่อบอท
    http_response_code(403);
    echo "Access Denied";
} else {
    // ไม่ใช่บอท, ดำเนินการอื่น ๆ ต่อ
    logMessage("Non-bot visit from IP: $ip");
}
