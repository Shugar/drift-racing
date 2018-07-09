<?php
$to = "dzhafarov.ruslan@yandex.ru"; // адрес куда отправлять письмо
$subject = "Отправка формы с сайта"; // заголовок письма

$_POST = json_decode(file_get_contents('php://input'), true);

  foreach($_POST.contacts as $key => $value)
  { $contact .= $key.": ".$value." \r\n"; }
  foreach($_POST.products as $key => $value)
  { $product .= $key.": ".$value." \r\n"; }
  $message = $subject." \r\n".$contacts" \r\n".$product;
  $headers  = "Content-type:  text/plain; charset=utf-8 \r\n";

  mail($to, $subject, $message, $headers);
?>