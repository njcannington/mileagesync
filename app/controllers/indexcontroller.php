<?php
namespace App\Controllers;

use Lib\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->setView("index");
    }
}
