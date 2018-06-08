<?php
namespace App\Models;

use Lib\Model;

/**
 * manages the calendar data
 */
class Calendar extends Model
{

    /*
    * returns a row from the calendar table
    * associated with provided user_id and
    * adds data to calendar instance
    */
    public function getCalendar($user_id)
    {
        if ($calendar = $this->find($user_id, "user_id")) {
            $this->setInstance($calendar);
            return true;
        }
    }


    public function getURL()
    {
        return $this->column["url"];
    }

    /*
    ***************************************
    *      PROTECTED FUNCTIONS
    ***************************************
    */

    /*
    * passes information about table to class
    */
    protected function setUp()
    {
        $this->hasTable("calendar");

        $this->hasColumn("id");
        $this->hasColumn("url");
        $this->hasColumn("user_id");
        $this->hasColumn("caldav_id");
        $this->hasColumn("created_at");
    }
}
