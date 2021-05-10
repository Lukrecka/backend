<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	

  // Validate.
  /*
  if(trim($request->number) === '' || (float)$request->amount < 0)
  {
    return http_response_code(400);
  }
  */
	
  // Sanitize.
  //$number = mysqli_real_escape_string($con, trim($request->number));
 // $amount = mysqli_real_escape_string($con, (int)$request->amount);
    

  // Store.
  $sql = " INSERT INTO `registration`(`id`, `firstname`, `lastname`, `username`, `password`, `email`, `number`, `hrob_id`)
   VALUES (UUID(),'{$request->firstname}','{$request->lastname}','user','user','user','user','user')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'id'    => mysqli_insert_id($con),
      'username' => 'user',
      'password' => 'user',
      'email' => 'user',
      'number' => 'user',
      'hrob_id' => 'user',
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}
?>
