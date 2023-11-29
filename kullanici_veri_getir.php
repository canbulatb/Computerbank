<?php
include 'function/sessionKontrol.php';
include 'function/baglan.php';
include 'function/dilSecimi.php';

// AJAX isteği ile gönderilen 'id' parametresini alın
$id = $_POST['id'];

// Verileri veritabanından almak için sorgu oluşturun
$sql = "SELECT * FROM users WHERE id = $id and sil=!1";
$result = mysqli_query($conn, $sql);

// Verileri dizi olarak alın
$data = mysqli_fetch_assoc($result);
echo '    <form action="kullaniciGuncelle.php" id="myForm" method="post"> </div> ';
echo ' <div class="form-group row"> <label for="username" class="col-sm-4 col-form-label">'.$taal_kullaniciAdi.'</label>';
echo '   <div class="col-sm-8"> <input type="text" class="form-control" id="username" name="username" value=" ' . $data['username'] . '" readonly> </div> </div>' ;

echo '<div class="form-group row">
        <label for="username" class="col-sm-4 col-form-label">'.$taal_yetki.'</label>
        <div class="col-sm-8">
            <select name="yetki" class="form-control"">
            <option value="9"'; if($data['yetki']=="9"){ echo "SELECTED";} echo '>'.$taal_admin.'</option>
            <option value="5"'; if($data['yetki']=="5"){ echo "SELECTED";} echo'>'.$taal_kullanici.'</option>
        </select>
        </div>
        </div>
        <div class="form-group row">
        <label class="col-sm-4 col-form-label">'. $taal_kim_gorebilir . '</label>';
        if($yetki==9){ 
            ?>
        <div class="col-sm-8">
            <select name="kullaniciSec" class="form-control" id="kullaniciSec">
            <option value=""> </option>

            <?php
            // Veritabanından verileri çekme sorgusu

            $sql = "SELECT * FROM users WHERE sil=0";
            $result = mysqli_query($conn, $sql);
            // Verileri tabloya eklemek için döngü
            $i=1;
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
				<option <?php if($data['kim_gorebilir']==$row['id']){ echo "SELECTED";} ?> value="<?php echo $row['id'];?>"> <?php echo $row['username']; ?> </option>

        <?php $i=$i+1;}}} 
        echo ' </select> </div>
        </div>

        <div class="form-group row">
            <label for="username" class="col-sm-4 col-form-label">'.$taal_sifre.'</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" name="password" id="password" value="">
        </div>
        </div>
        

        <div class="form-group row">
            <label for="password2" class="col-sm-4 col-form-label">'.$taal_tekrar_sifre.'</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" name="password2" id="password2" value="">
        </div>
        </div>
        

        <div class="form-group">
            <input type="submit" class="btn btn-primary form-control" value="'.$taal_kaydet.'">
        </div>
        <input type="hidden" name="id" value="'.$id.'">
    </form>';

// Verileri JSON formatında geri döndürün
#echo json_encode($data);

// Veritabanı bağlantısını kapat

mysqli_close($conn);
?>
