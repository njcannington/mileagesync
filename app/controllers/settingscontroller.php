<?php
namespace App\Controllers;

use Lib\Controller;
use App\Models\CalDav;

class SettingsController extends Controller
{
    public function indexAction()
    {
        if ($this->current_user->hasCalDav()) {
            if ($this->current_user->hasCalendar()) {
                $calendar = $this->current_user->getCalendar();
                $this->setView("settings");
            } else {
                $caldav = $this->current_user->getCalDav();
                $calendars = $caldav->getCalendars();
                $this->setView("settings/select");
                return compact("calendars");
            }
        } else {
            $this->setView("settings/login");
        }
    }

    public function postAction()
    {
    }
}
