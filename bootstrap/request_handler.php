<?php
$routes = require_once(__DIR__ . '/../config/routes.php');

$dispatcher = FastRoute\simpleDispatcher($routes);

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        display_page('handlers/error404');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $vars = sanitize($vars);
        $vars[] = new \App\Request();

        list($class, $method) = explode("@", $handler, 2);

//        try {
            call_user_func_array(array(new $class, $method), $vars);
//        } catch (\Exception $e) {
//            display_page('handlers/error500');
//        }
        break;
    default:
        display_page('handlers/error500');
        break;
}