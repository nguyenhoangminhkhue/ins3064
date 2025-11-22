<?php
require_once 'connection.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $species = trim($_POST['species'] ?? '');
  $age = intval($_POST['age'] ?? 0);
  $habitat = trim($_POST['habitat'] ?? '');
  $description = trim($_POST['description'] ?? '');

  // file upload
  if (!empty($_FILES['photo']['name'])) {
    $f = $_FILES['photo'];
    if ($f['error'] === UPLOAD_ERR_OK) {
      $check = getimagesize($f['tmp_name']);
      if ($check === false) $errors[] = "File không phải ảnh.";
      else {
        // limit size 3MB
        if ($f['size'] > 3*1024*1024) $errors[] = "Ảnh quá lớn (max 3MB).";
        else {
          $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
          $newName = 'uploads/' . bin2hex(random_bytes(8)) . '.' . $ext;
          if (!move_uploaded_file($f['tmp_name'], $newName)) $errors[] = "Không thể lưu ảnh.";
        }
      }
    } else {
      $errors[] = "Lỗi upload ảnh.";
    }
  } else {
    $newName = null;
  }

  if (empty($name)) $errors[] = "Tên thú không được rỗng.";

  if (empty($errors)) {
    $stmt = $pdo->prepare("INSERT INTO animals (name,species,age,habitat,description,image,created_at) VALUES (?,?,?,?,?,?,NOW())");
    $stmt->execute([$name,$species,$age,$habitat,$description,$newName]);
    header('Location: homescreen.php');
    exit;
  }
}
?>
<!doctype html>
<html lang="vi">
<head><meta charset="utf-8"><title>Thêm thú</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div style="max-width:680px;margin:28px auto">
    <a href="homescreen.php">← Trở về</a>
    <h2>Thêm động vật mới</h2>
    <?php if (!empty($errors)): ?><div style="background:#fff5f5;padding:10px;border-radius:8px;margin-bottom:12px"><ul><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul></div><?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
      <label>Tên</label><input type="text" name="name" required>
      <label>Species</label><input type="text" name="species">
      <label>Age</label><input type="number" name="age">
      <label>Habitat</label><input type="text" name="habitat">
      <label>Description</label><textarea name="description" rows="4"></textarea>
      <label>Ảnh</label><input type="file" name="photo" accept="image/*">
      <button class="btn" type="submit">Lưu</button>
    </form>
  </div>
</body>
</html>
