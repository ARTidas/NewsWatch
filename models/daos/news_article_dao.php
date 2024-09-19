<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class NewsArticleDao extends AbstractDao {

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					news_watch.news_articles
				SET
                    source                  = ?,
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
					news_watch.news_articles
				SET
                    source                  = ?,
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
					NEWS_ARTICLES.id AS id,
					NEWS_ARTICLES.source AS source,
					NEWS_ARTICLES.url AS url,
					NEWS_ARTICLES.title AS title,
					NEWS_ARTICLES.content AS content,
					NEWS_ARTICLES.content_uploaded_at AS content_uploaded_at,
					NEWS_ARTICLES.content_full AS content_full,
					NEWS_ARTICLES.is_active AS is_active,
					NEWS_ARTICLES.created_at AS created_at,
					NEWS_ARTICLES.updated_at AS updated_at,
					MANUAL_ARTICLE_COMPARISONS.manual_article_id_list
				FROM
					news_watch.news_articles NEWS_ARTICLES
				LEFT JOIN (
					SELECT
						ARTICLE_COMPARISONS.news_article_id,
						GROUP_CONCAT(
							ARTICLE_COMPARISONS.uni_article_id
							ORDER BY ARTICLE_COMPARISONS.cosine_similarity DESC
							LIMIT 5
						) AS manual_article_id_list
					FROM
						news_watch.article_comparisons ARTICLE_COMPARISONS
					WHERE
						ARTICLE_COMPARISONS.status = 'ManuallyApproved'
					GROUP BY
						ARTICLE_COMPARISONS.news_article_id
				) MANUAL_ARTICLE_COMPARISONS
				ON MANUAL_ARTICLE_COMPARISONS.news_article_id = NEWS_ARTICLES.id
				WHERE
					NEWS_ARTICLES.is_active = 1
				ORDER BY
					IFNULL(NEWS_ARTICLES.content_uploaded_at, NEWS_ARTICLES.created_at) DESC;
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
                    MAIN.source 		         AS source,
                    MAIN.url                     AS url,
                    MAIN.title                   AS title,
                    MAIN.content                 AS content,
                    MAIN.content_uploaded_at     AS content_uploaded_at,
                    MAIN.content_full            AS content_full,
                    MAIN.is_active               AS is_active,
                    MAIN.created_at              AS created_at,
                    MAIN.updated_at              AS updated_at
                FROM
                    news_watch.news_articles MAIN
                WHERE
                    MAIN.is_active = 1 AND (
                        MAIN.title LIKE :search_string OR
                        MAIN.content LIKE :search_string OR
                        MAIN.content_full LIKE :search_string
                    )
                ORDER BY
                    -- MAIN.content_uploaded_at DESC
					MAIN.updated_at DESC
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
					MAIN.id 		            AS id,
                    MAIN.source 		        AS source,
                    MAIN.url                    AS url,
                    MAIN.title                  AS title,
                    MAIN.content                AS content,
                    MAIN.content_uploaded_at    AS content_uploaded_at,
                    MAIN.content_full           AS content_full,
                    MAIN.is_active 	            AS is_active,
                    MAIN.created_at             AS created_at,
                    MAIN.updated_at             AS updated_at
				FROM
					news_watch.news_articles MAIN
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

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getSearchResultListByCommaSeparatedIDs($id_list) {
			// Split the comma-separated string into an array
			$ids = explode(',', $id_list);

			// Create placeholders for each ID in the array
			$placeholders = implode(',', array_fill(0, count($ids), '?'));
			
            $query_string = "
                SELECT
                    MAIN.id                      AS id,
                    MAIN.source 		         AS source,
                    MAIN.url                     AS url,
                    MAIN.title                   AS title,
                    MAIN.content                 AS content,
                    MAIN.content_uploaded_at     AS content_uploaded_at,
                    MAIN.content_full            AS content_full,
                    MAIN.is_active               AS is_active,
                    MAIN.created_at              AS created_at,
                    MAIN.updated_at              AS updated_at
                FROM
                    news_watch.news_articles MAIN
                WHERE
                    MAIN.id IN ($placeholders)
                ORDER BY
                    MAIN.content_uploaded_at DESC
            ";
        
            try {
                $handler = $this->database_connection_bo->getConnection();
				$statement = $handler->prepare($query_string);
				
				// Bind each ID separately
				foreach ($ids as $index => $id) {
					$statement->bindValue($index + 1, trim($id), PDO::PARAM_INT);
				}

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
		public function delete(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					news_watch.news_articles
				SET
					is_active 				= 0,
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
		public function updateStatus($id, $status) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					news_watch.article_comparisons
				SET
					status 				= :status,
					updated_at 			= NOW()
				WHERE
					id 					= :id
			";

			try {
                $handler = $this->database_connection_bo->getConnection();
                $statement = $handler->prepare($query_string);
                $statement->bindValue(':status', $status, PDO::PARAM_STR);
				$statement->bindValue(':id', $id, PDO::PARAM_INT);
                $statement->execute();
        
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $exception) {
                LogHelper::addError('Error: ' . $exception->getMessage());
        
                return false;
            }
		}

		
	}
?>
