<?php

    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', 1);

    require(dirname(__FILE__) . '/models/helpers/index_helper.php');
	
    IndexHelper::$project_name      = 'News Watch';
    IndexHelper::$project_url_name  = 'newswatch'; //StringHelper::getURLSafeString(IndexHelper::$project_name);
    IndexHelper::$file_root         = dirname(__FILE__);
	IndexHelper::$path              = $_SERVER['REQUEST_URI'];
	IndexHelper::$url_root          = 'https://pti.unithe.hu/' . IndexHelper::$project_url_name;
    
    require(dirname(__FILE__) . '/require.php');

    LogHelper::addMessage('REQUEST_URI: ' . IndexHelper::$path);

    /* ********************************************************
	 * *** Here is the main controlling logic... **************
	 * ********************************************************/
	IndexHelper::$request = explode('/', IndexHelper::$path);
    IndexHelper::$project_name = IndexHelper::$request[1];
    IndexHelper::$actor_name   = empty(IndexHelper::$request[2]) ? 'index' : IndexHelper::$request[2];
    IndexHelper::$actor_action = isset(IndexHelper::$request[3]) ? IndexHelper::$request[3] : 'list';
    LogHelper::addMessage('project_name: ' . IndexHelper::$project_name);
    LogHelper::addMessage('actor_name: ' . IndexHelper::$actor_name);
    LogHelper::addMessage('actor_action: ' . IndexHelper::$actor_action);

    /* ********************************************************
	 * *** Lets require files by request... *******************
	 * ********************************************************/
	//$do_factory = new DoFactory(); //TODO: Implement
	//$bo_factory = new BoFactory(); //TODO: Implement
	require(
        IndexHelper::$file_root . '/controllers/' . 
        IndexHelper::$actor_name . '_controller.php'
    );

?>