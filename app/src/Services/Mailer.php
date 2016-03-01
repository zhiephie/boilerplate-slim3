<?php
namespace App\Services;

class Mailer {

  private $mail;
  protected $sender_email = "";
  protected $sender_password = "";

  protected $sender_display_name = "";
  protected $sender_display_email = "";
  protected $sender_reply_to_name = "";
  protected $sender_reply_to_email = "";

  public function __construct() {
		date_default_timezone_set('Asia/Jakarta');
		//Create a new PHPMailer instance
		$this->mail = new \PHPMailer;
		//Tell PHPMailer to use SMTP
		$this->mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$this->mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$this->mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$this->mail->Host = 'ssl://smtp.gmail.com';
		// use
		// $this->mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$this->mail->Port = 465;
		//Set the encryption system to use - ssl (deprecated) or tls
		// $this->mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$this->mail->SMTPAuth = true;

		$this->setSender(
		  $this->sender_email, 
		  $this->sender_password, 
		  $this->sender_display_name, 
		  $this->sender_display_email, 
		  $this->sender_reply_to_name, 
		  $this->sender_reply_to_email
		);
  }

  public function setSender($email, $password, $display_name, $display_email, $reply_name, $reply_email){
    //Username to use for SMTP authentication - use full email address for gmail
    $this->mail->Username = $email;
    //Password to use for SMTP authentication
    $this->mail->Password = $password;
    //Set who the message is to be sent from
    $this->mail->setFrom($display_email, $display_name);
    //Set an alternative reply-to address
    $this->mail->addReplyTo($reply_email, $reply_name);
  }

  public function sendEmail($to_email, $to_name, $subject, $message, $template_name='')
  {
    //Set who the message is to be sent to
    $this->mail->addAddress($to_email, $to_name);
    //Set the subject line
    $this->mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $this->mail->msgHTML(file_get_contents($template_name));
    //Replace the plain text body with one created manually
    $this->mail->AltBody = $message;
    //send the message, check for errors
    if (!$this->mail->send()) {
        echo "Mailer Error: " . $this->mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }
  }
 
}