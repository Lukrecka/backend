<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Credentials: true');

$user = 'root';
$pass = '';
$db = 'cemetary';

$ret = array ();
$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
//$sql = "SELECT corpses.name as name, corpses.lastname as lastname, corpses.birthDay as birth, corpses.deadDay as dead, corpses.paidBy as paidBy, corpses.id_corpse as id_corpse,
 //       cemetery.id_grave as id_grave, cemetery.coor1 as coor1, cemetery.coor2 as coor2, cemetery.coor3 as coor3, cemetery.coor4 as coor4
//        FROM corpses, cemetery
//        WHERE corpses.id_grave = cemetery.id_grave";
$sql = "SELECT corpses.name as name, corpses.lastname as lastname, corpses.birthDay as birth, corpses.deadDay as dead, corpses.paidBy as paidBy, corpses.id_corpse as id_corpse,
cemetery.id_grave as id_grave, cemetery.id_user as id_user, cemetery.coor1 as coor1, cemetery.coor2 as coor2, cemetery.coor3 as coor3, cemetery.coor4 as coor4
FROM  cemetery LEFT JOIN corpses ON  corpses.id_grave = cemetery.id_grave";
$result = mysqli_query($conn, $sql);
  
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($ret,$row);
    }
  }
  mysqli_close($conn);
  exit(json_encode($ret));

$info = [];
if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $info[$i]['id_grave'] = $row['id_user'];
    $info[$i]['id_grave'] = $row['id_grave'];
    $info[$i]['id_corpse'] = $row['id_corpse'];
    $info[$i]['name'] = $row['name'];
    $info[$i]['lastname'] = $row['lastname'];
    $info[$i]['birth'] = $row['birth'];
    $info[$i]['dead'] = $row['dead'];
    $info[$i]['paidBy'] = $row['paidBy'];
    $info[$i]['coor1'] = $row['coor1'];
    $info[$i]['coor2'] = $row['coor2'];
    $info[$i]['coor3'] = $row['coor3'];
    $info[$i]['coor4'] = $row['coor4'];
    $i++;
  }

  echo json_encode($info);
}
else
{
  http_response_code(404);
}

?>