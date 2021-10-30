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

    //Prepare statement with query
    public function query($query)
    {

        $this->stmt = $this->dbh->prepare($query);
    }

    //Bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statement
    public function execute()
    {
        $this->stmt->execute();
    }

    //Get a result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Get single recorde as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Get Row Count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
