<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require 'database.php';

$postdata = file_get_contents("php://input");

var_dump($postdata);
if(isset($postdata) && !empty($postdata))
{

  $request = json_decode($postdata);
  $id_grave = $request->id_grave;
  $paidDay =  date("Y-m-d");
  $paidBy = date('Y-m-d', strtotime('+10 year'));
  $type = "dvoj";
  $id_user = $request->id_user ;

  var_dump($paidBy);
  var_dump(gettype($paidBy));
  
   //Update date of corpse
   $updateCorpse = "UPDATE `corpses` SET `paidBy`= \"$paidBy\" WHERE `id_grave`= $id_grave";


  if(mysqli_query($con,$updateCorpse))
  {
    http_response_code(201);
    
    $corpse = [
      'id_grave' => $id_grave,
      'name' => 'nic',
      'lastname' => 'nic',
      'birthDay' => 0000-00-00,
      'deadDay' =>0000-00-00,
      'paidDay'    => $paidDay
    ]; 
    echo json_encode($corpse); 
  }
  else
  {
    http_response_code(422);
  }
 
/*

  //CREATE new payment 
  $sqlInsertPayment = "INSERT INTO `payment`(`id_user`, `id_grave`, `paidDay`, `type`)
                         VALUES ('{$id_user}','{$id_grave}','{$paidDay}','{$type}')";

if(mysqli_query($con,$sqlInsertPayment))
{
 
  http_response_code(201);
  
  $pay = [
    'id_user' =>  $id_user,
    'id_grave' => $id_grave,
    'paidDay'  => $paidDay,
    'type' => $type
  ]; 
  echo json_encode($pay); 
}
else
{
  http_response_code(422);
}

*/
}


?>