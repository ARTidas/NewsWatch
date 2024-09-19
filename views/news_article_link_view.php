<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class NewsArticleLinkView extends ProjectAbstractView {

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
                                    if (ActorHelper::isAttributeRequiredForArticleLink($key)) {
                                        print('<th>' . $key . '</th>');
                                    }
                                }
                            ?>
                            <th>
                                Delete
                            </th>
                            <th>
                                Affiliate
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($this->do->do_list as $do) {
                                print('<tr>');
                                    foreach ($do->getAttributes() as $key => $value) {
                                        if (ActorHelper::isAttributeRequiredForArticleLink($key)) {
                                            if ($key === 'url') {
                                                print('<td><a href="' . $value . '" target="_blank">' . 'link...' . '</a></td>');
                                            }
                                            else {
                                                print('<td>' . $value . '</td>');
                                            }
                                        }
                                    }
                                    ?>
                                        <td>
                                            <form action="" method="post">
                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?php print($do->id); ?>"/>
                                                <input
                                                    type="submit"
                                                    class="delete"
                                                    name="remove"
                                                    value="Remove"/>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="<?php print(
                                                RequestHelper::$url_root . '/' . 
                                                RequestHelper::$actor_name . '/' .
                                                RequestHelper::$actor_action . '/' . 
                                                $do->id
                                            ); ?>">
                                                Affiliate
                                            </a>
                                        </td>
                                    <?php
                                print('</tr>');
                            }
                        ?>
                    </tbody>
                </table>
			<?php
		}

    }

?>