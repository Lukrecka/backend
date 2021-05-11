<?php

require 'database.php';


$id = $_GET['id'];

$ret = array ();
$sql = "SELECT payment.paidDay AS 'paidDay', payment.type AS 'type'
        FROM payment LEFT JOIN users ON users.id_grave = payment.id_grave WHERE users.id_user ='{$id}' ";
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
    $reg[$i]['paidDay'] = $row['paidDay'];
    $reg[$i]['type'] = $row['type'];
    $i++;
  }

  echo json_encode($reg);
}
else
{
  http_response_code(404);
}

?>