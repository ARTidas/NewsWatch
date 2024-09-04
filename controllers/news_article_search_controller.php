<?php

    $search_string  = null;
    $do_list        = null;

    if (isset($_POST['search']) && $_POST['search'] === 'Search') {
        $search_string = $_POST['search_string'];
        $do_list = $bo->getSearchResultList($search_string);
    }
    else {
        $do_list = $bo->getList();
    }

    $view = new (RequestHelper::$actor_class_name . 'SearchView')(
        new ViewDo(
            RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
            'DESCRIPTION - ' . RequestHelper::$project_name . ' > ' . RequestHelper::$actor_name . ' > ' . RequestHelper::$actor_action,
            $do_list,
            null, #do
            $search_string
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