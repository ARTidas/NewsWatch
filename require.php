<?php

    /* ********************************************************
	 * *** Models *********************************************
	 * ********************************************************/

        /* ********************************************************
         * *** Business Objects ***********************************
         * ********************************************************/
        require(RequestHelper::$common_file_root . '/models/bos/mariadb_database_connection_bo.php');
        require(RequestHelper::$common_file_root . '/models/bos/abstract_bo.php');
        require(RequestHelper::$common_file_root . '/models/bos/security_bo.php');
        require(RequestHelper::$common_file_root . '/models/bos/user_bo.php');
        require(RequestHelper::$common_file_root . '/models/bos/permission_bo.php');
        require(RequestHelper::$file_root . '/models/bos/article_bo.php');
        require(RequestHelper::$file_root . '/models/bos/news_article_bo.php');
        require(RequestHelper::$file_root . '/models/bos/article_comparison_bo.php');

        /* ********************************************************
         * *** Data Access Objects ********************************
         * ********************************************************/
        require(RequestHelper::$common_file_root . '/models/daos/abstract_dao.php');
        require(RequestHelper::$common_file_root . '/models/daos/user_dao.php');
        require(RequestHelper::$common_file_root . '/models/daos/permission_dao.php');
        require(RequestHelper::$file_root . '/models/daos/article_dao.php');
        require(RequestHelper::$file_root . '/models/daos/news_article_dao.php');
        require(RequestHelper::$file_root . '/models/daos/article_comparison_dao.php');

        /* ********************************************************
         * *** Data Objects ***************************************
         * ********************************************************/
        require(RequestHelper::$common_file_root . '/models/dos/view_do.php');
        require(RequestHelper::$common_file_root . '/models/dos/abstract_do.php');
        require(RequestHelper::$common_file_root . '/models/dos/user_do.php');
        require(RequestHelper::$common_file_root . '/models/dos/permission_do.php');
        require(RequestHelper::$file_root . '/models/dos/article_do.php');
        require(RequestHelper::$file_root . '/models/dos/news_article_do.php');
        require(RequestHelper::$file_root . '/models/dos/article_comparison_do.php');

        /* ********************************************************
         * *** Helpers ********************************************
         * ********************************************************/
        require(RequestHelper::$common_file_root . '/models/helpers/log_helper.php');
        require(RequestHelper::$common_file_root . '/models/helpers/actor_helper.php');
        require(RequestHelper::$common_file_root . '/models/helpers/string_helper.php');
        require(RequestHelper::$common_file_root . '/models/helpers/permission_helper.php');

        /* ********************************************************
         * *** Factories ******************************************
         * ********************************************************/
        require(RequestHelper::$common_file_root . '/models/factories/bo_factory.php');
        require(RequestHelper::$common_file_root . '/models/factories/dao_factory.php');
        require(RequestHelper::$common_file_root . '/models/factories/do_factory.php');


    /* ********************************************************
	 * *** Views **********************************************
	 * ********************************************************/
    require(RequestHelper::$common_file_root . '/views/abstract_view.php');
    require(RequestHelper::$file_root . '/views/project_abstract_view.php');
    require(RequestHelper::$file_root . '/views/index_view.php');
    require(RequestHelper::$file_root . '/views/article_list_view.php');
    require(RequestHelper::$file_root . '/views/article_search_view.php');
    require(RequestHelper::$file_root . '/views/article_preview_view.php');
    require(RequestHelper::$file_root . '/views/news_article_list_view.php');
    require(RequestHelper::$file_root . '/views/news_article_link_view.php');
    require(RequestHelper::$file_root . '/views/news_article_link_actor_view.php');
    require(RequestHelper::$file_root . '/views/news_article_search_view.php');
    require(RequestHelper::$file_root . '/views/article_comparison_list_view.php');

?>