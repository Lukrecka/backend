<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$user = 'root';
$pass = '';
$db = 'cintorin';

$ret = array ();
$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
$sql ="SELECT `id`,`firstname`, `lastname`, `username`, `password`, `email`, `number` FROM `registration`";
$result = mysqli_query($conn, $sql);

  
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($ret,$row);
    }
  }
  mysqli_close($conn);
  exit(json_encode($ret));

$reg = [];
$sql = "SELECT `id`,`firstname`, `lastname`, `username`, `password`, `email`, `number` FROM `registration`";

if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $reg[$i]['id'] = $row['id'];
    $reg[$i]['firstname'] = $row['firstname'];
    $reg[$i]['lastname'] = $row['lastname'];
    $reg[$i]['username'] = $row['username'];
    $reg[$i]['password'] = $row['password'];
    $reg[$i]['email'] = $row['email'];
    $reg[$i]['number'] = $row['number'];
    $i++;
  }

  echo json_encode($reg);
}
else
{
  http_response_code(404);
}

?>