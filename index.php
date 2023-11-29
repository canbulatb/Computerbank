<?php

function kayitGiris($username, $is_successful) {
    global $conn; // Veritabanı bağlantısını işlev içinde kullanabilmek için global olarak tanımlıyoruz

    // Kullanıcı giriş kaydını ekle
//    $sql = "INSERT INTO login_logs (user_id, is_successful) VALUES ((SELECT id FROM users WHERE username = ?), ?)";
//
//    if ($stmt = mysqli_prepare($conn, $sql)) {
//        mysqli_stmt_bind_param($stmt, "si", $username, $is_successful);
//        mysqli_stmt_execute($stmt);
//    }
}

include 'function/baglan.php';
include 'function/dilSecimi.php';
// Oturumu başlat
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı adı ve parolayı veritabanından sorgula
    $sql = "SELECT id, username, password, isAdmin, yetki, sil FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $isAdmin, $yetki, $sil);

                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        if($sil==0){
                        // Parola doğru, oturumu başlat
                        kayitGiris($username, 1);
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $id;
                        $_SESSION["username"] = $username;
                        $_SESSION["isAdmin"] = $isAdmin;
                        $_SESSION["yetki"] = $yetki;

                        // Giriş başarılı, kullanıcıyı yönlendir
                        header("location: welcome.php");
                        }else{
                         $login_err = $taal_kullanici_pasif;
                    }
                        
                        

                    } else {
                        // Hatalı parola mesajı
                        #$hashed_password2 = password_hash($password, PASSWORD_DEFAULT);
                        #$login_err=$hashed_password2;
                        kayitGiris($username, 0);
                        $login_err = $taal_hatali_kullanici_parolasi;

                    }
                }
            } else {
                // Kullanıcı adı bulunamadı mesajı
                $login_err = $taal_boyle_bir_kullanici_yok;
            }
        } else {
            echo $taal_birseyler_yanlis;
        }

        // Sorgu kapat
        mysqli_stmt_close($stmt);
    }
    // Bağlantıyı kapat
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Girişi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: #ff0000;
            margin-top: 10px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="LOGODIG050.png" alt="Logo Resmi">
        <h2><?php $taal_kullanici_girisi?></h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="username"><?php echo $taal_kullaniciAdi?></label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password"><?php echo $taal_parola?></label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <input type="submit" value=<?php echo $taal_giris_yap?>>
            </div>
        </form>
        <?php
        if (isset($login_err)) {
            echo '<p class="error">' . $login_err . '</p>';
        }
        ?>
    </div>
</body>
</html>
