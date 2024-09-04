<?php

    $do = $do_factory->get(RequestHelper::$actor_class_name, ['id' => RequestHelper::$actor_id]);
    $do = $bo->get($do);

    $news_article_do_list = $bo->getNewsArticleDoList($do);

    $view = new (RequestHelper::$actor_class_name . 'PreviewView')(
        new ViewDo(
            RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
            'DESCRIPTION - ' . RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
            $news_article_do_list,
            $do
        ),
    );

    $view->displayHTMLOpen();
    $view->displayHeader();
    $view->displayMenu();
    $view->displayContent();
    $view->displayFooter();
    $view->displayLogs();
    $view->displayHTMLClose();



?>