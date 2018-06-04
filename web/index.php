<?php
require "../autoload.php";
session_start();

use Lib\Route;
use Lib\Request;

$uri = $_GET["uri"] ?? '';

/*
* add any new routes below using add($uri, $controller, $action, $view)
*/
//////////////////////////
$route = new Route($uri);
$route->add("/", "index", "index");
$route->add("/login", "login", "index");
$route->add("/register", "register", "index");
$route->add("/login/post", "login", "post");
$route->add("/calendar", "calendar", "index");
//////////////////////////

$route->getSession();
$route->submit();


$data = $route->getData();

//
// $request = new Request($route);
// $request->getSession();
//
// $data = $request->getData();

require_once(VIEWS."/layout.html");
