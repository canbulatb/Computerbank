<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'function/dilSecimi.php';
echo '
    <form action="kaydet.php" method="post">
    <form action="guncelle.php" method="post">
        <div class="form-group row">
                <label for="datum_aanname" class="col-sm-4 col-form-label">'.$taal_kabul_tarihi.':</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="datum_aanname" name="datum_aanname" value="">
            </div> 
        </div>
        <div class="form-group row">
            <label for="aangenomen_door" class="col-sm-4 col-form-label">'.$taal_kabul_eden_kisi.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="aangenomen_door" name="aangenomen_door" value="'.$username.'" Readonly> 
            </div>
        </div>

        <div class="form-group row">
            <label for="naam_klant" class="col-sm-4 col-form-label">'.$taal_musteri_adi.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="naam_klant" value="">
            </div>
        </div>

        <div class="form-group row">
            <label for="telefoonnummer_klant" class="col-sm-4 col-form-label">'.$taal_musteri_telefon_numarasi.'</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="telefoonnummer_klant" value="">
            </div>
        </div>
        <div class="form-group row">
            <label  for="email_klant" class="col-sm-4 col-form-label">'.$taal_musteri_eposta_adresi.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="email_klant" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="kenmerk_computer"  class="col-sm-4 col-form-label">'.$taal_bilgisayarin_ozellikleri.':</label>
            <div class="col-sm-8">
                <textarea name="kenmerk_computer" class="form-control"></textarea>
            </div>
        </div>
      
        <div class="form-group row">
            <label for="opbergplaats_computer" class="col-sm-4 col-form-label">'.$taal_depolama_konumu.':</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="opbergplaats_computer" value="">
            </div>
        </div>

        <div class="form-group row">
            <label  for="opmerking" class="col-sm-4 col-form-label">'.$taal_not.':</label>
            <div class="col-sm-8">
                <textarea class="form-control" name="opmerking"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="omschrijving_probleem" class="col-sm-4 col-form-label">'.$taal_sorun_aciklamasi.':</label>
            <div class="col-sm-8">
                <textarea class="form-control" name="omschrijving_probleem"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="wie_repareren" class="col-sm-4 col-form-label">'.$taal_kim_tamir_edecek.':</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="wie_repareren" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="kost" class="col-sm-4 col-form-label">'.$taal_maliyet.':</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="kost" value="">
            </div>
            <div class="col-sm-4">
                <select class="form-control" name="kost_b">
                    <option value="Euro" SELECTED>Euro</option>
                    <option value="Dolar">Dolar</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="resultaten" class="col-sm-4 col-form-label">'.$taal_sonuc.':</label>
            <div class="col-sm-8">
                <select name="resultaten" class="form-control">
                    <option value="0" SELECTED">'.$taal_devam_ediyor.'</option>
                    <option value="1">'.$taal_kapali_kayit.'</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary form-control" value="'.$taal_kaydet.'">
        </div>
        <input type="hidden" name="id" value="">
    </form>';
    ?>