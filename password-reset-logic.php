<?php

 // Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'dbconfig/config.php';
$email = $_POST["email"];

 if(isset($_POST["email"])){
   // $email = $_GET["email"];
   
$email = mysqli_real_escape_string($con, $_POST['email']);

if (!empty($email)){
    
  // ensure that the user exists on our system
// $query = "SELECT email FROM reg WHERE email='$email'";
// $results = mysqli_query($con, $query);
//.................................................................................................... 
$sql = "SELECT email FROM reg WHERE email=?"; // SQL with parameters
$stmt = $con->prepare($sql); 
$stmt->bind_param('s',$email);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$user = $result->fetch_assoc(); // fetch data   

}

$token = bin2hex(random_bytes(10));
$query = "INSERT INTO reset_table(email, token) VALUES (?,?)";
$stmt = $con->prepare($query); 
$stmt->bind_param('ss',$email,$token);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result



}
 

if(!$query){
    exit ;
}
// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                     // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host        = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('tonyrace96@gmail.com', 'nepserv');
    $mail->addAddress("$email");     // Add a recipient
                
    $mail->addReplyTo('ahebwaantonie@gmail.com', 'Information');
    
    

   

    // Content
    $url="http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/create-new-passwd.php?token=".$token;
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your password reset link';
    $mail->Body    = "<h1>we have received your request </h1>click <a href='$url'>the link</a> to proceed $token ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}




