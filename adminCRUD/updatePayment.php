<?php
require 'database.php';

echo "updateUser";
// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
	

  if ((int)$request->id_user < 1) {
    return http_response_code(400);
  }   
    
  $id  = mysqli_real_escape_string($con, (int)$request->id_user);
  $id_user = $request->id_user ;
  $id_grave = $request->id_grave ;
  $paidDay = $request->paidDay ;
  $type = $request->type ;

  // Update.
  $sql = "UPDATE `payment` SET `id_grave`= '$id_grave' ,`paidDay`= '$paidDay'  ,`type`= '$type'  WHERE `id_user` = '{$id_user}' LIMIT 1";
  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}