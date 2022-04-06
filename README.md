# php-AES256-class
php AES256 class



//Testscript
<code>
  $loops=10;
  $encryption_key=AES256::generate_random_string(4,16);
  $text_string="Test text 123" ;
echo $text_string . "<br>";
$a =AES256::encrypt($text_string,$loops,$encryption_key);
echo "<br>Transmitting: Length: " . strlen($text_string) . " =>" . strlen($a[0]) . "<br>";
var_dump($a) ;
echo "<br>";
echo "<br>";
$b = AES256::decrypt($a[0],$loops,$encryption_key,$a[1]);
echo $b . "<br>";
<code>
