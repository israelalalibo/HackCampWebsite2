<?php

namespace Models;
require_once ('Models/Database.php');
class LoginChecks
{
    private $username;
    private $password;
    protected $_dbHandle;
    private $_dbInstance;

    public function  __construct($uname, $pwd){
        $this->username = $uname; //
        $this->password = $pwd;
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getDbConnection();
    }

    /**
     * @return bool
     * Checks if username entered by user is in database
     *
     */
    public function checkUserName(){  //
        $result = null;
        $query = "SELECT * FROM users WHERE username LIKE '$this->username';";
        $statement = $this->_dbHandle->prepare($query);
        $statement->execute();

        if ($statement->rowCount() > 0){ //if there is atleast one row of data returned
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    /**
     * @return bool
     * true if password is found. False if password is not found
     */
    public function checkPassword(){  //checks if password is in database  passwd = '$this->password' AND
        $result = null;
        $query = "SELECT passwd FROM users WHERE  username = '$this->username';";
        $statement = $this->_dbHandle->prepare($query);
        $statement->execute();

        $row = $statement->fetch();
        //$hashed_pwd_from_database = $row['passwd']; and password_verify($this->password, $row['passwd']) !== null
        // && password_verify($this->password, $row['passwd']

        if ($statement->rowCount() > 0 && password_verify($this->password, $row['passwd'])){

            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

}