<?php
namespace App\Models;

use Lib\Model;

/**
 *
 */
class CalDav extends Model
{
    const ICLOUD_URL = "https://caldav.icloud.com";
    protected $propfind;

    protected function setUp()
    {
        $this->hasTable("caldav");

        $this->hasColumn("id");
        $this->hasColumn("auth");

        $this->propfind = new \SimpleXMLElement("<propfind></propfind>");
    }

    public function setAuth($username, $password)
    {
        $this->column["auth"] = base64_encode($username . ":" . $password);
    }
}
