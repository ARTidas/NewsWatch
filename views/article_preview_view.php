<?php

	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class ArticlePreviewView extends ProjectAbstractView {

        /* ********************************************************
         * ********************************************************
         * ********************************************************/
        public function displayContent() {
			?>
                <h1><?php print($this->do->do->title); ?></h1>

                <p>
                    <strong>
                        <?php print($this->do->do->content); ?>
                    </strong>
                </p>

                <p>
                    <?php print($this->do->do->content_full); ?>
                </p>

                <h2>Hasonló cikkek a hazai médiában</h2>
                <!-- <?php print($this->do->do->news_article_id_list); ?> -->
                <?php
                    foreach ($this->do->do_list as $news_article_do) {
                        //var_dump($news_article_do);
                        ?>
                            <div class="news-box">
                                <p>Forrás: <?php print($news_article_do->source); ?></p>
                                <h3>
                                    <?php print($news_article_do->title); ?>
                                </h3>
                                <p>
                                    <?php print($news_article_do->content_full); ?>
                                </p>
                                <p>
                                    <a target="_blank" href="<?php print($news_article_do->url); ?>"><?php print($news_article_do->url); ?></a>
                                </p>
                            </div>
                        <?php
                    }
                ?>
            <?php
		}

    }

?>