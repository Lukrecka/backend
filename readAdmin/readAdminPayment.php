<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$user = 'root';
$pass = '';
$db = 'cemetary';

$res = array ();
$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
$sqlPayment = "SELECT id_user, id_grave, paidDay, type FROM payment";

$result = mysqli_query($conn, $sqlPayment);

  
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($res,$row);
    }
  }
  mysqli_close($conn);
  exit(json_encode($res));

$res = [];

if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $res[$i]['id_user'] = $row['id_user'];
    $res[$i]['id_grave'] = $row['id_grave'];
    $res[$i]['paidBy'] = $row['paidBy'];
    $res[$i]['type'] = $row['type'];
    $i++;
  }

  echo json_encode($res);
}
else
{
  http_response_code(404);
}

?>