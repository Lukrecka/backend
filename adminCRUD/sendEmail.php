<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Credentials: true');

ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","587");
ini_set("sendmail_from","lukrecia.szilvasiova13@gmail.com");
ini_set("sendmail_path", "C:\wamp\bin\sendmail.exe -t");
//$to = 'jakubsip52@gmail.com';
$to = 'bakalarka.test@gmail.com';
$subject = 'Priponenutie vypršania nájomnej zmluvy';
$from = 'lukrecia.szilvasiova13@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<p>Dobrý deň,</p>';
$message .= '<p>Touto cestou by som Vám rád pripomenul, že Vám o nedlho končí platnosť nájomnej zmuvy. Predĺžiť si ju môžete online pomocou vášho profilu na stránke alebo priamo u správcu cintorína. </p>';
$message .= '<p>Prajem pekný zvyšok dňa.</p>';
$message .= '</body></html>';
 


//$datenow = date("Y-m-d");
$date30 = new DateTime();
$date30->modify('+30 day');
//$date30->getTimestamp();
$date7 = new DateTime();
$date7->modify('+7 day');
//$date7->getTimestamp();
echo $date30->getTimestamp();;

$user = 'root';
$pass = '';
$db = 'cemetary';

$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
$sql = "SELECT users.email AS email, corpses.paidBy AS paidBy, corpses.id_grave as id_grave
FROM users, corpses
LEFT JOIN cemetery ON cemetery.id_grave = corpses.id_grave
WHERE users.id_user = cemetery.id_user and users.id_user !=0";

$result = mysqli_query($conn, $sql);
  
$info = [];
  if($result = mysqli_query($conn,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
     // echo strtotime($row['zaplateneDo']);
    //$interval = date_diff($datenow, $row['zaplateneDo']);
    //echo $interval;
    if($date30->getTimestamp() >  strtotime($row['paidBy']) ){        
        if(mail($row['email'], $subject,$message, $headers)){
            echo $row['email'];
        }
        else{ echo "nejde";}
        
    }
    $info[$i]['email'] = $row['email'];
    $info[$i]['paidBy'] = $row['paidBy'];
    $info[$i]['id_grave'] = $row['id_grave'];
    $i++;
  }

  //echo json_encode($info);
}
else
{
  http_response_code(404);
}

//echo $tomorrow = date("Y-m-d", time() + 2592000);

?>