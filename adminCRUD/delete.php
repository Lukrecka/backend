<?php

require 'database.php';

// Extract, validate and sanitize the id.
$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id']) : false;
$type = ($_GET['type']);


//grave
 if(strcmp($type, 'grave') == 0){
    if(!$id)
    {
    return http_response_code(400);
    }

    $sql = "DELETE FROM `cemetery` WHERE`id_grave` ='{$id}' LIMIT 1 ";


    if(mysqli_query($con, $sql))
    {
    http_response_code(204);
    }
    else
    {
    return http_response_code(422);
    }
}
//zosnuly
 if(strcmp($type, 'corpse') == 0){
    if(!$id)
    {
    return http_response_code(400);
    }

    $sql = "DELETE FROM `corpses` WHERE`id_corpse` ='{$id}' LIMIT 1 ";


    if(mysqli_query($con, $sql))
    {
    http_response_code(204);
    }
    else
    {
    return http_response_code(422);
    }
}
//user
if(strcmp($type, 'user') == 0){
    if(!$id)
    {
    return http_response_code(400);
    }

    $sql = "DELETE FROM `user` WHERE `id_user` ='{$id}' LIMIT 1 ";


    if(mysqli_query($con, $sql))
    {
    http_response_code(204);
    }
    else
    {
    return http_response_code(422);
    }
}

?>
