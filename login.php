<?php

/*
namespace Api;
require "database.php";

class login
{
    private $conn;
    //private $sql_log = "SELECT * FROM registration ";
    //private $sql_register = "INSERT INTO registration (firstname, lastname, username, password, email, number) VALUES (?, ?, ?, ?, ?, ?)";
    private $sql_checkRegistered = "SELECT * FROM users  WHERE email = ? ";

    function __construct() {
        $this->conn = new \mysqli('localhost', 'root', '', 'cemetary');


        if ($this->conn->error) {
            die("Connection refused" . $this->conn->error_list);
        }
    }

    function loginUser($n) {
        $req = $this->conn->prepare($this->sql_checkRegistered);
        $req->bind_param('ss', $n->email);
        $req->execute();

        $response = $req->get_result();
        $password_hashed = $response['password'];
        if($row != $response->fetch_assoc()){
          return -1;
        }
        if($row = $response->fetch_assoc()){
            echo("daco");
            if(password_verify($n->password, $password_hashed)){
                echo("prihlaseny");
            }
          }
    

        //$req = $this->conn->prepare($this->sql_register);
        //$req->bind_param('ssssss', $n->firstname, $n->lastname,$n->username, password_hash($n->password, PASSWORD_DEFAULT), $n->email, $n->number);
        //$req->execute();

        //return 1;
    }
}
*/

?>