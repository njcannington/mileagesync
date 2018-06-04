<?php
namespace App\Models;

use Lib\Db;

class Login
{
    protected $uname;
    protected $pass;
    protected $record;
    protected $error = null;

    public function __construct($uname, $pass)
    {
        $this->uname = strtolower($uname);
        $this->pass = md5($pass);

        $this->getRecord();
        $this->setErrors();
    }

    protected function getRecord()
    {
        $db = Db::getInstance();
        $sql = "SELECT username, password FROM users WHERE username = :username";
        $this->record = $db->prepare($sql);
        $this->record->bindParam(':username', $this->uname, \PDO::PARAM_STR);
        $this->record->execute();
    }

    protected function userExists()
    {
        return $this->record->rowCount() == 1;
    }

    protected function passwordMatches()
    {
        $row = $this->record->fetch();
        return $this->pass == $row["password"];
    }

    protected function setErrors()
    {
        if (!$this->userExists()) {
            $this->error = "User does not exists";
        } elseif (!$this->passwordMatches()) {
            $this->error = "Invalid password";
        }
    }

    public function getError()
    {
        return $this->error;
    }

    public function startSession()
    {
        $_SESSION['username'] = $this->uname;
    }

    public function isSuccesful()
    {
        return is_null($this->error);
    }

    public static function logut()
    {
        $_SESSION = array();
        session_destroy();
    }
}
