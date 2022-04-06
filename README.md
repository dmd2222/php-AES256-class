# php-AES256-class
php AES256 class



//Testscript<br/>
<code>  <br/>
$loops=10;  <br/>
$encryption_key=AES256::generate_random_string(4,16);  <br/>
$text_string="Test text 123" ;  <br/>
echo $text_string . "<br>";  <br/>
$a =AES256::encrypt($text_string,$loops,$encryption_key);  <br/>
echo "<br>Transmitting: Length: " . strlen($text_string) . " =>" . strlen($a[0]) . "<br>";  <br/>
var_dump($a) ;  <br/>
echo "<br>";  <br/>
echo "<br>";  <br/>
$b = AES256::decrypt($a[0],$loops,$encryption_key,$a[1]);  <br/>
echo $b . "<br>";  <br/>
<code>  <br/>
