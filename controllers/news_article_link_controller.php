<?php

    //TODO: Create a user permission group after project review
    /*if (
        //!PermissionHelper::isUserAuthorized('Demonstrator') &&
        !PermissionHelper::isUserAuthorized('Map administrator')
    ) {
        header('Location: ' . RequestHelper::$url_root . '/user_permission/request');
        exit();
    }*/

    

    $view = null;

    if (isset(RequestHelper::$actor_id)) {

        if (isset($_POST['affiliate']) && $_POST['affiliate'] === 'Affiliate') {
            if (!PermissionHelper::isUserAuthorized('NewsWatch administrator')) {
                header('Location: ' . RequestHelper::$common_url_root . '/user_permission/request');
                exit();
            }

            $do = new (ActorHelper::ARTICLE_COMPARISON . 'Do');
            $do->id     = $_POST['id'];
            $do->status = ArticleComparisonBo::STATUS__MANUALLY_APPROVED;

            $bo->setStatus($do);
        }
        else if (isset($_POST['affiliate']) && $_POST['affiliate'] === 'Disown') { //TODO: Refact this into leaner code...
            if (!PermissionHelper::isUserAuthorized('NewsWatch administrator')) {
                header('Location: ' . RequestHelper::$common_url_root . '/user_permission/request');
                exit();
            }

            $do = new (ActorHelper::ARTICLE_COMPARISON . 'Do');
            $do->id     = $_POST['id'];
            $do->status = ArticleComparisonBo::STATUS__MANUALLY_DISOWNED;

            $bo->setStatus($do);
        }

        $do = $bo->get(RequestHelper::$actor_id);

        $article_comparison_list = $bo_factory->get(
            ActorHelper::ARTICLE_COMPARISON
        )->getMostRelatedArticlesForNewsArticle(RequestHelper::$actor_id);

        $view = new (RequestHelper::$actor_class_name . ucfirst(RequestHelper::$actor_action) . 'ActorView')(
            new ViewDo(
                RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
                'DESCRIPTION - ' . RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
                null, #$do_list,
                $do, #do
                null, #search string
                [
                    'article_comparison_list' => $article_comparison_list
                ] #json_data
            ),
        );


    }
    else {

        if (isset($_POST['remove']) && $_POST['remove'] === 'Remove') {
            if (!PermissionHelper::isUserAuthorized('NewsWatch administrator')) {
                header('Location: ' . RequestHelper::$common_url_root . '/user_permission/request');
                exit();
            }

            $do = new (RequestHelper::$actor_class_name . 'Do');
            $do->id = $_POST['id'];

            $bo->delete($do);
        }

        $do_list = $bo->getList();

        $view = new (RequestHelper::$actor_class_name . ucfirst(RequestHelper::$actor_action) . 'View')(
            new ViewDo(
                RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
                'DESCRIPTION - ' . RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
                $do_list,
                null, #do
                null #search string
            ),
        );
    }

    $view->displayHTMLOpen();
    $view->displayHeader();
    $view->displayMenu();
    $view->displayContent();
    $view->displayFooter();
    $view->displayLogs();
    $view->displayHTMLClose();

?>