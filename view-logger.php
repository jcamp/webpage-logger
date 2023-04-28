<?php
    $logFile = fopen('../log.csv', 'r');
    while (($logEntry = fgetcsv($logFile)) !== false) {
        echo implode(',', $logEntry) . '<br>';
    }
    fclose($logFile);
?>