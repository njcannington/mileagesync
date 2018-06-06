<?php
namespace App\Controllers;

use Lib\Controller;
use App\Models\Login;
use App\Models\User;

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

        try {
            $user = new User();
            $user->fetchByUsername($uname);
            if ($user->hasPassword($pass)) {
                $user->login();
                $this->redirect("/");
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
            $this->redirect("/login");
        }
    }
}
