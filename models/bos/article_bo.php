<?php

    /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
    class ArticleBo extends AbstractBo {

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getSearchResultList($search_string) {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getSearchResultList($search_string);
			
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

        /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function get(AbstractDo $do) {
			$do_factory = new DoFactory();
			
			$records = $this->dao->get([$do->id]);
			if (isset($records[0])) {
				$record = $records[0];
			}

			if (empty($record)) {
				LogHelper::addWarning('Could not find record for: ' . $this->actor_name);
			}
			else {
				return $do_factory->get($this->actor_name, $record);
			}
			
			return $do;
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getNewsArticleDoList(AbstractDo $do) {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = (new NewsArticleDao)->getSearchResultListByCommaSeparatedIDs($do->news_article_id_list);
			
			if (empty($records)) {
				//LogHelper::addWarning('There are no records of: ' . $this->actor_name);
				LogHelper::addWarning('There are no records of: NewsArticles');
			}
			else {
                LogHelper::addConfirmation('Records found: ' . count($records));
				foreach ($records as $record) {
					//$do_list[] = $do_factory->get($this->actor_name, $record);
					$do_list[] = $do_factory->get('NewsArticle', $record);
				}
			}
			
			return $do_list;
		}

		

    }

?>