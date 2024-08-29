<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class StringHelper {

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public static function getURLSafeString($input) {
            // Trim whitespace
            $input = trim($input);
            
            // Convert to lowercase
            $input = strtolower($input);
            
            // Replace spaces and underscores with dashes
            $input = preg_replace('/[\s_]+/', '-', $input);
            
            // Remove non URL-safe characters (keep letters, numbers, and dashes)
            $input = preg_replace('/[^a-z0-9\-]/', '', $input);
            
            // Remove consecutive dashes
            $input = preg_replace('/-+/', '-', $input);
            
            // Trim dashes from the beginning and end
            $input = trim($input, '-');

			return $input;
		}

    }

?>