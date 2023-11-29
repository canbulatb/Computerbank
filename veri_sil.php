<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';

// AJAX isteği ile gönderilen 'id' parametresini alın
$id = $_POST['id'];

// Verileri veritabanından almak için sorgu oluşturun
$sql = "UPDATE reparatie SET sil=1 WHERE id =  '$id' ";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);

?>
