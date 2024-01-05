<?php
//Hi I am Ismail
//Kartik loves Dave. Dave has butterflies in his belly
//Yooooooo!!!!!!!!!!
//gfhgfj
//Ropnaldo is the goat
namespace Models;

use PDO;
use PDOException;

class Database
{
    protected static $_dbInstance;
    protected  $_dbHandle;

    /**
     * @param $username
     * @param $password
     * @param $host
     * @param $database
     * Constructor for the database object. Establishes connection with the database
     */
    public function __construct($username, $password, $host, $database){
        try{
            $this->_dbHandle = new PDO("mysql:host=$host; dbname=$database", $username, $password);
        }
        catch (PDOException $exception){  //catches any failure to connect with the database
            echo $exception->getMessage();
            die(); //kills database connection
        }
    }
    public static function getInstance(){
        $username = 'hc23-20';      $pass = 'RRovClugJy5a8o4';
        $host = 'poseidon.salford.ac.uk';  $dbName = 'hc23_20';

        if (is_null(self::$_dbInstance)){
            self::$_dbInstance = new self($username, $pass, $host, $dbName);
        }

        return self::$_dbInstance;
    }

    /**
     * @return PDO
     * returns the PDO handle to be used elsewhere
     */
    public function getDbConnection(){
        return $this->_dbHandle;
    }

    public function __destruct(){
        $this->_dbHandle = null;
    }
}
