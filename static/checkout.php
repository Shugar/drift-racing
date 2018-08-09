
<?
$requestPayload = json_decode(file_get_contents('php://input'), true);

$name = $requestPayload['name'];
$phone = $requestPayload['phone'];
$email = $requestPayload['email'];
$address = $requestPayload['address'];
$zip = $requestPayload['zip'];
$products = $requestPayload['products'];

$test = "Ваш заказ: ";

// $getProducts = function($arr) {
  
// }

foreach($product as $products) {
 $test .= $product['title'] . " \r\n " . $product['price'];
}

if (mail("valeraerohin97@mail.ru", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n $test"))
      echo $products;
else
      print("Не отправлено\r\n");

?>
