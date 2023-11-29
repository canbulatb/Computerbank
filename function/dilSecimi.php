<?php
$cb_taal_secim="Nl";
$cookie_name = "CBTaal";
if(isset($_COOKIE[$cookie_name])) {
    include "$_COOKIE[$cookie_name].php";
    $cb_taal_secim=$_COOKIE[$cookie_name];

} else {
    include "Nl.php";
}





?>