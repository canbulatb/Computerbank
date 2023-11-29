<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'genel/header.php';
#// Otomatik doldurmayı devre dışı bırakmak için özel bir HTTP başlığı ekleyin
#header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
#header('Cache-Control: post-check=0, pre-check=0', false);
#header('Pragma: no-cache');
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reparatie Bilgileri</title>
    <!-- jQuery ve Bootstrap CSS ekleme -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS ekleme -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Özel CSS ekleme -->
    <style>
        /* Formun genel stil ayarları */
        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Kullanıcı Kayıt Girişi</h2>
    <form action="kullanici_kaydet.php" id="myForm" method="post">      
    <div class="form-group"> 
        <label for="username">User Name:</label>
        <input type="text" class="form-control" id="username" name="username" value="" autocomplete="off" required>
        <span id="kullaniciDurum"></span>
    </div>


    
    <div class="form-group">
<label><?php echo $taal_yetki ?></label>
        <select name="yetki" class="form-control">
				<option value="9"><?php echo $taal_admin ?></option>
				<option value="5" SELECTED><?php echo $taal_kullanici ?></option>
        </select>
        </div>



        <div class="form-group">
        <label><?php echo $taal_kim_gorebilir ?></label>
        <?php if($yetki==9){ ?>
            <select name="kullaniciSec" class="form-control" id="kullaniciSec">
            <option  value=""> </option>

            <?php
            // Veritabanından verileri çekme sorgusu
            $sql = "SELECT * FROM users WHERE sil=0";
            $result = mysqli_query($conn, $sql);
            // Verileri tabloya eklemek için döngü
            $i=1;
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
				<option value="<?php echo $row['id'];?>"> <?php echo $row['username']; ?> </option>

        <?php $i=$i+1;}}}?> </select>
        </div>


        <div class="form-group">
            <label><?php echo $taal_sifre ?></label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
        </div>

        <div class="form-group">
            <label><?php echo $taal_sifre ?></label>
            <input type="password" class="form-control" id="password2" name="password2" autocomplete="off" required>
        </div>


        <div class="form-group">
            <input type="submit" class="form-control" class="btn btn-primary" name ="kaydet" id="kaydet" value="Kaydet">
        </div>
        <input type="hidden" name="id" value="'.$id.'">
    </form>'

</body>
</html>
<script>

var usernameInput = document.getElementById("username");        
var mesaj = document.getElementById("mesaj");




        // Kullanıcı adı alanında bir tuşa basıldığında veya odak kaybedildiğinde kontrol yap
usernameInput.addEventListener("blur", function() {
            // Kullanıcı adını al
    var kullaniciAdi = usernameInput.value;
    
    $.ajax({
        url: "kullaniciKontrol.php", // Kullanıcı adı kontrolü yapacak PHP dosyanızın adını ve yolunu buraya yazın
        type: "POST",
        data: { username: kullaniciAdi },
        success: function(response) {
            // PHP dosyasından gelen yanıtı işle
            if (response.trim() === "var") {
                $("#kullaniciDurum").text("<?php echo $taal_baska_kullanici_sec?>");
                document.getElementById("kaydet").disabled = true;
            } else {
                $("#kullaniciDurum").text(""); // Mesajı temizle
                document.getElementById("kaydet").disabled = false;
            }
        }
    });
});



document.getElementById("myForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Formun otomatik gönderilmesini engelle
    if (document.getElementById("password").value !=""){
        if (document.getElementById("password").value == document.getElementById("password2").value)
        {
        this.submit(); // Formu gönder
        } else {
            alert("Beide ingevoerde wachtwoorden moeten hetzelfde zijn.");
        }
    }
});








</script>