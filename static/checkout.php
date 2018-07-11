<?php
// Файлы phpmailer
require 'class.phpmailer.php';
require 'class.smtp.php';
// Переменные
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$zip = $_POST['zip'];

// Настройки
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.yandex.ru';
$mail->SMTPAuth = true;
$mail->Username = 'alexdracing'; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
$mail->Password = 'racing'; // Ваш пароль
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('alexdracing@yandex.ru'); // Ваш Email
$mail->addAddress('shugar348@gmail.com'); // Email получателя

// Письмо
$mail->isHTML(true);
$mail->Subject = "Заголовок"; // Заголовок письма
$mail->Body = "Имя $name . Телефон $phone . Почта $email Адрес $address . ZIP $zip ."; // Текст письма

// Результат
if(!$mail->send()) {
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  echo 'ok';
}
?>