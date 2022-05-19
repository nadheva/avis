<?php

namespace App\Controllers;
use App\Models\ProjectModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

class Home extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $db, $builder;
    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->db      = \Config\Database::connect();
    }
	public function index()
	{
		return view('welcome_message');
	}
	
	public function profile()
	{
		$data['tittle'] = "Profile";
 		return view('dashboard/profile', $data);
	}

	public function test()
	{
		$mail = new PHPMailer(true);
        // dd($mail);
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
            $mail->SMTPDebug = 3;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
            $mail->Host       = 'smtp.component.astra.co.id';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'avis-bot@astra-visteon.com';
            $mail->Password   = 'Avi123!';
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAutoTLS = false;
            $mail->Port       = 587;
            $mail->From = "no-reply@astra-visteon.com";
			$mail->FromName = "No-Reply Avis";
			$mail->addAddress("reza.andriady@astra-visteon.com", "reza.andriady@astra-visteon.com");
			$mail->isHTML(true);

			// Content
			$mail->isHTML(true);
			$mail->Subject = 'New Task from AVIS';
            $body = "";
            $body .= "Dear<br><br>";
			$body .= "You have new task, waiting for your action to close the task.<br>";
            $body .= "Here is a brief information regarding the new task.<br><br>";
			$body .= "Please go to AVIS application and close your task<br>";
			$body .= "or <a href=".base_url('/user/dashboard').">click this link</a><br><br><br>";
            $body .= "Regards,<br><br>";
            $body .= "AVIS Mail Bot";
			$mail->Body = $body;

			$mail->send();
		} catch (Exception $e) {
		}
	}
}
