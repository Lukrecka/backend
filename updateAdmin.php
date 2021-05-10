<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	
  // Validate.
  
  if ((int)$request->id < 1) {
    return http_response_code(400);
  }   
    
  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->id);
  $firstname    = mysqli_real_query($con, $request->firstname);
  $lastname = mysqli_real_query($con, $request->lastname);


  // Update.
  $sql = "UPDATE `registration` SET `firstname`='$request->firstname',`lastname`='$request->lastname'  WHERE `id` = '{$request->id}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}