<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'function/dilSecimi.php';


 $sDate = $_POST['sDate']; 
 $eDate = $_POST['eDate'];
 $anahtar = $_POST['anahtar'];
 $sonuc = $_POST['sonuc'];
 $kullaniciSecim = $_POST['kullaniciSecim'];
 $kullaniciSQL='AND aangenomen_door=:username';
 if ($yetki==9 and $eDate!="") {
    $kullaniciSQL="";
    if ($kullaniciSecim!="hepsi"){
        $kullaniciSQL='AND (aangenomen_door=:username' ;
    }
}else{$kullaniciSecim=$username;} #Burada admin değilse kullanıcıSecim kendi kullanıcı adına eşitleniyor.



$sql="SELECT  reparatie.*, reparatie.id AS reparatie_ID, users.id AS users_ID FROM reparatie JOIN users ON reparatie.user_id = users.id WHERE resultaten=0  AND reparatie.sil=0 AND (reparatie.user_id=:user_id OR users.kim_gorebilir=:user_id)"; #iki tabloyu birleştirdik.


$sth = $dbh->prepare($sql);
$sth->bindParam(':user_id', $user_id, PDO::PARAM_STR);
// Execute statement.
$colCount=0;
$sonuclar=[];
try {
$sth->execute();
$sonuclar = $sth->fetchAll(PDO::FETCH_ASSOC);
$colCount = $sth->rowCount();
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}


// Verileri tabloya eklemek için döngü
if ($colCount > 0) {
    echo '<div class="mt-4">';
    #echo '<h3>Veritabanından Çekilen Liste</h3>';
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Datum Aanname</th>';
    echo '<th>Aangenomen Door</th>';
    echo '<th>Naam klant</th>';
    if ($yetki==9) echo "<th>$taal_sil</th>";
    // Diğer verileri burada ekleyebilirsiniz
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($sonuclar as $row) { 
        // data-id ekleyerek her satıra bir özel kimlik atayın
        echo '<tr data-id="' . $row['reparatie_ID'] . '">';
        echo '<td>' . date("d.m.Y", strtotime($row['datum_aanname'])) . '</td>';
        echo '<td>' . $row['aangenomen_door'] . '</td>';
        echo '<td>' . $row['naam_klant'] . '</td>';

    if ($yetki==9) echo '<td> <button type="button" data-id="' . $row['id'] .'" class="btn btn-primary silButton" >'.$taal_sil.'</button> </td>';

        // Diğer verileri burada ekleyebilirsiniz
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo $taal_veri_bulunamadi;
}
// Veritabanı bağlantısını kapat
$dbh = null;
mysqli_close($conn);
?>


