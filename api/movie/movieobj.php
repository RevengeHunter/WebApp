<?php
class Movie{

    private $conn;
    private $table_name = "tblmovie";
 
    public $id;
    public $name;
    public $description;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM tblmovie";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
?>