<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  $id_grave = $request->id_grave ;
  $name = $request->name ;
  $lastname = $request->lastname ;
  $birthDay = $request->birthDay;
  $deadDay = $request-> deadDay;
  $paidDay = $request->paidDay ;
  $id_corpse = UUID();

  // Store.
  $sql = "INSERT INTO `corpses`(`id_corpse`, `id_grave`, `name`, `lastname`, `birthDay`, `deadDay`, `paidBy`)
   VALUES ('{$id_corpse}','{$id_grave}','{$name}','{$lastname}','{$birthDay}','{$deadDay}','{$paidDay}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $sorpse = [
      'id_corpse' => $id_corpse ,
      'id_grave' => $id_grave,
      'name' => $name,
      'lastname' => $lastname,
      'birthDay' => $birthDay,
      'deadDay' => $deadDay,
      'paidDay'    => $paidDay
    ];
    echo json_encode($sorpse);
  }
  else
  {
    http_response_code(422);
  }
}
?>