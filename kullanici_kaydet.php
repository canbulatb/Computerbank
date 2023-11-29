<?php
include 'function/baglan.php';
$kullaniciSec=NULL;
// POST verilerini al
$username = $_POST["username"];
$yetki = $_POST["yetki"];
$password = $_POST["password"];
$kullaniciSec=$_POST["kullaniciSec"];

if ($yetki==5)
{ $isAdmin="1";
} else {
    $isAdmin="0";
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// Veritabanına ekleme sorgusu
$sql = "INSERT INTO users (username, password, isAdmin, yetki, kim_gorebilir) 
        VALUES (:username, :hashed_password, :isAdmin, :yetki, :kullaniciSec)";
    
try {

    $sth = $dbh->prepare($sql);
    // Bind parameters to statement variables.
    $sth->bindParam(':username', $username, PDO::PARAM_STR);
    $sth->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
    $sth->bindParam(':isAdmin', $isAdmin);
    $sth->bindParam(':yetki', $yetki, PDO::PARAM_STR);
    $sth->bindParam(':kullaniciSec', $kullaniciSec, PDO::PARAM_INT);
    // Execute statement.
    $sth->execute();
    echo $taal_veriler_kaydedildi;

} catch (PDOException $e) {
    die($e->getMessage());
    echo $taal_veriler_kaydedilemedi;
    
}
$dbh = null;





// Veritabanı bağlantısını kapat
mysqli_close($conn);
header('Location: kullaniciMenu.php');
?>
