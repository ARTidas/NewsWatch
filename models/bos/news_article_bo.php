<?php

    /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
    class NewsArticleBo extends AbstractBo {

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
		public function get($id) {
			$do_factory = new DoFactory();
			
			$record = $this->dao->get([$id])[0];
			
			if (empty($record)) {
				LogHelper::addWarning('There are no record of: ' . $this->actor_name . ', for id: #' . $do->id);
			}
			else {
				LogHelper::addConfirmation('Record found!');
				return $do = $do_factory->get($this->actor_name, $record);
			}
			
			return false;
		}


		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function setStatus(AbstractDo $do) {
			return ($this->dao)->updateStatus(
				$do->id,
				$do->status
			);
		}

		

    }

?>