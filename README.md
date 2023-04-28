# webpage-logger
Log basic details of a visitor to a website

A **website logger** that logs every visit to a webpage, including the date, time, webpage URL, and IP address of the visitor. Useful for errors and capturing statistics.
 
## Logger - log web page activity to a log file (csv file) on the server

1. Create a PHP file called "logger.php" on your server. This file will handle the logging process.

2. In `logger.php`, use the following code to retrieve the necessary information about the visitor:

```
$ip = $_SERVER['REMOTE_ADDR'];
$url = isset($_GET['url']) ? $_GET['url'] : '';
$date = date('Y-m-d');
$time = date('H:i:s');

$logFile = fopen('../log.csv', 'a');
fputcsv($logFile, array($date, $time, $url, $ip));
fclose($logFile);
```

This will get the URL of the current page and add to the calling parameter to log the web url being accessed at the time.

Web page (whereever you want to have a page logged to the file):

Add to just before the </body> of the webpage

```
<script>
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "logger.php?url=" + window.location.href, true);
    xhttp.send();
</script>
```

To view the log file (`view-logger.php`):

```
<?php
    $logFile = fopen('../log.csv', 'r');
    while (($logEntry = fgetcsv($logFile)) !== false) {
        echo implode(',', $logEntry) . '<br>';
    }
    fclose($logFile);
?>
```

**Security**

Limit the access to logger.php: You can restrict access to logger.php by adding authentication or authorization checks. For example, you can only allow requests from specific IP addresses or users with valid credentials.

Validate input data: Always validate any data received from the user before writing it to the log file. Use PHP's built-in input validation functions to sanitize any user input, preventing attacks like SQL injection.

Protect the log file: Make sure the log file is stored in a secure location on the server, and prevent any unauthorized access to it. You can set appropriate permissions for the log file, so that only authorized users can read and write to it.

Encrypt the log file: To further secure the log file, you can encrypt it using a strong encryption algorithm. This ensures that even if the log file is accessed, the data is unreadable without the encryption key.

Use HTTPS: Ensure that your website uses HTTPS to encrypt all communication between the user's browser and your server. This prevents any man-in-the-middle attacks, where an attacker could intercept the communication and obtain sensitive information.

By implementing these security measures, you can ensure that your website logger is secure and cannot be exploited by attackers.
