<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Credentials: true');

$user = 'root';
$pass = '';
$db = 'cintorin';

$ret = array ();
$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
$sql = "SELECT `id`, `Meno`, `Priezvisko`, `Narodenie`, `Umrtie`, `ZaplateneDo`, `sur1`, `sur2`,`sur3`, `sur4` FROM `cintorin`";
$result = mysqli_query($conn, $sql);
  
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      array_push($ret,$row);
    }
  }
  mysqli_close($conn);
  exit(json_encode($ret));

$reg = [];
//$sql = "SELECT `id`, `Meno`, `Priezvisko`, `Narodenie`, `Umrtie`, `ZaplateneDo`, `Suradnice` FROM `cintorin`";

if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $reg[$i]['id'] = $row['id'];
    $reg[$i]['Meno'] = $row['Meno'];
    $reg[$i]['Priezvisko'] = $row['Priezvisko'];
    $reg[$i]['Narodenie'] = $row['Narodenie'];
    $reg[$i]['Umrtie'] = $row['Umrtie'];
    $reg[$i]['ZaplateneDo'] = $row['ZaplateneDo'];
    $reg[$i]['sur1'] = $row['sur1'];
    $reg[$i]['sur2'] = $row['sur2'];
    $reg[$i]['sur3'] = $row['sur3'];
    $reg[$i]['sur4'] = $row['sur4'];
    $i++;
  }

  echo json_encode($reg);
}
else
{
  http_response_code(404);
}

?>