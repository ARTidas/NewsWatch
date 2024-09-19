<?php

    /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
    class ArticleComparisonDo extends AbstractDo {

        public $uni_article_id;
        public $news_article_id;
        public $uni_article_url;
        public $news_article_url;
        public $cosine_similarity;
        public $status;

        public $uni_article_title;
        public $uni_article_content;
        public $uni_article_content_uploaded_at;

        public $manual_article_id_list;

    }

?>