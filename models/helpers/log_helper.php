<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class LogHelper {

        const MESSAGES  = "messages";
        const WARNINGS  = "warnings";
        const ERRORS    = "errors";

        public static $messages = [];
        public static $warnings = [];
        public static $errors   = [];

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function addMessage($input) {
            self::$messages[] = $input;
		}

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function getMessages() {
            return self::$messages;
		}

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function addWarning($input) {
            self::$warnings[] = $input;
		}

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function getWarnings() {
            return self::$warnings;
		}

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function addError($input) {
            self::$errors[] = $input;
		}

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function getErrors() {
            return self::$errors;
		}

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function getLogs() {
            return [
                self::MESSAGES  => self::getMessages(),
                self::WARNINGS  => self::getWarnings(),
                self::ERRORS    => self::getErrors()
            ];
		}

    }

?>