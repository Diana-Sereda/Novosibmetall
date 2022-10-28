<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'files/phpmailer/src/Exception.php';
require 'files/phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);

//Oт кого письмо
$mail->setFrom('diana_s29@mail.ru','От пользователя с сайта');
//Кому отправить
$mail->addAddress('zakaz@novosibmetall.ru');
//Тема письма
$mail->Subject = 'Заявка с сайта';


//Тело письма
$body = '<h1>Данные пользователя</h1>';

if(trim(!empty($_POST['email']))){
$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
}
if(trim(!empty($_POST['name']))){
$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['tel']))){
$body.='<p><strong>Телефон:</strong> '.$_POST['tel'].'</p>';
}
if(trim(!empty($_POST['message']))){
$body.='<p><strong>Меня интересует:</strong> '.$_POST['message'].'</p>';
}

$mail->Body = $body;

//Отправляем
if (!$mail->send()) {
  $message = 'Ошибка';
} else {
  $message = 'Контактные данные с сайта отправлены успешно!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);

?>