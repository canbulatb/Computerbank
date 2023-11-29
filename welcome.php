<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'genel/header.php';

$cookie_name = "CBDate";
if(isset($_COOKIE[$cookie_name])) {
    $cbDateStart=$_COOKIE[$cookie_name];}
else{
    $cbDateStart="";
}
?>
<!--<div class="toevoegButton" onclick="location.href=&#39;ariza_kayit_giris.php&#39;;">-->
<div class="toevoegButton" onclick="#">
    +
</div>
<div id="arama_ekran">
		<form id="arama_formu" name="arama_formu" method="post" action="" onsubmit="javascript:return false" style="padding:10px;">
        <label for="start_date"><?php echo $taal_baslangic_tarihi?></label>
        <input type="date" id="start_date" name="start_date" value ="<?php echo $cbDateStart?>">
        <label for="end_date"><?php echo $taal_bitis_tarihi?></label>
        <input type="date" id="end_date" name="end_date">

			<label><?php echo $taal_sonuc?></label>
			<select name="sonuc" style="margin-left:20px;padding:4px;height:31px;" id="sonuc">
				<option value="0"> <?php echo $taal_devam_ediyor ?> </option>
				<option value="1"> <?php echo $taal_kapali_kayit ?> </option>
			</select>
			<?php if($yetki==9){ ?>
            <select name="kullaniciSec" style="margin-left:20px;padding:4px;height:31px;" id="kullaniciSec">
            <option value="hepsi"> <?php echo $taal_tum_kullanicilar ?> </option>
            <?php
            // Veritabanından verileri çekme sorgusu
            $sql = "SELECT * FROM users WHERE sil=0";
            $result = mysqli_query($conn, $sql);
            // Verileri tabloya eklemek için döngü
            $i=1;
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
				<option value="<?php echo $row['username'];?>"> <?php echo $row['username']; ?> </option>

                <?php $i=$i+1;}}}?>
			</select>
			<input type="text" name="anahtarKelime" placeholder="<?php echo $taal_anahtar_kelime?>" style="width:150px;" id="anahtarKelime"/>
			<button type="submit" id="ara_buton"><?php echo $taal_ara?></button>
				
		</form>
</div>
        <!-- Sayfanın içeriği (örnek veri) -->
        <div class="mt-4" id="tabloGosterModal">
            <div class="tablo-body">
 
            </div>
            
        </div>
    </div>

    <!-- Bootstrap JS ve jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--<button type="button" class="btn btn-primary" id="aciklamaGoster">Bilgi Göster</button>-->
    
    <!-- Gizli div, tıklanan satırın bilgilerini içerecek -->
    <div id="bilgiGosterModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal içeriği -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $taal_guncelle ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Bilgi içeriği burada gösterilecek -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $taal_kapat?></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Gizli div, tıklanan satırın bilgilerini içerecek -->
    <div id="yeniKayitModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal içeriği -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $taal_yeni_kayit_olusturma ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Bilgi içeriği burada gösterilecek -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $taal_kapat?></button>
                </div>
            </div>
        </div>
    </div>


    <div id="aramaSonucModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal içeriği -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $taal_yeni_kayit_olusturma ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Bilgi içeriği burada gösterilecek -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $taal_kapat?></button>
                </div>
            </div>
        </div>
    </div>




</body>
</html>



<!-- JavaScript ekleyin -->
<script>

window.onload = function () {

    veriGetir("hepsi");
    tr_tikla();
    
  };
var anaSayfadanGeldi=false;
var modaldanGeldi=false;
var aramaTrTiklandi=false;
var secilenID;
//veriGetir("now");

// İlk tarih alanını seçin
var startDateInput = document.getElementById("start_date");

// İlk tarih seçildiğinde çalışacak olay dinleyicisini ekleyin
startDateInput.addEventListener("change", function() {

    // İlk tarihin değerini alın
    var startDateValue = new Date(startDateInput.value);

    // Son tarih alanını seçin
    var endDateInput = document.getElementById("end_date");

    // Son tarih alanının değerini alın
    var endDateValue = new Date(endDateInput.value);
    // Eğer son tarih, ilk tarihten önce bir tarihse, son tarihi sıfırlayın
    if (endDateValue < startDateValue) {
        var changeDate=endDateInput.value;
        endDateInput.value= startDateInput.value;
        startDateInput.value=changeDate;
    }
});


var endDateInput = document.getElementById("end_date");
// İlk tarih seçildiğinde çalışacak olay dinleyicisini ekleyin
endDateInput.addEventListener("change", function() {

// İlk tarihin değerini alın
var endDateValue = new Date(endDateInput.value);

// Son tarih alanını seçin
var startDateInput = document.getElementById("start_date");

// Son tarih alanının değerini alın
var startDateValue = new Date(startDateInput.value);
// Eğer son tarih, ilk tarihten önce bir tarihse, son tarihi sıfırlayın
if (endDateValue < startDateValue) {
    var changeDate=endDateInput.value;
    endDateInput.value= startDateInput.value;
    startDateInput.value=changeDate;
}
});



function tr_tikla(){
$('#aramaSonucModal tr').click(function() {
    $('#aramaSonucModal').modal('hide');
    aramaTrTiklandi=true;
    event.stopPropagation();
    // Tıklanan satırın ID'sini al
    secilenID = $(this).attr('data-id');
    if(secilenID){
    // AJAX ile verileri al
    $.ajax({
        url: 'veri_getir.php',
        type: 'post',
        data: { id: secilenID },
        success: function(response) {
            // Modal içeriğini doldur
            $('#bilgiGosterModal .modal-body').html(response);

            // Modalı aç
            $('#bilgiGosterModal').modal('show');
            form_kaydet_tikla();
        }
    });

}});

$('#tabloGosterModal tr').click(function() {

    $('#aramaSonucModal').modal('hide');


    event.stopPropagation();
    // Tıklanan satırın ID'sini al
    secilenID = $(this).attr('data-id');
    if(secilenID){
    // AJAX ile verileri al
    $.ajax({
        url: 'veri_getir.php',
        type: 'post',
        data: { id: secilenID },
        success: function(response) {
            // Modal içeriğini doldur
            $('#bilgiGosterModal .modal-body').html(response);

            // Modalı aç
            $('#bilgiGosterModal').modal('show');
            form_kaydet_tikla();
        }
    });}

});
}







// Tıklanan satırın ID'sini saklamak için değişken


// Tablodaki tüm satırları döngü ile dinle
function toevoegButton_tikla(){
$('.toevoegButton').click(function() {
    event.stopPropagation();
    // Tıklanan satırın ID'sini al

    // AJAX ile verileri al
    $.ajax({
        url: 'ariza_kayit_giris.php',
        success: function(response) {
            // Modal içeriğini doldur
            $('#yeniKayitModal .modal-body').html(response);

            // Modalı aç
            $('#yeniKayitModal').modal('show');
            var today = new Date();
            // YYYY-MM-DD formatına dönüştür
            var year = today.getFullYear();
            var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Ay, 0-11 arasında olduğu için +1 ekliyoruz ve iki haneli olacak şekilde düzenliyoruz
            var day = today.getDate().toString().padStart(2, '0'); // Günü iki haneli olarak düzenliyoruz
            document.getElementById("datum_aanname").value = year + "-" + month + "-" + day;   
        }
    });

});
}


function veriGetir(kontrol=""){
    startDate="";
    endDate="";
    sonucNe="";
    anahtarKlm="";
    kimler="";

    // Bugünün tarihini al
    var today = new Date();
    // YYYY-MM-DD formatına dönüştür
    var year = today.getFullYear();
    var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Ay, 0-11 arasında olduğu için +1 ekliyoruz ve iki haneli olacak şekilde düzenliyoruz
    var day = today.getDate().toString().padStart(2, '0'); // Günü iki haneli olarak düzenliyoruz

    if (kontrol=="now"){document.getElementById("start_date").value = year + "-" + month + "-" + day;}
    startDate = document.getElementById("start_date").value;
    endDate = document.getElementById("end_date").value;

    if (startDate=="") {document.getElementById("start_date").value = "0000-01-01"}

    if (endDate=="") {
        // Tarihi input alanına eklemek
        document.getElementById("end_date").value = year + "-" + month + "-" + day;   
    }

    startDate = document.getElementById("start_date").value;

    endDate = document.getElementById("end_date").value;
    sonucNe=document.getElementById("sonuc").value;
    anahtarKlm=document.getElementById("anahtarKelime").value;
    var kimlerElement = document.getElementById('kullaniciSec');
    if (kimlerElement !== null) {kimler= kimlerElement.value;}
    else{kimler="";}

   

    //var cookieName = "CBDate";
    //if ($('#datum_aanname).length > 0) {
    //var cookieValue = document.getElementById("datum_aanname").value;

    // Çerezin son kullanma tarihi (30 gün sonraya ayarlandı)
   // var expirationDate = new Date();
  //  expirationDate.setDate(expirationDate.getDate() + 1);
    // Çerez oluştur
  //  document.cookie = cookieName + "=" + cookieValue + "; expires=" + expirationDate.toUTCString() + "; path=/";}

if (kontrol=="hepsi") {
                
                //$('#tabloGosterModal').modal('show');
   // AJAX ile verileri al
    $.ajax({
        url: 'veri_getir_tablo.php',
        type: 'post',
        data: { sDate: startDate, eDate: endDate, anahtar:anahtarKlm, sonuc:sonucNe, kullaniciSecim:kimler },
        success: function(response) {
            // Modal içeriğini doldur
            $('#tabloGosterModal .tablo-body').html(response);
            tr_tikla();
            sil_tikla();
            ara_tikla();
            toevoegButton_tikla();


        }
    });

}else{

    $.ajax({
        url: 'veri_getir_modal.php',
        type: 'post',
        data: { sDate: startDate, eDate: endDate, anahtar:anahtarKlm, sonuc:sonucNe, kullaniciSecim:kimler },
        success: function(response) {
            // Modal içeriğini doldur
            $('#aramaSonucModal .modal-body').html(response);
            $('#aramaSonucModal').modal('show');
            tr_tikla();
            sil_tikla();
            ara_tikla();
            toevoegButton_tikla();


        }
    });
    
}

}



function ara_tikla(){

    $('#ara_buton').click(function() {

        veriGetir();

    });
}


function sil_tikla(){
$('.silButton').click(function() {
    event.stopPropagation();
    var secilenID = $(this).attr('data-id');
    const mesaj = "Silmek istediğinizden eminmisiniz?" + secilenID;
    const cevap = confirm(mesaj);
    if(cevap) {
        // AJAX ile verileri al
        $.ajax({
        url: 'veri_sil.php',
        type: 'post',
        data: { id: secilenID },
        success: function(response) {
            alert("Veri silindi.")
            window.location.reload(1)
        }
    });
} else {
        alert('silme iptal edildi: ' + secilenID);
}
    });
}

// Modal kapatıldığında ID'yi sıfırla
$('#bilgiGosterModal').on('hidden.bs.modal', function () {
    secilenID = null;
    if (aramaTrTiklandi){
        aramaTrTiklandi=false,
        $('#aramaSonucModal').modal('show');
    }

});


function form_kaydet_tikla(){
    $('.formKaydet').click(function() {
    var datum_aannamex = document.getElementById("datum_aanname").value;
    var aangenomen_doorx = document.getElementById("aangenomen_door").value;
    var naam_klantx = document.getElementById("naam_klant").value;
    var telefoonnummer_klantx = document.getElementById("telefoonnummer_klant").value;
    var email_klantx =document.getElementById("email_klant").value;
    var kenmerk_computerx = document.getElementById("kenmerk_computer").value;
    var opbergplaats_computerx = document.getElementById("opbergplaats_computer").value;
    var opmerkingx = document.getElementById("opmerking").value;
    var omschrijving_probleemx = document.getElementById("omschrijving_probleem").value;
    var wie_reparerenx = document.getElementById("wie_repareren").value;
    var kostx = document.getElementById("kost").value;
    var kost_bx = document.getElementById("kost_b").value;
    var resultatenx = document.getElementById("resultaten").value;
    var idx=document.getElementById("id").value;    

    
      // AJAX ile verileri al
        $.ajax({
        url: 'guncelle.php',
        type: 'post',
        data: {datum_aanname :datum_aannamex,
            aangenomen_door : aangenomen_doorx,
            naam_klant : naam_klantx,
            telefoonnummer_klant : telefoonnummer_klantx,
            email_klant : email_klantx,
            kenmerk_computer : kenmerk_computerx,
            opbergplaats_computer : opbergplaats_computerx,
            opmerking : opmerkingx,
            omschrijving_probleem : omschrijving_probleemx,
            wie_repareren : wie_reparerenx,
            kost : kostx,
            kost_b : kost_bx,
            resultaten :resultatenx,
            id :idx },
        success: function(response) {
        $('#bilgiGosterModal').modal('hide');
        if (aramaTrTiklandi){
            aramaTrTiklandi=false;
            $('#aramaSonucModal').modal('show');
        }

        veriGetir();
        }

    });

    });
}


</script>

