<?php
namespace Lib;

/**
* class assocaited with routing uri to controller / action
*/
class Route
{
    protected $available_routes = [];
    protected $uri;
    public $controller;
    protected $action;


    public function __construct($uri)
    {
        $this->uri = "/".$uri;
    }

    /*
    ***************************************
    *           PUBLIC METHODS
    ***************************************
    */

    /*
    * checks for session or redirects to login
    */
    public function getSession()
    {
        $session_exempt = ["/register", "/login", "/login/post"];

        if (!in_array($this->uri, $session_exempt)) {
            if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
                header("location: /login");
                exit;
            }
        }
    }

    /*
    * sets the correct controller and returns the data based on the corresponding
    * action set by the URI
    */
    public function submit()
    {
        $route = $this->getCurrentRoute($this->uri);
        $controller = $route["controller"];
        $action = $route["action"];

        $this->controller = new $controller();
        $this->data = $this->controller->$action();
    }

    /*
    * sets up uri to controller/action relationship
    */
    public function add($uri, $controller, $action)
    {
        $this->available_routes[] =
        ["uri" => $uri,
        "controller" => "App\Controllers\\".ucfirst($controller)."Controller",
        "action" => strtolower($action)."Action"];
    }

    /*
    ***************************************
    *           PROTECTED METHODS
    ***************************************
    */

    /*
    * traverses through the available routes property to
    *  return corresponding route based associated
    *  with the given $uri
    */
    protected function getCurrentRoute()
    {
        foreach ($this->available_routes as $route) {
            if ($route["uri"] == $this->uri) {
                return $route;
            }
        }
        if ($this->controller == null) {
            return ["controller" => "App\Controllers\\ErrorController",
                    "action" => "indexAction"];
        }
    }

    /*
    ***************************************
    *      METHODS TO OBTAIN PROPERTIES
    ***************************************
    */


    public function getData()
    {
        return $this->data;
    }
}
