
<?
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$products = json_decode($_POST['products']);

if (mail("valeraerohin97@mail.ru", "заголовок", "Имя $name . Телефон $phone . Почта $email . Адрес $address . ZIP $zip . Products $products ."))
      print("Отправлено\r\n $name . $phone . $email . $address . $_POST .");
else
      print("Не отправлено\r\n");

?>
