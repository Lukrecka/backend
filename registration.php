<?php

namespace Api;
require "database.php";

class registration
{
    private $conn;
    private $sql_register = "INSERT INTO registration (firstname, lastname, username, password, email, number, ID) VALUES (?, ?, ?, ?, ?, ?, UUID())";
    private $sql_checkRegistered = "SELECT * FROM registration  WHERE email = ?";

    function __construct() {
        $this->conn = new \mysqli('localhost', 'root', '', 'cintorin');


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
        $req->bind_param('ssssss', $n->firstname, $n->lastname,$n->username, password_hash($n->password, PASSWORD_DEFAULT), $n->email, $n->number);
        $req->execute();

        return 1;
    }

    private $sql_checkRegistered1 = "SELECT * FROM registration  WHERE username = ? ";

    function loginUser($n) {
        $req = $this->conn->prepare($this->sql_checkRegistered1);
        $req->bind_param('s', $n->username);
        $req->execute();

        $response = $req->get_result();
        
        if($row = $response->fetch_assoc()){
            $heslo = $row['password'];
            $id = $row['ID'];
            if(password_verify($n->password, $heslo)){
                return $id;
            }
        }
        return false;
    }
}
?>
