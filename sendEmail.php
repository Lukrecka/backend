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
$to = 'bakalarka.test@gmail.com'
$subject = 'Andžular';
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
$message .= '<h1 style="color:#0000ff;">Zadanie</h1>';
$message .= '<h4 style="color:#ff3399;font-size:18px;">Platobná brána </h4>';
$message .= '<h2 style="color:#f40;font-size:18px;">Podklady nie sú</h2>';
$message .= '</body></html>';
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
/*
$to = "bakalarka.test@gmail.com ";
$subject = "BLOKI";
//$message = "Ide to aj cez angular";
$headers = "From: lukrecia.szilvasiova13@gmail.com";
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">Hi Jane!</h1>';
$message .= '<p style="color:#080;font-size:18px;">Will you marry me?</p>';
$message .= '</body></html>';
if(mail($to, $subject,$message, $headers)){
    echo" ide";
}
else{ echo "nejde";}

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
$db = 'cintorin';

$conn = new mysqli ('localhost',$user,$pass,$db) or die("nejde");
$sql = "SELECT cintorin.ZaplateneDo as zaplateneDo, cintorin.id as id_hrob_cint, registration.firstname as meno, registration.lastname as priezvisko, registration.email as email,
    registration.hrob_id as id_hrob_reg, registration.id as id_kupujuceho
        FROM cintorin, registration
        where cintorin.id = registration.hrob_id";
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
    if($date30->getTimestamp() >  strtotime($row['zaplateneDo']) ){
        echo "ide IF";
        
        if(mail($row['email'], $subject,$message, $headers)){
            echo" ide";
        }
        else{ echo "nejde";}
        
    }
    $info[$i]['zaplateneDo'] = $row['zaplateneDo'];
    $info[$i]['id_hrob_cint'] = $row['id_hrob_cint'];
    $info[$i]['meno'] = $row['meno'];
    $info[$i]['priezvisko'] = $row['priezvisko'];
    $info[$i]['email'] = $row['email'];
    $info[$i]['id_hrob_reg'] = $row['id_hrob_reg'];
    $info[$i]['id_kupujuceho'] = $row['id_kupujuceho'];
    $i++;
  }

  //echo json_encode($info);
}
else
{
  http_response_code(404);
}

//echo $tomorrow = date("Y-m-d", time() + 2592000);
*/
?>