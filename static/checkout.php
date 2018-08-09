
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
//   foreach($arr as $product) {
//     print($product['title'] . " \r\n " . $product['price'] . " \r\n ");
//   }
// }

// $string = $getProducts($products)

if (mail("valeraerohin97@mail.ru", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n"))
      echo typeof($products);
else
      print("Не отправлено\r\n");

?>
