<?php

    require_once("delete.php");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: *");

    $api =  new \ApiDelete\delete();
    $ret = array();

    $post = json_decode(file_get_contents("php://input"));

    if(!isset($post)){
      exit(json_encode("-1"));
    }

    if(strcmp($post->action, "User") == 0) {
        array_push($ret, array("User" => $api->deleteUser($post)));
    }
/*
    if(strcmp($post->action, "Corpse") == 0) {
      array_push($ret, array("Corpse" => $api->deleteCorpse($post)));
    }

    if(strcmp($post->action, "User") == 0) {
        array_push($ret, array("User" => $api->insertCorpse($post)));
      }
*/
    exit(json_encode($ret));


?>