
<?
$_POST = json_decode(file_get_contents('php://input'), true);

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$products = $_POST['products'];

$test = "Ваш заказ: "; 

foreach($products as $product) {
 $test .= $product['title'] . " \r\n " . $product['price'];
}

if (mail("valeraerohin97@mail.ru", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n $test"))
      echo $products;
else
      print("Не отправлено\r\n");

?>
