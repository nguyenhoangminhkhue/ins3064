<?php
require_once 'connection.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
if (!isset($_GET['id'])) { echo "Không tìm thấy ID."; exit; }
$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM animals WHERE id = ?");
$stmt->execute([$id]);
$a = $stmt->fetch();
if (!$a) { echo "Không tìm thấy động vật."; exit; }
?>
<!doctype html>
<html lang="vi">
<head><meta charset="utf-8"><title><?=htmlspecialchars($a['name'])?></title><link rel="stylesheet" href="style.css"></head>
<body>
  <div style="max-width:900px;margin:24px auto">
    <a href="homescreen.php">← Trở về</a>
    <h2><?=htmlspecialchars($a['name'])?></h2>
    <img src="<?=htmlspecialchars($a['image'] ?: 'uploads/placeholder.png')?>" alt="" style="max-width:320px;border-radius:8px">
    <p><strong>Species:</strong> <?=htmlspecialchars($a['species'])?></p>
    <p><strong>Habitat:</strong> <?=htmlspecialchars($a['habitat'])?></p>
    <p><strong>Age:</strong> <?=htmlspecialchars($a['age'])?></p>
    <p><?=nl2br(htmlspecialchars($a['description']))?></p>
    <div style="margin-top:12px">
      <a class="btn" href="edit_animal.php?id=<?=$a['id']?>">Edit</a>
      <a class="btn" href="delete.php?id=<?=$a['id']?>" onclick="return confirm('Xác nhận xóa?')">Delete</a>
    </div>
  </div>
</body>
</html>
