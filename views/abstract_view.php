<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	abstract class AbstractView {

        public $do;

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        function __construct(ViewDo $do) {
			$this->do = $do;
		}

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayHTMLOpen() {
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

                    <link rel="stylesheet" href="css/index.css" type="text/css" />
                </head>
			<?php
		}

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayHeader() {
			?>
				<div class="head_container">
                    <h1>News watch</h1>
                </div>
			<?php
		}

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayMenu() {
			?>
				<div class="menu_container">
                    <nav>
                        <ul>
                            <li><a href="<?php print(IndexHelper::$url_root); ?>">Main</a></li>
                            <li><a href="<?php print(IndexHelper::$url_root); ?>/news/list">News</a></li>
                            <li><a href="<?php print(IndexHelper::$url_root); ?>/scripts/list">Scripts</a></li>
                            <li><a href="<?php print(IndexHelper::$url_root); ?>/databases/list">Databases</a></li>
                        </ul>
                    </nav>
                </div>
			<?php
		}

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayContent() {
			?>
				<div class="main_container">
                    <p>Main container</p>
                </div>
                <hr />
			<?php
		}

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayFooter() {
			?>
                <div class="footer_container">
                    <p>Footer container</p>
                </div>
                <hr />
            <?php
        }

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayLogs() {
			?>
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
			<?php
		}

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayHTMLClose() {
			?>
                </body>
                </html>
            <?php
        }

    }

?>