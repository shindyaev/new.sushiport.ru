<?php
// SendPulse's PHP Library: https://github.com/sendpulse/sendpulse-rest-api-php
require_once( 'api/sendpulseInterface.php' );
require_once( 'api/sendpulse.php' );

define( 'API_USER_ID', '945a66daaad558fc33726464522d665b' );
define( 'API_SECRET', '97146ab746b3ab84c4c8cbc79c5d5184' );

$SPApiProxy = new SendpulseApi( API_USER_ID, API_SECRET, 'file' );

$pulseMail = $_POST['Email'];
//$pulseMail = 'sss@mail.ru';
$bookId = '602426';

$emails = [];
$emails[] = [
"email" => $pulseMail,
"variables" => [
  "Имя" => "Milimon Delivery"
]
];

//Проверяем адрес email
if(empty($pulseMail)){
	$status = "error";
	$message = "Вы не ввели адрес email!";
}
else if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $pulseMail)){ //validate email address - check if is a valid email address
		$status = "error";
		$message = $pulseMail.": неправильный адрес email!";
}
else {
	$emailVerify = $SPApiProxy->getEmailInfo( $bookId, $pulseMail );
	if ($emailVerify -> email != $pulseMail) {
		$res = $SPApiProxy->addEmails( $bookId, $emails );
		
		if($res -> result){ //если вставка прошла успешно
			$status = "success";
			$message = "Спасибо. Вы подписаны на рассылку!";
		}
		else { //если вставка прошла неудачно
			$status = "error";
			$message = "Ой! Произошла техническая ошибка!";
		}
	}
	else {
		$status = "error";
		$message = "Вы уже подписаны на рассылку!";
	}
}

//возвращаем ответ json
$data = array(
	'status' => $status,
	'message' => $message
);

echo json_encode($data);
exit;