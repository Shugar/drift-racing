<?
$_request = json_decode(file_get_contents('php://input'), true);

list(
  $name,
  $email,
  $address,
  $zip,
  $phone,
  $products
) = array_values($_request);

$body = "<h2>Контактные данные</h2>
         <p><b>Имя</b> {$name} </p>
         <p><b>Телефон</b>: {$phone}</p>
         <p><b>Почта</b>: {$email}</p>
         <p><b>Адрес</b>: {$address}</p>
         <p><b>Индекс</b>: {$zip}</p>
         <br/><br/><hr/>";

$_products = json_decode($products, true);
if(count($_products))
      $body .= "<h2>Информация о товарах</h2>";
      
foreach ($_products as $i => $product) {
      list($type, $loc, $title, $gender, $category, $style, $price) = array_values($product);
      $pos = $i + 1;
      $body .= "<p><b>Позиция</b>: #{$pos}</p>";
      $body .= "<p><b>Название</b>: {$title}</p>";
      $body .= "<p><b>Цена</b>: {$price}</p>";
}

$timestamp = date("d.m.Y H:i:s", strtotime("now"));
$to = "sasu11@yandex.ru";
$subject = "Новая заявка из магазина от {$timestamp}";
$headers = "From: noreply@alexdracing.com\r\n";
$headers .= "Reply-To: noreply@alexdracing.com\r\n";
$headers .= "CC: one.more.1@yandex.ru\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";


if (mail($to, $subject, $body, $headers))
      echo json_encode(["response" => "ok"]);
else
      echo json_encode(["response" => "error"]);

exit;

?>