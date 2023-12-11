<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "computerbank"; // Veritabanı adı

$conn = mysqli_connect($servername, $username, $password, $database);

// Bağlantı hatası kontrolü
if (!$conn) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Kullanıcı girişi, hatalı girişleri izleme ve hesap kilitleme işlevi
function izleVeKilitliyor($username, $max_hatali_deneme = 3, $kilitleme_suresi = 300) {
    // İzlenen kullanıcının hesabını bulun
    global $conn; // Veritabanı bağlantısını işlev içinde kullanabilmek için global olarak tanımlıyoruz

    // Son üç başarısız giriş denemesini al
    $sql = "SELECT login_time FROM login_logs WHERE username = ? AND login_time >= NOW() - INTERVAL $kilitleme_suresi SECOND";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) >= $max_hatali_deneme) {
                // Hesabı kilitle
                return "Hesabınız kilitli. Lütfen bir süre sonra tekrar deneyin.";
            }
        }
    }

    // Burada parolanın kontrolü yapılır ve başarısızsa login_logs tablosuna kaydedilir.
    // Eğer parola doğruysa login_logs tablosuna başarılı giriş kaydı eklenir.

    return "Başarısız giriş denemeleri: " . mysqli_stmt_num_rows($stmt);
}

// Oturumu başlat
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı girişi, hatalı girişleri izleme ve hesap kilitleme işlevini çağır
    $hatali_giris_durumu = izleVeKilitliyor($username);

    if ($hatali_giris_durumu == "Hesabınız kilitli. Lütfen bir süre sonra tekrar deneyin.") {
        // Hesap kilitli, kullanıcıya bilgi verilebilir.
    } else {
        // Kullanıcı girişi işlemleri burada yapılır.
    }

    // Bağlantıyı kapat
    mysqli_close($conn);
}






// Oturumu başlat
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı girişi, hatalı girişleri izleme ve hesap kilitleme işlevini çağır
    $hatali_giris_durumu = izleVeKilitliyor($username);

    if ($hatali_giris_durumu == "Hesabınız kilitli. Lütfen bir süre sonra tekrar deneyin.") {
        // Hesap kilitli, kullanıcıya bilgi verilebilir.
    } else {
        // Kullanıcı girişi işlemleri burada yapılır.
    }

    // Bağlantıyı kapat
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Girişi</title>
    <style>
        /* CSS kodu buraya ekleyebilirsiniz */
    </style>
</head>
<body>
    <h2>Kullanıcı Girişi</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Kullanıcı Adı:</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Parola:</label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Giriş Yap">
        </div>
    </form>
    <?php
    if (isset($login_err)) {
        echo '<p>' . $login_err . '</p>';
    }
    ?>
</body>
</html>
