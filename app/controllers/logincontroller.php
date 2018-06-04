<?php
namespace App\Controllers;

use Lib\Controller;
use App\Models\Login;

class LoginController extends Controller
{
    public function indexAction()
    {
        $this->setView("login");
    }

    public function postAction()
    {
        $uname = trim($_POST["uname"]);
        $pass = trim($_POST["pass"]);
        $login = new Login($uname, $pass);
        if ($login->isSuccesful()) {
            $this->startSession();
            $this->redirect("/");
        } else {
            $error = $login->getError() ?? "There was a problem with login.";
            $_SESSION["error"] = $error;
            $this->redirect("/login");
        }
    }
}
