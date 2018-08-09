
<?
$_POST = json_decode(file_get_contents('php://input'), true);

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$zip = $_POST['zip'];
$products = json_decode($_POST['products']);

if (mail("valeraerohin97@mail.ru", "заголовок", "$_POST"))
      echo json_encode($_POST);
else
      print("Не отправлено\r\n");

?>
