<?php
class EmailController extends ControllerBase
{
    public function sendEmailAction($toAddress, $subject, $body)
	{
		$transport = new Swift_SmtpTransport('smtp.gmail.com',587,'tls');
		$transport->setUsername('stormwave619@gmail.com');
		$transport->setPassword('Jb56105230');
		$transport->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));
		$mailer = new Swift_Mailer($transport);
		$message = new Swift_Message($subject);
		$message->setFrom(['stormwave619@gmail.com' => 'Javier Benitez']);
		$message->setTo([$toAddress, $toAddress => $toAddress]);
		$message->setBody($body);
		$result = $mailer->send($message);
		if ($result>0) {
			$this->flash->notice("Email Enviado");
			$this->dispatcher->forward(["controller" => "mantenimientos","action" => "search"]);
		}
		else {
			$this->flash->notice("Email No Enviado");
			$this->dispatcher->forward(["controller" => "mantenimientos","action" => "search"]);
		}
		$this->dispatcher->forward(["controller" => "mantenimientos","action" => "search"]);
	}

	public function testMailAction()
	{
		$this->sendEmailAction('jaxzandr@hotmail.com','Nuevo Mantenimiento',
			
		'Saludos Cordiales, 

		 Se ha enviado una notificacion por un nuevo Mantenimiento.



			');
	}
}
?>