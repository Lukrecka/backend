<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$user = 'root';
$pass = '';
$db = 'cemetary';

$res = array ();
$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
$sqlCemetery = "SELECT id_grave, id_user, coor1, coor2, coor3, coor4, type FROM cemetery ";

$result = mysqli_query($conn, $sqlCemetery);

  
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($res,$row);
    }
  }
  mysqli_close($conn);
  exit(json_encode($res));

$res = [];

if($result = mysqli_query($con,$sqlCemetery))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $res[$i]['id_grave'] = $row['id_grave'];
    $res[$i]['coor1'] = $row['coor1'];
    $res[$i]['coor2'] = $row['coor2'];
    $res[$i]['coor3'] = $row['coor3'];
    $res[$i]['coor4'] = $row['coor4'];
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