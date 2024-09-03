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
		public function create(AbstractDo $do) {
            $this->validateDo($do);

            if (!$this->isDoValid($do)) {
                return false;
            }

			return ($this->dao)->create(
				[
                    $do->url,
					$do->title,
                    $do->content
				]
			);
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function update(AbstractDo $do) {
            $this->validateDo($do);

            if (!$this->isDoValid($do)) {
                return false;
            }

			return ($this->dao)->update(
				[
					$do->url,
					$do->title,
                    $do->content
				]
			);
		}

    }

?>