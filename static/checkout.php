
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
foreach ($array as $key=>$value){
      $data .= $key.'-------'.$value;
      $data.= "\n";
}

if (mail("shugar348@gmail.com", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n Product Listing $data"))
      echo is_string($data);
else
      print("Не отправлено\r\n");

?>
