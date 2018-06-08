<?php
namespace App\Models;

use Lib\Model;

class User extends Model
{
    protected $id;
    protected $username;
    protected $password;
    protected $created_at;


    /*
    * sets User() instance with data matching
    * the user record associated with provided username
    */
    public function fetchByUsername($username)
    {
        $user = $this->record->fetchAll(["username" => $username]);
        if (isset($user["id"])) {
            $this->setInstance($user);
        } else {
            throw new \Exception("Could not find user. Check username.");
        }
    }

    /*
    ***************************************
    *      PUBLIC FUNCTIONS
    ***************************************
    */

    /*
    * returns true if password provided matches
    * password for current instance of User();
    */
    public function hasPassword($pass)
    {
        if ($this->getPassword() == md5($pass)) {
            return true;
        } else {
            throw new \Exception("Password is incorrect.");
        }
    }

    /*
    * returns true if user stored in $_SESSION is current
    * instance of User()
    */
    public function isLoggedIn()
    {
        return $_SESSION['username'] == $this->column["username"];
    }

    /*
    * sets the current instane of User() as as the $_SESSION user
    */
    public function login()
    {
        $_SESSION['username'] = $this->column["username"];
    }

    /*
    * unsets current $_SESSION
    */
    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function hasCalendar()
    {
    }

    public function hasCalDav();

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
        $this->hasTable("users");

        $this->hasColumn("id");
        $this->hasColumn("username");
        $this->hasColumn("password");
        $this->hasColumn("created_at");
    }


    /*
    ***************************************
    *      METHODS TO SET PROPERTIES
    ***************************************
    */

    public function setUsername($username)
    {
        $this->column["username"] = $username;
    }

    public function setPassword($password)
    {
        $this->column["password"] = md5($password);
    }

    /*
    ***************************************
    *      METHODS TO OBTAIN PROPERTIES
    ***************************************
    */

    // keep password method private / protected
    protected function getPassword()
    {
        return $this->column["password"];
    }

    public function getID()
    {
        return $this->column["id"];
    }
}
