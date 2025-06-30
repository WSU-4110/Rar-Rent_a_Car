<?php


class Database{

    private $host = "rardb.c9g0iygiccbe.us-east-2.rds.amazonaws.com";
    private $username = "root";
    private $password = "Poiuytre123*";
    private $db = "rardb";

    function connect(){
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $connection;
    }
    
    function read($query){
        $conn = $this->connect();
        $result =  mysqli_query($conn, $query);

        if(!$result){
            return false;
        }
        else{
            $data = false;
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
            return $data;
        }
    
    }
    
    function save($query){
        $conn = $this->connect();
        $result =  mysqli_query($conn, $query);

        if(!$result){
            return false;
        }
        else{
            return true;
        }
    }

}


