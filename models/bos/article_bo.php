<?php

    /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
    class ArticleBo extends AbstractBo {

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