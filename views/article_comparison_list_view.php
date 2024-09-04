<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class ArticleComparisonListView extends ProjectAbstractView {

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayContent() {
			?>
                <h1><?php print(RequestHelper::$actor_class_name); ?> list</h1>

				<table>
                    <thead>
                        <tr>
                            <?php
                                foreach ((new (RequestHelper::$actor_class_name . 'Do'))->getAttributes() as $key => $value) {
                                    if (ActorHelper::isAttributeRequiredForArticleList($key)) {
                                        print('<th>' . $key . '</th>');
                                    }
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($this->do->do_list as $do) {
                                print('<tr>');
                                    foreach ($do->getAttributes() as $key => $value) {
                                        if (ActorHelper::isAttributeRequiredForArticleList($key)) {
                                            if (
                                                $key === 'uni_article_url' ||
                                                $key === 'news_article_url'
                                            ) {
                                                print('<td><a href="' . $value . '" target="_blank">' . $value . '</a></td>');
                                            }
                                            else {
                                                print('<td>' . $value . '</td>');
                                            }
                                        }
                                    }
                                print('</tr>');
                            }
                        ?>
                    </tbody>
                </table>
			<?php
		}

    }

?>