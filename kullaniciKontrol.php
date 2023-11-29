<?php
include 'function/baglan.php';

// Kullanıcı adını POST isteğiyle alın
$kullaniciAdi = $_POST["username"];

// Veritabanında bu kullanıcı adının mevcut olup olmadığını kontrol edin
$sql = "SELECT id FROM users WHERE username = :kullaniciAdi";
try {
    $sth = $dbh->prepare($sql);
    // Bind parameters to statement variables.
    $sth->bindParam(':kullaniciAdi', $kullaniciAdi, PDO::PARAM_STR);
    $sth->execute();
    $say = $sth->fetchColumn();
} catch (PDOException $e) {
  
}


if ($say > 0) {
    echo "var"; // Kullanıcı adı mevcut
} else {
    echo "yok"; // Kullanıcı adı mevcut değil
}

// Veritabanı bağlantısını kapatın
$dbh = null;
?>
