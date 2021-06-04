<?php

namespace Api;
require "database.php";

class registration
{
    private $conn;
    private $sql_register = "INSERT INTO users (`id_user`, `name`, `lastname`, `number`, `email`, `password`, `town`, `street`, `number_house`, `postcode`) 
                                VALUES (UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    private $sql_checkRegistered = "SELECT * FROM users  WHERE email = ?";

    function __construct() {
        $this->conn = new \mysqli('localhost', 'root', '', 'cemetary');


        if ($this->conn->error) {
            die("Connection refused" . $this->conn->error_list);
        }
    }

    function registerUser($n) {
        $req = $this->conn->prepare($this->sql_checkRegistered);
        $req->bind_param('s', $n->email);
        $req->execute();

        $response = $req->get_result();
        if($row = $response->fetch_assoc()){
          return -1;
        }

        $req = $this->conn->prepare($this->sql_register);
        $req->bind_param('sssssssss', $n->name,  $n->lastname, $n->number, $n->email,  password_hash($n->password, PASSWORD_DEFAULT), $n->town, $n->street, $n->number_house, $n->postcode);
        $req->execute();

        return 1;
    }

    private $sql_checkRegistered1 = "SELECT * FROM users  WHERE email = ?";

    function loginUser($n) {
        $req = $this->conn->prepare($this->sql_checkRegistered1);
        $req->bind_param('s', $n->email);
        $req->execute();

        $response = $req->get_result();
        
        if($row = $response->fetch_assoc()){
            $password = $row['password'];
            $id_user = $row['id_user'];
            if(password_verify($n->password, $password)){
                return $id_user;
            }
        }
        
        return false;
    }
    
}
?>
