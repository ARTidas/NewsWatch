<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class ArticleListView extends ProjectAbstractView {

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
                                    if (
                                        ActorHelper::isAttributeRequiredForArticleList($key) &&
                                        $key !== 'content'
                                    ) {
                                        print('<th>' . $key . '</th>');
                                    }
                                }
                            ?>
                            <th>Preview</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($this->do->do_list as $do) {
                                print('<tr>');
                                    foreach ($do->getAttributes() as $key => $value) {
                                        if (
                                            ActorHelper::isAttributeRequiredForArticleList($key) &&
                                            $key !== 'content'
                                        ) {
                                            if ($key === 'url') {
                                                print('<td><a href="' . $value . '" target="_blank">' . $value . '</a></td>');
                                            }
                                            else {
                                                print('<td>' . $value . '</td>');
                                            }
                                        }
                                    }
                                    print('<td>');
                                        print('<a href="' . RequestHelper::$url_root . '/article/preview/' . $do->id . '">link...</a>');
                                    print('</td>');
                                print('</tr>');
                            }
                        ?>
                    </tbody>
                </table>
			<?php
		}

    }

?>