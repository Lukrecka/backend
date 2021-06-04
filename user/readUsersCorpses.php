<?php

require 'database.php';


$id = $_GET['id'];

$ret = array ();
$sql = "SELECT * FROM corpses JOIN cemetery ON cemetery.id_grave = corpses.id_grave JOIN users ON users.id_user = cemetery.id_user WHERE users.id_user = '{$id}' ";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($ret,$row);
    }
  }
  mysqli_close($con);
  exit(json_encode($ret));

$reg = [];

if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $reg[$i]['name'] = $row['name'];
    $reg[$i]['lastname'] = $row['lastname'];
    $reg[$i]['birthDay'] = $row['birthDay'];
    $reg[$i]['deadDay'] = $row['deadDay'];
    $reg[$i]['paidBy'] = $row['paidBy'];
    $i++;
  }

  echo json_encode($reg);
}
else
{
  http_response_code(404);
}

?>