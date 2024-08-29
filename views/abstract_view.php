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
        public function getHeader() {
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

    }

?>