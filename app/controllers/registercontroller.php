<?php
namespace App\Controllers;

use Lib\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function indexAction()
    {
        $this->setView("register");
    }

    public function postAction()
    {
        $uname = trim($_POST["uname"]);
        $pass = trim($_POST["pass"]);
        $confirm = trim($_POST["confirm-pass"]);

        if ($pass !== $confirm) {
            $this->setError("Passwords do not match");
            $this->redirect("/register");
        } else {
            try {
                $user = new User();
                $user->setUsername($uname);
                $user->setPassword($pass);
                $user->save();
                $this->redirect("/");
            } catch (\Exception $e) {
                $this->setError($e->getMessage());
                $this->redirect("/register");
            }
        }
    }
}
