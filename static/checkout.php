
<?
$requestPayload = json_decode(file_get_contents('php://input'), true);

$name = $requestPayload['name'];
$phone = $requestPayload['phone'];
$email = $requestPayload['email'];
$address = $requestPayload['address'];
$zip = $requestPayload['zip'];
$products = $requestPayload['products'];

$productListing = array_reduce($requestPayload['products'], function($listing, $product) {
      return "${listing}\n{$product['title']}: {$product['price']}";
}, "Ваш заказ: ");

if (mail("shugar348@gmail.com", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n Product Listing"))
      echo $products(0);
else
      print("Не отправлен");

?>
