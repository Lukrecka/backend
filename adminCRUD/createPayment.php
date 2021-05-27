<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  $id_user = $request->id_user ;
  $id_grave = $request->id_grave ;
  $paidDay = $request->paidDay ;
  $type = $request->type ;

  // Store.
  $sql = "INSERT INTO `payment`(`id_user`, `id_grave`, `paidDay`, `type`) VALUES ('{$id_user}','{$id_grave}','{$paidDay}','{$type}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $payment = [
      'id_user' => $id_user,
      'id_grave' => $id_grave,
      'paidDay' => $paidDay,
      'type' => $type,
    ];
    echo json_encode($payment);
  }
  else
  {
    http_response_code(422);
  }
}
?>