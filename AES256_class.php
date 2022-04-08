<?php
/*
The MIT License (MIT)
Copyright (c) 2015 Jan Knipper <j.knipper@part.berlin>
Copyright (c) 2021 CS-Digital UG <info  @cs  -  digital-   ug . ~~ de >
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
SOURCE: https://github.com/dmd2222/php-AES256-class.git
   */




//Testscript
/*
require_once("AES256_class.php");

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


*/


class AES256{


    //public functions
   public static  function encrypt($text_string,$number_loops_int=1,$encryption_key ='0123456789'){
    
        $encryption_iv=NULL;
        $encryption =$text_string;

        for($i = 0; $i < $number_loops_int; ++$i) {
            

        $encryption_iv[$i] = self::random_bytes(16);

        // Encryption of string process starts
        $encryption = openssl_encrypt($encryption, 'AES-256-CBC',
        $encryption_key,0, $encryption_iv[$i]);

        

        }



        //check encrypted to decrypt
        $test_decypt=self::decrypt($encryption,$number_loops_int,$encryption_key,$encryption_iv);
        if($test_decypt<>$text_string){
            throw new exception("AES256_class.php: encrypt: recheck encryption fail");
        }

        //delete all vars
        unset($text_string);
        unset($encryption_key);
        unset($number_loops_int);

        //return result
        return array($encryption,$encryption_iv);

}




public static function decrypt($encrypted_text_string,$number_loops_int=1,$encryption_key = '0123456789',$encryption_iv){


$decryption = $encrypted_text_string;

for($i = 0; $i < $number_loops_int; ++$i) {

// Encryption of string process starts
$decryption = openssl_decrypt($decryption, 'AES-256-CBC',
$encryption_key,0, $encryption_iv[$number_loops_int-$i-1]);

}

return  $decryption;
}


public static function generate_random_string( $option, $length ){
    $permitted_chars="";
    switch ($option) {
        case 0:
            $permitted_chars = '0123456789';
            break;
        case 1:
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            break;
        case 2:
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 3:
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"§$%&/()=?*+#<>';
            break;
        case 4:
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"§$%&/()=?*+#<>äüöÄÜÖ';
            break;
        default:
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    }
    //generated string
    return  substr(str_shuffle($permitted_chars), 0, $length);
}






 //private function
    private function __construct()
    {
        //prevents creating object of class.
    }


    
private static function random_bytes($length = 6)
{
    $characters = '0123456789';
    $characters_length = strlen($characters);
    $output = '';
    for ($i = 0; $i < $length; $i++)
        $output .= $characters[rand(0, $characters_length - 1)];

    return $output;
}




}




?>
