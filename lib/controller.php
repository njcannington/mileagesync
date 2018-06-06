<?php
namespace Lib;

use App\Models\User;

/**
 * base class for all controllers
 */

class Controller
{
    protected $view;
    protected $error;
    protected $current_user;

    public function __construct()
    {
        if (isset($_SESSION["username"])) {
            $user = new User();
            $user->fetchByUsername($_SESSION["username"]);
            $this->current_user = $user;
        }

        if (isset($_SESSION["error"])) {
            $this->error = $_SESSION["error"];
            unset($_SESSION["error"]);
        }
    }


    /*
    ***************************************
    *           PROTECTED METHODS
    ***************************************
    */

    /*
    * sets the view to be used for specific actions
    */
    protected function setView($view)
    {
        $this->view = VIEWS."/".$view.".html";
    }

    /*
    * used to set an error message to be displayed
    */
    protected function setError($error)
    {
        $_SESSION["error"] = $error;
    }

    /*
    * redircts url based on provided uri
    */
    protected function redirect($uri)
    {
        header('Location: '.$uri);
        die();
    }


    /*
    ***************************************
    *      METHODS TO OBTAIN PROPERTIES
    ***************************************
    */

    public function getView()
    {
        return $this->view;
    }

    public function getError()
    {
        if (isset($this->error)) {
            return $this->error;
        }
        return false;
    }
}
