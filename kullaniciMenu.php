<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'genel/header.php';
include 'function/dilSecimi.php';
?>
<div class="toevoegButton" onclick="location.href=&#39;kullanici_kayit_giris.php&#39;;">
    +
    </div>
        <!-- Sayfanın içeriği (örnek veri) -->
        <div class="mt-4">
            <?php

            // Veritabanından verileri çekme sorgusu
            $sql = "SELECT * FROM users WHERE sil=0";
            $result = mysqli_query($conn, $sql);
            // Verileri tabloya eklemek için döngü
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="mt-4">';
                #echo '<h3>Veritabanından Çekilen Liste</h3>';
                echo '<table class="table table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo "<th>$taal_kullaniciAdi</th>";
                echo "<th>$taal_yetki</th>";
                if ($yetki==9) echo '<th>'.$taal_sil.'</th>';
                // Diğer verileri burada ekleyebilirsiniz
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    // data-id ekleyerek her satıra bir özel kimlik atayın
                    echo '<tr data-id="' . $row['id'] . '">';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>'; if ($row['yetki']==9) echo $taal_admin; else if($row['yetki']==5) echo $taal_kullanici;
                    echo '</td>';
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
            mysqli_close($conn);
            ?>
            
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
                    <h4 class="modal-title" ><?php echo $taal_guncelle ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Bilgi içeriği burada gösterilecek -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php $taal_kapat ?></button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<!-- JavaScript ekleyin -->
<script>

    // Tıklanan satırın ID'sini saklamak için değişken
var secilenID;

// Tablodaki tüm satırları döngü ile dinle
$('tr').click(function() {
    event.stopPropagation();
    // Tıklanan satırın ID'sini al
    secilenID = $(this).attr('data-id');

    // AJAX ile verileri al
    $.ajax({
        url: 'kullanici_veri_getir.php',
        type: 'post',
        data: { id: secilenID },
        success: function(response) {
            // Modal içeriğini doldur
            $('#bilgiGosterModal .modal-body').html(response);

            // Modalı aç
            $('#bilgiGosterModal').modal('show');
        }
    });
    myFormListen();
});

// Modal kapatıldığında ID'yi sıfırla
$('#bilgiGosterModal').on('hidden.bs.modal', function () {
    secilenID = null;
});





$('.silButton').click(function() {
    event.stopPropagation();
    var secilenID = $(this).attr('data-id');
    const mesaj = "Deze gebruikersnaam bestond. Kies een andere naam..." +" "+ secilenID;
    const sonuc = confirm(mesaj);
    if(sonuc) {
        // AJAX ile verileri al
        $.ajax({
        url: 'kullanici_sil.php',
        type: 'post',
        data: { id: secilenID },
        success: function(response) {
            alert("Gebruiker is verwijderd");
            window.location.reload(1)
        }
    });
} else {
        alert("Verwijdering geannuleerd" + secilenID);
}

    });

function myFormListen(){
alert(document.getElementById("password").value);
document.getElementById("myForm").addEventListener("submit", function(e) {

    e.preventDefault(); // Formun otomatik gönderilmesini engelle

    if (document.getElementById("password").value !=""){
        alert("boş değil")
        if (document.getElementById("password").value == document.getElementById("password2").value)
        {
        this.submit(); // Formu gönder
        } else {
            alert("Beide ingevoerde wachtwoorden moeten hetzelfde zijn.");
        }
    }
});
}
</script>