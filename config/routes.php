<?php
return function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\\Controllers\\NewsController@getList');
    $r->addRoute('POST', '/add', 'App\\Controllers\\NewsController@add');
    $r->addRoute('POST', '/update/{id:\d+}', 'App\\Controllers\\NewsController@update');
    $r->addRoute('GET', '/delete/{id:\d+}', 'App\\Controllers\\NewsController@delete');

    $r->addRoute('POST', '/comment/add', 'App\\Controllers\\CommentController@add');
    $r->addRoute('POST', '/comment/update/{id:\d+}', 'App\\Controllers\\CommentController@update');
    $r->addRoute('GET', '/comment/delete/{id:\d+}', 'App\\Controllers\\CommentController@delete');
};