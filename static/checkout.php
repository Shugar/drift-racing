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
$products = $_POST['products'];

foreach($products as $product) {

 echo $product;

}

// Настройки
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.yandex.ru';
$mail->SMTPAuth = true;
$mail->Username = 'alexdracing'; // Ваш логин в Яндексе. Именно логин, без @yandex.ru
$mail->Password = 'racing'; // Ваш пароль
$mail->SMTPSecure = 'ssl';
$mail->Port = 587;
$mail->setFrom('alexdracing@yandex.ru'); // Ваш Email
$mail->addAddress('valeraerohin97@mail.ru'); // Email получателя

// Письмо
$mail->isHTML(true);
$mail->Subject = "Заголовок"; // Заголовок письма
$mail->Body = "Имя $name . Телефон $phone . Почта $email Адрес $address . ZIP $zip . products $products ."; // Текст письма

// Результат
if(!$mail->send()) {
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  echo 'ok';
}
?>