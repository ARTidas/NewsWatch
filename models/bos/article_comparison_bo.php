<?php

    /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
    class ArticleComparisonBo extends AbstractBo {

		const STATUS__MANUALLY_APPROVED = 'ManuallyApproved';
		const STATUS__MANUALLY_DISOWNED = 'ManuallyDisowned';

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function getMostRelatedArticlesForNewsArticle($news_article_id) {
            $do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getMostRelatedArticlesForNewsArticle($news_article_id);
            
			if (empty($records)) {
				LogHelper::addWarning('There are no records of: ' . $this->actor_name);
			}
			else {
                LogHelper::addConfirmation('Records found: ' . count($records));
				foreach ($records as $record) {
					$do_list[] = $do_factory->get($this->actor_name, $record);
				}
			}
			
			return $do_list;
        }

    }

?>