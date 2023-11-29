<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'function/dilSecimi.php';
// POST verilerini al

$username = $_POST["username"];
$yetki = $_POST["yetki"];
$password = $_POST["password"];
$id=$_POST["id"];
$kullaniciSec=$_POST["kullaniciSec"];
$hashed_password  = password_hash($password, PASSWORD_DEFAULT);
$sql = "UPDATE users SET yetki=:yetki, kim_gorebilir=:kullaniciSec ";
echo $kullaniciSec;

if ($password!='') $sql=$sql . ", password = :hashed_password WHERE id = :id"; else $sql=$sql ." WHERE id = :id";
// Veritabanına ekleme sorgusu
#$sql = "UPDATE users SET yetki='$yetki', password = '$hashed_password' WHERE id = '$id'";


try {
    $sth = $dbh->prepare($sql);
    // Bind parameters to statement variables.
    $sth->bindParam(':yetki', $yetki, PDO::PARAM_STR);
    if ($password!='') $sth->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
    $sth->bindParam(':id', $id);
    $sth->bindParam(':kullaniciSec', $kullaniciSec, PDO::PARAM_INT);

    $sth->execute();
    echo $taal_veriler_kaydedildi;
} catch (PDOException $e) {
    die($e->getMessage());
    echo $taal_veriler_kaydedilemedi;
}


$dbh = null;


header('Location: kullaniciMenu.php');
?>
