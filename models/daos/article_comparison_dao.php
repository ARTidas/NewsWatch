<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class ArticleComparisonDao extends AbstractDao {

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getList() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
                    COMPARISONS.id 		               AS id,
                    UNITHE_ARTICLES.id                 AS uni_article_id,
                    NEWS_ARTICLES.id                   AS news_article_id,
                    UNITHE_ARTICLES.url                AS uni_article_url,
                    NEWS_ARTICLES.url                  AS news_article_url,
                    COMPARISONS.cosine_similarity      AS cosine_similarity,
                    COMPARISONS.is_active 	           AS is_active,
                    COMPARISONS.created_at             AS created_at,
                    COMPARISONS.updated_at             AS updated_at
                FROM
                    news_watch.article_comparisons COMPARISONS
                    INNER JOIN news_watch.articles UNITHE_ARTICLES
                        ON COMPARISONS.uni_article_id = UNITHE_ARTICLES.id
                    INNER JOIN news_watch.news_articles NEWS_ARTICLES
                        ON COMPARISONS.news_article_id = NEWS_ARTICLES.id
                WHERE
                    COMPARISONS.is_active = 1
                ORDER BY
                    COMPARISONS.cosine_similarity DESC
				LIMIT 2000
                ;
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
		public function getMostRelatedArticlesForNewsArticle(int $news_article_id) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
                    COMPARISONS.id 		               	AS id,
                    UNITHE_ARTICLES.id                 	AS uni_article_id,
                    NEWS_ARTICLES.id                   	AS news_article_id,
                    UNITHE_ARTICLES.url                	AS uni_article_url,
					UNITHE_ARTICLES.title              	AS uni_article_title,
					UNITHE_ARTICLES.content            	AS uni_article_content,
					UNITHE_ARTICLES.content_uploaded_at	AS uni_article_content_uploaded_at,
                    NEWS_ARTICLES.url                  	AS news_article_url,
                    COMPARISONS.cosine_similarity      	AS cosine_similarity,
                    COMPARISONS.status      	        AS status,
                    COMPARISONS.is_active 	           	AS is_active,
                    COMPARISONS.created_at             	AS created_at,
                    COMPARISONS.updated_at             	AS updated_at
                FROM
                    news_watch.article_comparisons COMPARISONS
                    INNER JOIN news_watch.articles UNITHE_ARTICLES
                        ON COMPARISONS.uni_article_id = UNITHE_ARTICLES.id
                    INNER JOIN news_watch.news_articles NEWS_ARTICLES
                        ON COMPARISONS.news_article_id = NEWS_ARTICLES.id
                WHERE
                    COMPARISONS.is_active = 1 AND
					NEWS_ARTICLES.id = :news_article_id
                ORDER BY
                    COMPARISONS.status DESC,
                    COMPARISONS.cosine_similarity DESC
				-- LIMIT 300
                ;
			";

			try {
				$handler = $this->database_connection_bo->getConnection();
                $statement = $handler->prepare($query_string);
                $statement->bindValue(':news_article_id', $news_article_id, PDO::PARAM_INT);
                $statement->execute();
        
                return $statement->fetchAll(PDO::FETCH_ASSOC);
			}
			catch(Exception $exception) {
				LogHelper::addError('Error: ' . $exception->getMessage());

				return false;
			}
		}

		
	}
?>
