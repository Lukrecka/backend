<?php

    require_once("registration.php");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: *");

    $api = new \Api\registration();
 
    $ret = array();

    $post = json_decode(file_get_contents("php://input"));

    if(!isset($post)){
      exit(json_encode("-1"));
    }

    if(strcmp($post->action, "register") == 0) {
        array_push($ret, array("registracia" => $api->registerUser($post)));
    }

    if(strcmp($post->action, "login") == 0) {
      array_push($ret, array("prihlasenie" => $api->loginUser($post)));

  }

    exit(json_encode($ret));


?>