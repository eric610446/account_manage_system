<?

include '../config.php' ;

//建立時間變數，設定時區。
date_default_timezone_set("Asia/Taipei");
$mdate=date ("Y-m-d");
$mtime=date ("H:i:s");

$test=$test.'-----[LOG]-----<br/>start '.$mdate.'<br/>';
$servername = "127.0.0.1";
$username = "root";
$password = "helloroot";
$dbname = "client_info";
$only_get_info = 0 ;
$invalid_mode = 0 ;

$default_active_input = $default_active_color ;
$default_sleep_input = $default_sleep_color ;
$default_div_color = $default_active_input ;

// 建立 MySQL 連線
$conn = new mysqli($servername, $username, $password, $dbname);
// 連線檢查
if ($conn->connect_error) {
    die("連線資料庫失敗，請檢查資料庫的帳號與密碼，以及要進入的資料庫名稱" . $conn->connect_error);
}
?>