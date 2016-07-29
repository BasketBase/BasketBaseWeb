<?php
	require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

	$transport = Swift_MailTransport::newInstance();

	$mailer = Swift_Mailer::newInstance($transport);

	// Create the message
	$message = Swift_Message::newInstance()

		// Give the message a subject
		->setSubject('Bienvenido')

		->setFrom('soporte@basketbaseweb.com', 'Basket Base')

		->setTo('hermidamourelle@gmail.com')

		// Give it a body
		->setBody(
			'<html>' .
				'<head>'.
				'<title>Basket Base</title>'.
				'</head>'.
				'<body>'.
					'<div>'.
						'Gracias por registraste en la comunidad de Basket Base.'.
						'<br/><br/>'.
						'Puedes iniciar sesión en el siguiente enlace: <a href="http://basketbaseweb.com/pages/login.php">Inicia Sesión</a>'.
						'<br/><br/>'.
						'Tu nick es: '.$_POST["nick"].
					'</div>'.
				'</body>'.
			'</html>',
		'text/html' // Mark the content-type as HTML
);
	;

	// Send the message
	$mailer->send($message);
?>