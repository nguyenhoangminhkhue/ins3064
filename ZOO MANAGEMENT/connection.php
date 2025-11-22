<?php
// connection.php
// Unified DB connection for the project so both old mysqli pages and PDO pages work.
// Edit DB name / user / pass below to match your environment.

$DB_HOST = '127.0.0.1';
$DB_PORT = 3306;
$DB_NAME = 'LoginReg';   // tên DB theo project zip (nếu bạn dùng DB khác, sửa tại đây)
$DB_USER = 'root';
$DB_PASS = '';           // Laragon mặc định rỗng

/* --- mysqli connection (for pages using mysqli) --- */
$link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
if (!$link) {
    // Trong môi dev: hiển thị lỗi để sửa. Production: log thay vì die.
    die("MySQLi connect error: " . mysqli_connect_error());
}

/* --- PDO connection (for pages expecting $pdo) --- */
$dsn = "mysql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME};charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // Nếu PDO lỗi trong dev, dừng luôn để bạn biết; production: log rồi tiếp tục mysqli nếu cần.
    die("PDO connect error: " . $e->getMessage());
}
