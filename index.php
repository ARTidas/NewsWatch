<?php

    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', 1);

    require(dirname(__FILE__) . '/models/helpers/index_helper.php');
	
    IndexHelper::$project_name      = 'News Watch';
    //IndexHelper::$project_url_name  = StringHelper::getURLSafeString(IndexHelper::$project_name);
    IndexHelper::$project_url_name  = 'newswatch';
    IndexHelper::$file_root         = dirname(__FILE__);
	IndexHelper::$path              = $_SERVER['REQUEST_URI'];
	IndexHelper::$url_root          = 'https://pti.unithe.hu/' . IndexHelper::$project_url_name;
    
    require(dirname(__FILE__) . '/require.php');

    LogHelper::addMessage('REQUEST_URI: ' . IndexHelper::$path);

?>

<!doctype html>
<html lang="en-US">
<head>
    <title>News watch</title>

    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html" />
    <meta name="description" content="News watch" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="index.css" type="text/css" />
</head>
<body>

    <div class="head_container">
        <h1>News watch</h1>
    </div>

    <div class="menu_container">
        <nav>
            <ul>
                <li><a href="<?php print(IndexHelper::$url_root); ?>">Main</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Scripts</a></li>
                <li><a href="#">Databases</a></li>
            </ul>
        </nav>
    </div>

    <div class="main_container">
        <p>Main container</p>
    </div>
    <hr />

    <div class="footer_container">
        <p>Footer container</p>
    </div>
    <hr />


    <div class="log_container">
        <h2>Logs</h2>
        <div class="logs">
            <h3>Errors</h3>
            <div class="log_errors">
                <?php
                    foreach (LogHelper::getErrors() as $log) {
                        print('<p>' . $log . '</p><hr />');
                    }
                ?>
            </div>

            <h3>Warnings</h3>
            <div class="log_warnings">
                <?php
                    foreach (LogHelper::getWarnings() as $log) {
                        print('<p>' . $log . '</p><hr />');
                    }
                ?>
            </div>

            <h3>Messages</h3>
            <div class="log_messages">
                <?php
                    foreach (LogHelper::getMessages() as $log) {
                        print('<p>' . $log . '</p><hr />');
                    }
                ?>
            </div>
        </div>
    </div>
    

</body>
</html>