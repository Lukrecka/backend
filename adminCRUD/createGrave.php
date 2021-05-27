<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  $id_grave = $request->id_grave ;
  $coor1 = $request->coor1 ;
  $coor2 = $request->coor2 ;
  $coor3 = $request->coor3;
  $coor4 = $request-> coor4;
  $type = $request->type ;

  // Store.
  $sql = "INSERT INTO `cemetery`(`id_grave`, `id_user`, `coor1`, `coor2`, `coor3`, `coor4`, `type`)
          VALUES ('{$id_grave}', 0,'{$coor1}','{$coor2}','{$coor3}','{$coor4}','{$type}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $sorpse = [
      'id_grave' => $id_grave,
      'coor1' => $coor1,
      'coor2' => $coor2,
      'coor3' => $coor3,
      'coor4' => $coor4,
      'type'    => $type
    ];
    echo json_encode($sorpse);
  }
  else
  {
    http_response_code(422);
  }
}
?>