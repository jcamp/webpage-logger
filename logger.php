<?php
$ip = $_SERVER['REMOTE_ADDR'];
$url = isset($_GET['url']) ? $_GET['url'] : '';
$date = date('Y-m-d');
$time = date('H:i:s');

$logFile = fopen('../log.csv', 'a');
fputcsv($logFile, array($date, $time, $url, $ip));
fclose($logFile);
?>