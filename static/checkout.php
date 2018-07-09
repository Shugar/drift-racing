<?php
$to = "dzhafarov.ruslan@yandex.ru"; // адрес куда отправлять письмо
$subject = "Отправка формы с сайта"; // заголовок письма

$_POST = json_decode(file_get_contents('php://input'), true);

  // foreach($_POST as $key => $value)
  // { $contact .= ''; }
  $message = $subject." \r\n"."";
  $headers  = "Content-type:  text/plain; charset3=utf-8 \r\n";

  mail($to, $subject, $message, $headers);
?>