<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'function/dilSecimi.php';

// AJAX isteği ile gönderilen 'id' parametresini alın
$id = $_POST['id'];

// Verileri veritabanından almak için sorgu oluşturun
$sql = "SELECT * FROM reparatie WHERE id = $id and sil=0";
$result = mysqli_query($conn, $sql);

// Verileri dizi olarak alın
$data = mysqli_fetch_assoc($result);
echo '
    <form onsubmit="return false">
        <div class="form-group row">
                <label for="datum_aanname" class="col-sm-4 col-form-label">'.$taal_kabul_tarihi.':</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="datum_aanname" name="datum_aanname" value="'. $data['datum_aanname'].'">
            </div> 
        </div>
        <div class="form-group row">
            <label for="aangenomen_door" class="col-sm-4 col-form-label">'.$taal_kabul_eden_kisi.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="aangenomen_door" name="aangenomen_door" value="'.$data['aangenomen_door'].'" Readonly> 
            </div>
        </div>

        <div class="form-group row">
            <label for="naam_klant" class="col-sm-4 col-form-label">'.$taal_musteri_adi.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="naam_klant" id="naam_klant" value="'.$data['naam_klant'].'">
            </div>
        </div>

        <div class="form-group row">
            <label for="telefoonnummer_klant" class="col-sm-4 col-form-label">'.$taal_musteri_telefon_numarasi.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="telefoonnummer_klant" id="telefoonnummer_klant" value="'. $data['telefoonnummer_klant'].'">
            </div>
        </div>
        <div class="form-group row">
            <label  for="email_klant" class="col-sm-4 col-form-label">'.$taal_musteri_eposta_adresi.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="email_klant" id="email_klant" value="'.$data['email_klant'].'">
            </div>
        </div>
        <div class="form-group row">
            <label for="kenmerk_computer"  class="col-sm-4 col-form-label" >'.$taal_bilgisayarin_ozellikleri.':</label>
            <div class="col-sm-8">
                <textarea name="kenmerk_computer" id="kenmerk_computer" class="form-control">'.$data['kenmerk_computer'].'</textarea>
            </div>
        </div>
      
        <div class="form-group row">
            <label for="opbergplaats_computer" class="col-sm-4 col-form-label">'.$taal_depolama_konumu.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="opbergplaats_computer" id="opbergplaats_computer" value="'. $data['opbergplaats_computer'].'">
            </div>
        </div>

        <div class="form-group row">
            <label  for="opmerking" class="col-sm-4 col-form-label">'.$taal_not.':</label>
            <div class="col-sm-8">
                <textarea class="form-control" name="opmerking" id="opmerking">'. $data['opmerking'].'</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="omschrijving_probleem" class="col-sm-4 col-form-label">'.$taal_sorun_aciklamasi.':</label>
            <div class="col-sm-8">
                <textarea class="form-control" name="omschrijving_probleem" id="omschrijving_probleem">'. $data['omschrijving_probleem'].'</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="wie_repareren" class="col-sm-4 col-form-label">'.$taal_kim_tamir_edecek.':</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="wie_repareren" id="wie_repareren" value="'. $data['wie_repareren'].'">
            </div>
        </div>
        <div class="form-group row">
            <label for="kost" class="col-sm-4 col-form-label">'.$taal_maliyet.':</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="kost" id="kost" value="'. $data['kost'].'">
            </div>
            <div class="col-sm-4">
                <select class="form-control" name="kost_b"  id="kost_b">
                    <option value="Euro"'; if($data['kost_b']=="Euro"){ echo "SELECTED";} echo '>Euro</option>
                    <option value="Dolar"'; if($data['kost_b']=="Dolar"){ echo "SELECTED";} echo'>Dolar</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="resultaten" class="col-sm-4 col-form-label">'.$taal_sonuc.':</label>
            <div class="col-sm-8">
                <select name="resultaten" id="resultaten"  class="form-control">
                    <option value="0"'; if($data['resultaten']=="0"){ echo "SELECTED";} echo '>'.$taal_devam_ediyor.'</option>
                    <option value="1"'; if($data['resultaten']=="1"){ echo "SELECTED";} echo '>'.$taal_kapali_kayit.'</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary form-control formKaydet" id="formKaydet" value="'.$taal_kaydet.'">
        </div>
        <input type="hidden" name="id" id="id" value="'.$id.'">
    </form>';

// Verileri JSON formatında geri döndürün
#echo json_encode($data);

// Veritabanı bağlantısını kapat


mysqli_close($conn);
?>
