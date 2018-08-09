
<?
$requestPayload = json_decode(file_get_contents('php://input'), true);

$name = $requestPayload['name'];
$phone = $requestPayload['phone'];
$email = $requestPayload['email'];
$address = $requestPayload['address'];
$zip = $requestPayload['zip'];
$products = $requestPayload['products'];

// $getProducts = function($arr) {
//   foreach($arr as $product) {
//     print($product['title'] . " \r\n " . $product['price'] . " \r\n ");
//   }
// }

// $string = $getProducts($products)

$productListing = array_reduce($requestPayload['products'], function($listing, $product) {
  return "${listing}\n{$product['title']}: {$product['price']}";
}, "Ваш заказ: ");

if (mail("valeraerohin97@mail.ru", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n Product Listing $productListing"))
      echo is_string($productListing);
else
      print("Не отправлено\r\n");

?>
