<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';


// POST verilerini al
$datum_aanname = $_POST["datum_aanname"];
$aangenomen_door = $_POST["aangenomen_door"];
$naam_klant = $_POST["naam_klant"];
$telefoonnummer_klant = $_POST["telefoonnummer_klant"];
$email_klant = $_POST["email_klant"];
$kenmerk_computer = $_POST["kenmerk_computer"];
$opbergplaats_computer = $_POST["opbergplaats_computer"];
$opmerking = $_POST["opmerking"];
$omschrijving_probleem = $_POST["omschrijving_probleem"];
$wie_repareren = $_POST["wie_repareren"];
$kost = $_POST["kost"];
$kost_b = $_POST["kost_b"];
$resultaten = $_POST["resultaten"];
$id=$_POST["id"];





// Veritabanına ekleme sorgusu
$sql = "UPDATE reparatie 
        SET 
            datum_aanname = :datum_aanname,
            aangenomen_door = :aangenomen_door,
            naam_klant = :naam_klant,
            telefoonnummer_klant = :telefoonnummer_klant,
            email_klant = :email_klant,
            kenmerk_computer = :kenmerk_computer,
            opbergplaats_computer = :opbergplaats_computer,
            opmerking = :opmerking,
            omschrijving_probleem = :omschrijving_probleem,
            wie_repareren = :wie_repareren,
            kost = :kost,
            kost_b = :kost_b,
            resultaten= :resultaten
        WHERE id = :id";

try {
    $sth = $dbh->prepare($sql);
    // Bind parameters to statement variables.
    $sth->bindParam(':datum_aanname', $datum_aanname, PDO::PARAM_STR);
    $sth->bindParam(':aangenomen_door', $aangenomen_door, PDO::PARAM_STR);
    $sth->bindParam(':naam_klant', $naam_klant, PDO::PARAM_STR);
    $sth->bindParam(':telefoonnummer_klant', $telefoonnummer_klant, PDO::PARAM_STR);
    $sth->bindParam(':email_klant', $email_klant, PDO::PARAM_STR);
    $sth->bindParam(':kenmerk_computer', $kenmerk_computer, PDO::PARAM_STR);
    $sth->bindParam(':opbergplaats_computer', $opbergplaats_computer, PDO::PARAM_STR);
    $sth->bindParam(':opmerking', $opmerking, PDO::PARAM_STR);
    $sth->bindParam(':omschrijving_probleem', $omschrijving_probleem, PDO::PARAM_STR);
    $sth->bindParam(':wie_repareren', $wie_repareren, PDO::PARAM_STR);
    $sth->bindParam(':kost', $kost, PDO::PARAM_INT);
    $sth->bindParam(':kost_b', $kost_b, PDO::PARAM_STR);
    $sth->bindParam(':resultaten', $resultaten);
    $sth->bindParam(':id', $id);
    $sth->execute();
    echo $taal_veriler_kaydedildi;
} catch (PDOException $e) {
    die($e->getMessage());
    echo $taal_veriler_kaydedilemedi;
}

$dbh = null;

#if (mysqli_query($conn, $sql)) {
#    echo "Kaydedildi";
#} else {
#    echo  "Sorun oluştu" . mysqli_error($conn);
#}

// Veritabanı bağlantısını kapat
//mysqli_close($conn);
#header('Location: welcome.php');
?>
