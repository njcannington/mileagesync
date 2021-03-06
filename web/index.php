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
$route->add("/login/post", "login", "post");

$route->add("/logout", "logout", "index");

$route->add("/register", "register", "index");
$route->add("/register/post", "register", "post");

$route->add("/settings", "settings", "index");
$route->add("/settings/post", "settings", "post");
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
