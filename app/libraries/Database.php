<?php

/**
 * PDO Databse Class
 * Connect to database
 * Craete prepared statements
 * Bind values
 * Return rows & results
 *  */
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        //Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            //echo "Connection is  ok";
        } catch (PDOException $pdoException) {
            $this->error = $pdoException->getMessage();
            echo $this->error;
        }
    }
}
