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
  $name = $request->name ;
  $lastname = $request->lastname ;
  $number = $request->number ;
  $email = $request->email ;
  $password = $request->password ;
  $town = $request->town ;
  $street = $request->street ;
  $number_house = $request->number_house ;
  $postcode = $request->postcode ;

  // Update.
  $sql = "UPDATE `users` SET  `name`= '$name',`lastname`= '$lastname',`number` = '$number',`email`= '$email' ,`password`= '$password' ,
  `town`= '$town', `street` = '$street', `number_house` = '$number_house', `postcode` = '$postcode' WHERE `id_user` = '{$id_user}' LIMIT 1";

  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}