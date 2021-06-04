<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

//require 'path/to/PHPMailer/src/Exception.php';
//require 'path/to/PHPMailer/src/PHPMailer.php';
//require 'path/to/PHPMailer/src/SMTP.php';

require 'database.php';

$postdata = file_get_contents("php://input");

var_dump($postdata);
if(isset($postdata) && !empty($postdata))
{

  $request = json_decode($postdata);
  $id_user = $request->id_user;
  $paidDay =  date("Y-m-d");
  $paidBy = date('Y-m-d', strtotime('+10 year'));

  $sql = "SELECT `name`, `lastname`, `email`, `town`, `street`, `number_house`, `postcode` FROM `users` WHERE `id_user` = $id_user";

  if($result = mysqli_query($con,$sql))
  {

    while($row = mysqli_fetch_assoc($result))
    {
      $reg['name'] = $row['name'];
      $reg['lastname'] = $row['lastname'];
      $reg['email'] = $row['email'];
      $reg['town'] = $row['town'];
      $reg['street'] = $row['street'];
      $reg['number_house'] = $row['number_house'];
      $reg['postcode'] = $row['postcode'];
      $reg['paidDay'] = $paidDay;
      $reg['paidBy'] = $paidBy;

    }
  
    echo json_encode($reg);
  }
  else
  {
    http_response_code(404);
  }

}

require_once __DIR__ . '/vendor/autoload.php';
use mikehaertl\wkhtmlto\Pdf;

$pdf = new pdfGenerator("invoice");
$pdf->prefill($reg);
$file_name = $pdf->savePdf();
//$pdf->downloadPdf();
//$pdf->displayPdf();
echo $file_name;


class pdfGenerator {
    
    private string $file;
    private string $filename;
    private string $dir = "tmp";

    public function __construct($file){
        if (!file_exists($this->dir)) {
            mkdir($this->dir);
        }

        $this->file = file_get_contents($file.".html");
        $this->filename = $file ."_". uniqid() .".pdf"; 
    }

    public function __destruct(){
        $this->deletePdf();
    }

    public function prefill($replace_dict) {
        $place_holders = array();
        $values = array();
        foreach($replace_dict as $key => $val){
            array_push($place_holders, "$$".$key."$$");
            array_push($values, $val);
        }
        $this->file = str_replace($place_holders, $values, $this->file);
    }

    public function savePdf(){
        //uklada lokalne na servery
        $pdf = new Pdf($this->file);
        $pdf->saveAs($this->dir . "/" . $this->filename);
        return $this->dir. "/" . $this->filename;
    }

    public function downloadPdf() {
        $pdf = new Pdf($this->file);
        $pdf->send($this->filename, false, array(
            'Content-Length' => false,
        ));
    }

    public function displayPdf() {
        $pdf = new Pdf($this->file);
        $pdf->send();
    }

    private function deletePdf(){
        $path = $_SERVER['DOCUMENT_ROOT'] ."/". $this->dir . "/" . $this->filename; 
        unlink($path);
        echo $path;
    }
    
} 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);
try {
    var_dump($reg['email']);
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();    
    $mail->Host       = 'smtp.gmail.com';  
    $mail->SMTPAuth   = true;    
    $mail->Username   = 'bakalarka.test@gmail.com';  
    $mail->Password   = 'Bakalarka.test1';     
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587;  

    //Recipients
    $mail->setFrom('lukrecia.szilvasiova13@gmail.com', 'Lukrecka');
    $mail->addAddress($reg['email']);
    //$mail->addAddress('bakalarka.test@gmail.com'); 

    //Attachments
    $mail->addAttachment($file_name); 

    //Content
    $mail->isHTML(true);    
    $mail->Subject = 'Najomná zmluva hroboveho miesta';
    $mail->Body    = 'V prílohe nájdete nájomnú zmluvu';
    $mail->AltBody = 'V prílohe nájdete nájomnú zmluvu ';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>