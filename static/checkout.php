
<?
$_POST = json_decode(file_get_contents('php://input'), true);

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$products = $_POST['products'];

$test = "";

foreach($products as $product) {
 $test = $product;
}

if (mail("valeraerohin97@mail.ru", "заголовок", "Имя $name \r\n Телефон $phone \r\n Почта $email \r\n Адрес $address \r\n ZIP $zip \r\n Ваш заказ $product"))
      echo $products;
else
      print("Не отправлено\r\n");

?>
