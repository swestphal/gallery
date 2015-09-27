<?php
require_once ("config.php");
class Database
{

    private $connection;

    function __construct() {
        $this->open_db_connection();
    }

    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_errno) {
            echo("Database connection failed" . $this->connection->connect_error);
        }
    }

    public function query($query) {
        $result = $this->connection->query($query);

        return $result;

    }

    public function get_db_con(){
        return $this->connection;
    }

    public function inserted_id() {

        $id = $this->connection->insert_id;
        return $id;
        }

    private function confirm_query($result){
        if($result){
            die ("Query failed!");
        }
    }

    public function escape_string($string) {
        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }
}

$database = new Database();
