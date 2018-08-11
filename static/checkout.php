
<?
$requestPayload = json_decode(file_get_contents('php://input'), true);

$name = $requestPayload['name'];
$phone = $requestPayload['phone'];
$email = $requestPayload['email'];
$address = $requestPayload['address'];
$zip = $requestPayload['zip'];
$products = str_split($requestPayload['products']);

$productListing = "";
// foreach ($products as $key => $value){
//       $productListing .= $products[$key]["title"];
// }

foreach ($products as $value) {
      $productListing = $value;
}

if (mail("sasu11@yandex.ru", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n Product Listing $productListing"))
      echo $productListing;
else
      print("Не отправлен");

?>
