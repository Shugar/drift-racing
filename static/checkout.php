
<?
$requestPayload = json_decode(file_get_contents('php://input'), true);

$name = $requestPayload['name'];
$phone = $requestPayload['phone'];
$email = $requestPayload['email'];
$address = $requestPayload['address'];
$zip = $requestPayload['zip'];
$products = json_decode($requestPayload['products']);

// $productListing = return "${listing}\n{$product['title']}: {$product['price']}";
// $requestPayload['products']
$data = '';
foreach ($products as $key => $value){
      $data .= $key.'-------'.$value;
      $data .= "\n";
}

if (mail("sasu11@yandex.ru", "заголовок", "Имя: ".$name."\r\nТелефон: ".$phone."\r\nПочта: ".$email."\r\nАдрес: ".$address."\r\nZIP: ".$zip."\r\nProduct Listing: ".$data))
      echo "Сообщение успешно отправлено";
else
      print("Не отправлено\r\n");

?>
