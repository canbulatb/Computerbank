<?php 

// Oturumu başlat
session_start();
// Oturum değişkenlerini kullanma
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $username = $_SESSION["username"];
    $isAdmin = $_SESSION["isAdmin"];
    $yetki = $_SESSION["yetki"];
    $user_id = $_SESSION["user_id"];
    if ($yetki==9){$yetkiAdi="Admin";} elseif(($yetki==5)){$yetkiAdi="Kullanıcı";}
} else {
    echo "Lütfen giriş yapın.";
    header("location:index.php");
}
?>