<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	
  // Validate.
  
  if ((int)$request->id_corpse < 1) {
    return http_response_code(400);
  }   
    
  // Sanitize.
  //$id    = mysqli_real_escape_string($con, (int)$request->id_corpse);

  // Update.
  $sql ="UPDATE `corpses` SET `id_grave`= '$request->id_grave' ,`name`= '$request->name' ,`lastname`= '$request->lastname' ,`birthDay`= '$request->birthDay' ,`deadDay`= '$request->deadDay',`paidBy`= '$request->paidBy'  WHERE  `id_corpse` = '{$request->id_corpse}' LIMIT 1";
  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}