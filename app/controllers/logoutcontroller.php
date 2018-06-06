<?php
namespace App\Controllers;

use Lib\Controller;

class LogoutController extends Controller
{
    public function indexAction()
    {
        $this->current_user->logout();
        $this->redirect("/login");
    }
}
