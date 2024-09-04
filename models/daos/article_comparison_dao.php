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
		
	}
?>
