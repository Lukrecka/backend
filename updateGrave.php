<?php
require 'database.php';

echo "updateUser";
// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
	

  if ((int)$request->id_grave < 1) {
    return http_response_code(400);
  }   
    
  $id  = mysqli_real_escape_string($con, (int)$request->id_grave);
  $id_grave = $request->id_grave ;
  $coor1 = $request->coor1 ;
  $coor2 = $request->coor2 ;
  $coor3 = $request->coor3;
  $coor4 = $request-> coor4;
  $type = $request->type ;

  // Update.
  $sql = "UPDATE `cemetery` SET `coor1`= '$coor1' ,`coor2`= '$coor2' ,`coor3`= '$coor3'  ,`coor4`= '$coor4'  ,`type`= '$type'  WHERE `id_grave` = '{$id_grave}' LIMIT 1";
  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}