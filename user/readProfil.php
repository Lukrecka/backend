<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$user = 'root';
$pass = '';
$db = 'cemetary';

$id = $_GET['id'];
$res = array ();
$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
$sqlUsers = "SELECT `id_user`,  `name`, `lastname`, `number`, `email`, `password`, `town`, `street`, `number_house`, `postcode` FROM users WHERE `id_user` = '{$id}' ";


$result = mysqli_query($conn, $sqlUsers);

  
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
    $res[$i]['name'] = $row['name'];
    $res[$i]['lastname'] = $row['lastname'];
    $res[$i]['number'] = $row['number'];
    $res[$i]['email'] = $row['email'];
    $res[$i]['password'] = $row['password'];
    $res[$i]['town'] = $row['town'];
    $res[$i]['street'] = $row['street'];
    $res[$i]['number_house'] = $row['number_house'];
    $res[$i]['postcode'] = $row['postcode'];
    $i++;
  }

  echo json_encode($res);
}
else
{
  http_response_code(404);
}

?>