<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class ArticleDao extends AbstractDao {

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					news_watch.articles
				SET
                    url                     = ?,
					title 				   	= ?,
                    content                 = ?,
                    content_date            = ?,
                    content_full            = ?,
					is_active 				= 1,
					created_at				= NOW(),
					updated_at 				= NOW()
			";

			try {
				$database_connection = ($this->database_connection_bo)->getConnection();

				$database_connection
					->prepare($query_string)
					->execute(
						(
							array_map(
								function($value) {
									return $value === '' ? NULL : $value;
								},
								$parameters
							)
						)
					)
				;

				return(
					$database_connection->lastInsertId()
				);
			}
			catch(Exception $exception) {
				LogHelper::addError('ERROR: ' . $exception->getMessage());

				return false;
			}
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function update(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					news_watch.articles
				SET
					url                     = ?,
					title 				   	= ?,
                    content                 = ?,
                    content_date            = ?,
                    content_full            = ?,
					is_active 				= ?,
					updated_at 				= NOW()
				WHERE
					id 						= ?
			";

			try {
				return(
					($this->database_connection_bo)->getConnection()
						->prepare($query_string)
						->execute(
							(
								array_map(
									function($value) {
										return $value === '' ? NULL : $value;
									},
									$parameters
								)
							)
						)
				);
			}
			catch(Exception $exception) {
				LogHelper::addError('ERROR: ' . $exception->getMessage());

				return false;
			}
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getList() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
                    MAIN.id 		            AS id,
                    MAIN.url                    AS url,
                    MAIN.title                  AS title,
                    MAIN.content                AS content,
                    MAIN.content_uploaded_at    AS content_uploaded_at,
                    MAIN.content_full           AS content_full,
                    MAIN.is_active 	            AS is_active,
                    MAIN.created_at             AS created_at,
                    MAIN.updated_at             AS updated_at
				FROM
					news_watch.articles MAIN
				WHERE
					MAIN.is_active = 1
                ORDER BY
                    MAIN.content_uploaded_at DESC
			";

			try {
				$handler = ($this->database_connection_bo)->getConnection();
				$statement = $handler->prepare($query_string);
				$statement->execute();
				
				return $statement->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(Exception $exception) {
				LogHelper::addError('Error: ' . $exception->getMessage());

				return false;
			}
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function get(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.id 		            AS id,
                    MAIN.url                    AS url,
                    MAIN.title                  AS title,
                    MAIN.content                AS content,
                    MAIN.content_uploaded_at    AS content_uploaded_at,
                    MAIN.content_full           AS content_full,
                    MAIN.is_active 	            AS is_active,
                    MAIN.created_at             AS created_at,
                    MAIN.updated_at             AS updated_at
				FROM
					news_watch.articles MAIN
				WHERE
					MAIN.id = ?
			";

			try {
				$handler = ($this->database_connection_bo)->getConnection();
				$statement = $handler->prepare($query_string);
				$statement->execute(
					array_map(
						function($value) {
							return $value === '' ? NULL : $value;
						},
						$parameters
					)
				);
				
				return $statement->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(Exception $exception) {
				LogHelper::addError('Error: ' . $exception->getMessage());

				return false;
			}
		}
		
	}
?>
