<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class email
{
    private $hostName;
    private $userName;
    private $password;
    private $emailFrom;
    private $emailFromName;

    function __construct($hostName,$userName, $password, $emailFrom,$emailFromName){

        $this->hostName       = $hostName;
        $this->userName       = $userName;
        $this->password       = $password;
        $this->emailFrom      = $emailFrom;
        $this->emailFromName  = $emailFromName;
    }

    public function sendEmail($subject,$htmlBody = '',$emailTo = "",$emailToName = ""){
        //Load Composer's autoloader
        require_once '../sdk/phpMailer/autoload.php';

        if($emailTo == "" || $emailToName == "")
            return "Email to can't be empty";

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->Host       = $this->hostName;                        //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->isSMTP();                                            //Send using SMTP
            $mail->SMTPSecure = 'ssl';
            $mail->Username   = $this->userName;                        //SMTP username
            $mail->Password   = $this->password;                        //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($this->emailFrom,$this->emailFromName);
            $mail->addAddress($emailTo, $emailToName);

            // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            throw new Exception("Email Error : {$mail->ErrorInfo}");
        }
    }
}
