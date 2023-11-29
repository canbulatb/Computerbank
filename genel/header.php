<?php 
include 'function/dilSecimi.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $taal_hosGeldiniz?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="favicon.ico">
    <style>
body {
	font-family: 'Titillium Web', Arial, Helvetica, sans-serif;
    /*background-color: #ffecec;*/
    margin: 0;
	transition: 1s; 	
}

.tilmaHuisContainer {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: -50; /* Varsa alt boşluğu kaldırır */
}

.tilmaHuisContainer > div {
    margin-right: 10px; /* Sağ taraftaki boşluğu ayarlayın */
}

.tilmaHuisContainer img {
    max-width: 75%;
    height: auto;
}


body::after {
	content: "";
 /* background: url("background.jpg"); */
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: 100% 100%;
	opacity: 0.10;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	position: fixed;
	z-index: -1;   
}


table tbody tr:hover {
    cursor: pointer;
}

div.terugHome:hover {
    cursor: pointer;
}

div.toevoegButton	{
	position: fixed;""""
    bottom: 75%;
    right: 0;
	background-image: linear-gradient(#525151, #797979, #525151);
	color: #ffffff;
	font-size: 60px;
	padding: 0px 20px 13px 30px;
	border-radius: 20px 0 0 20px;
	z-index: 1;
	border: 2px solid #ffffff;
	border-width: 2px 0 2px 2px;
	cursor: pointer;
	box-shadow: 1px 18px 18px #616161;
	transition: 0.7s;
	transition-timing-function: ease-out;
}

div.toevoegButton:hover	{
	padding-right: 80px;
}


    </style>
</head>
<body>
    <div class="container mt-4">
                

    <div class="row">
    
        <div class="col-2">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light white sticky-top">
                <!-- Menü ve kullanıcı bilgileri -->
                <div class="navbar-collapse" id="navbarSupportedContent15">
                    <ul class="nav nav-pills">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $taal_menu?></a>
                        <div class="dropdown-menu">
                            <?php
                            // Kullanıcının admin mi yoksa kullanıcı mı olduğunu belirlemek için bir değişken kullanalım
                            #$isAdmin = true; // Örnek olarak admin olduğunu varsayalım
                            if ($yetki==9) {
                                echo '
                                        <a class="dropdown-item" href="kullaniciMenu.php">'.$taal_kullanicilar.'</a>';
                            } 
                            echo '<a class="dropdown-item" href="welcome.php" href="#">'.$taal_ariza.'</a>
                                    <a class="dropdown-item" href="#">'.$taal_diger.'</a>
                            ';
                            ?>
                        </div>
                    </li>               
                    </ul>
                </div>
        
            </nav>
        </div>
      
                
        <div class="col-7">
                <div class="d-flex justify-content-center align-items-center terugHome"  onclick="location.href=&#39;welcome.php&#39;;"> 
                    <div class="tilmaHuisContainer" onclick="location.href='welcome.php';">
                        <div>
                            <img src="LOGODIG050.png" alt="Logo Resmi">
                        </div>
                        <div>
                            <h2 class="text-center"><?php echo  $taal_helpdesk_talmahuis?></h2>
                            <h2 class="text-center"><?php echo  $taal_reparatie_toevoegen?></h2>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-3">
            <div>
                <select name="taal"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="CBTaal" onchange="CBTaal_degistir()">
                    <option value="Nl"<?php if($cb_taal_secim=="Nl"){ echo "SELECTED";} ?>>Nl</option>
                    <option value="Tr"<?php if($cb_taal_secim=="Tr"){ echo "SELECTED";} ?>>Tr</option>
                </select>
            </div>
                <!-- Kullanıcı bilgileri sağ üstte -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php
                        // Giriş yapan kullanıcı bilgileri (örnek veri)
                        //$username = "Kullanıcı Adı";
                        //$lastLoginDate = "15 Eylül 2023"; // Son giriş tarihi (örnek veri)
                        //echo "<p>Son Giriş Tarihi: $lastLoginDate</p>";
                        echo "<p>$taal_hosGeldin $username</p>";
                        if ($yetki==9) {
                            echo "<p> $taal_admin <a href='function/cikis.php' > <button type='button' class='btn btn-primary'>$taal_cikis</button></a></p>";
                        } else if ($yetki==5)  {
                            echo "<p>$taal_kullanici <a href='function/cikis.php' > <button type='button' class='btn btn-primary'>$taal_cikis</button></a></p>";
                        }
                        echo "";
                        ?>
                    </li>
                </ul>
        </div>
    </div>
<script>
    function CBTaal_degistir(){
    event.stopPropagation();
    // Çerez adı ve değeri
    var cookieName = "CBTaal";
    var cookieValue = document.getElementById("CBTaal").value;

    // Çerezin son kullanma tarihi (30 gün sonraya ayarlandı)
    var expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + 9999);
    // Çerez oluştur
    document.cookie = cookieName + "=" + cookieValue + "; expires=" + expirationDate.toUTCString() + "; path=/";
    window.location.reload(1)
}
</script>