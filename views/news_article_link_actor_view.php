<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class NewsArticleLinkActorView extends ProjectAbstractView {

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayContent() {
			?>
				<hr/>

                <h1>
					<?php print($this->do->do->title); ?>
				</h1>

				<hr/>

				<p>
					<strong>
						Content found at: <?php print($this->do->do->content_uploaded_at); ?>
					</strong> |
						Record created at: <?php print(substr($this->do->do->created_at, 0, 10)); ?> |
						Record updated at: <?php print(substr($this->do->do->updated_at, 0, 10)); ?>
					
				</p>

				<hr/>

				<p>
					<a href="<?php print($this->do->do->url); ?>" target="_blank" class="large_link">
						View original source... (<?php print($this->do->do->source); ?>)
					</a>
				</p>

				<hr/>

				<p>
					<strong>
						<?php print($this->do->do->content); ?>
					</strong>
				</p>

				<hr/>

				<p>
					<?php print($this->do->do->content_full); ?>
				</p>

				<hr/>

				<h2>Suggestions for most related news</h2>

				<table>
                    <thead>
                        <tr>
                            <?php
                                foreach ((new (ActorHelper::ARTICLE_COMPARISON . 'Do'))->getAttributes() as $key => $value) {
                                    if (ActorHelper::isAttributeRequiredForArticleLinkSugestion($key)) {
                                        print('<th>' . $key . '</th>');
                                    }
                                }
                            ?>
							<th>
								Action
							</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($this->do->json_data['article_comparison_list'] as $do) {
								if ($do->status === ArticleComparisonBo::STATUS__MANUALLY_APPROVED) {
									print('<tr class="highlight">');
								}
								else {
									print('<tr>');
								}
                                
                                    foreach ($do->getAttributes() as $key => $value) {
                                        if (ActorHelper::isAttributeRequiredForArticleLinkSugestion($key)) {
                                            if ($key === 'uni_article_url') {
                                                print('<td><a href="' . $value . '" target="_blank">' . $value . '</a></td>');
                                            }
                                            else {
                                                print('<td>' . $value . '</td>');
                                            }
                                        }
                                    }

									if ($do->status === ArticleComparisonBo::STATUS__MANUALLY_APPROVED) {
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
														name="affiliate"
														value="Disown"/>
												</form>
											</td>
										<?php
									}
									else {
										?>
											<td>
												<form action="" method="post">
													<input
														type="hidden"
														name="id"
														value="<?php print($do->id); ?>"/>
													<input
														type="submit"
														name="affiliate"
														value="Affiliate"/>
												</form>
											</td>
										<?php
									}
                                print('</tr>');
                            }
                        ?>
                    </tbody>
                </table>

				<hr/>


			<?php
		}

    }

?>