<?php 

// Veritabanı bağlantısı
$servername = "localhost";
$usernames = "root";
$password = "";
$database = "computerbank"; // Veritabanı adı

$conn = mysqli_connect($servername, $usernames, $password, $database);

// Bağlantı hatası kontrolü
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}


$dbh = new PDO('mysql:host=localhost;dbname=computerbank', 'root', '');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>


