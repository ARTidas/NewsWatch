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
					ARTICLES.id 		            AS id,
					ARTICLES.url                    AS url,
					ARTICLES.title                  AS title,
					ARTICLES.content                AS content,
					ARTICLES.content_uploaded_at    AS content_uploaded_at,
					ARTICLES.content_full           AS content_full,
					ARTICLES.is_active 	            AS is_active,
					ARTICLES.created_at             AS created_at,
					ARTICLES.updated_at             AS updated_at,
					(
						SELECT
							GROUP_CONCAT(
								ARTICLE_COMPARISONS.news_article_id
								ORDER BY ARTICLE_COMPARISONS.cosine_similarity DESC
								LIMIT 5
							) AS news_article_id_list
						FROM
							news_watch.article_comparisons ARTICLE_COMPARISONS
						WHERE
							ARTICLE_COMPARISONS.uni_article_id = ARTICLES.id
					) AS news_article_id_list,
					(
						SELECT
							GROUP_CONCAT(
								ARTICLE_COMPARISONS.news_article_id
								ORDER BY ARTICLE_COMPARISONS.cosine_similarity DESC
								LIMIT 5
							) AS news_article_id_list
						FROM
							news_watch.article_comparisons ARTICLE_COMPARISONS
						WHERE
							ARTICLE_COMPARISONS.uni_article_id = ARTICLES.id AND
							ARTICLE_COMPARISONS.status = 'ManuallyApproved'
					) AS manual_news_article_id_list
				FROM
					news_watch.articles ARTICLES
				WHERE
					ARTICLES.is_active = 1
				ORDER BY
					ARTICLES.content_uploaded_at DESC
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
		public function getSearchResultList($search_string) {
            $query_string = "
                SELECT
                    MAIN.id                      AS id,
                    MAIN.url                     AS url,
                    MAIN.title                   AS title,
                    MAIN.content                 AS content,
                    MAIN.content_uploaded_at     AS content_uploaded_at,
                    MAIN.content_full            AS content_full,
                    MAIN.is_active               AS is_active,
                    MAIN.created_at              AS created_at,
                    MAIN.updated_at              AS updated_at
                FROM
                    news_watch.articles MAIN
                WHERE
                    MAIN.is_active = 1 AND (
                        MAIN.title LIKE :search_string OR
                        MAIN.content LIKE :search_string OR
                        MAIN.content_full LIKE :search_string
                    )
                ORDER BY
                    MAIN.content_uploaded_at DESC
            ";
        
            try {
                $handler = $this->database_connection_bo->getConnection();
                $statement = $handler->prepare($query_string);
                $search_term = '%' . $search_string . '%';
                $statement->bindValue(':search_string', $search_term, PDO::PARAM_STR);
                $statement->execute();
        
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $exception) {
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
					ARTICLES.id AS id,
					ARTICLES.url AS url,
					ARTICLES.title AS title,
					ARTICLES.content AS content,
					ARTICLES.content_uploaded_at AS content_uploaded_at,
					ARTICLES.content_full AS content_full,
					ARTICLES.is_active AS is_active,
					ARTICLES.created_at AS created_at,
					ARTICLES.updated_at AS updated_at,
					(
						SELECT
							GROUP_CONCAT(
								ARTICLE_COMPARISONS.news_article_id
								ORDER BY ARTICLE_COMPARISONS.cosine_similarity DESC
								LIMIT 5
							) AS news_article_id_list
						FROM
							news_watch.article_comparisons ARTICLE_COMPARISONS
						WHERE
							ARTICLE_COMPARISONS.uni_article_id = ARTICLES.id
					) AS news_article_id_list
				FROM
					news_watch.articles ARTICLES
				WHERE
					ARTICLES.id = ?
				ORDER BY
					ARTICLES.content_uploaded_at DESC
				;
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
