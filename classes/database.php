<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class database
{
    private $connection;

    function __construct($hostName,$dbUsername,$dbPassword,$dbName){
        $this->dbOpen($hostName,$dbUsername,$dbPassword,$dbName);
    }

    private function dbOpen($hostName,$dbUsername,$dbPassword,$dbName){
        $this->connection = mysqli_connect($hostName,$dbUsername,$dbPassword,$dbName);
        if (mysqli_connect_errno()) {
            die("Connection failed: " .mysqli_connect_error());
        }
    }

    public function dbQuery($queryString){
        try{
            return mysqli_query($this->connection,$queryString);
        }
        catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function dbFetch($result){
        return mysqli_fetch_assoc($result);
     }

    public function dbLastId(){
        return $this->connection->insert_id;
    }

    public function dbRowsCount($result){
        return $result?mysqli_num_rows($result):0;
    }

    public function dbEncode($valueString){
        return mysqli_real_escape_string($this->connection,$valueString);
    }

    public function dbClose(){
        return mysqli_close($this->connection);
    }

    public function setTransaction($mode = false){
        mysqli_autocommit($this->connection,$mode);
    }

    public function commit(){
        return mysqli_commit($this->connection);
    }

    public function rollBack(){
        mysqli_rollback($this->connection);
    }

}