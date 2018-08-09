
<?
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$products = json_decode($_POST['products']);

print("test\r\n");

if (mail("valeraerohin97@mail.ru", "заголовок", "Имя $name . Телефон $phone . Почта $email Адрес $address . ZIP $zip . Products $products"))
      print("Отправлено\r\n");
else
      print("Не отправлено\r\n");

?>
