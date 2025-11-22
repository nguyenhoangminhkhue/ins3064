<?php
include "connection.php";
?>

<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Zoo Management</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    :root{--green:#2f7a2f;--bg:#f4f6f4;--muted:#6b7280}
    *{box-sizing:border-box;font-family:Inter,system-ui,Arial,sans-serif}
    body{margin:0;background:var(--bg);color:#222;padding:20px}
    .container{max-width:1100px;margin:20px auto;display:grid;grid-template-columns:1fr;gap:18px}
    .panel{background:#fff;border-radius:10px;padding:18px;box-shadow:0 10px 26px rgba(0,0,0,.06)}
    h2{margin:0 0 12px;color:var(--green);display:inline-block}
    .top-actions{float:right}
    label{display:block;margin:10px 0 6px;font-weight:600}
    input[type="text"], input[type="date"], input[type="file"], textarea{
      width:100%;padding:8px;border:1px solid #e6e9ee;border-radius:8px;background:#fff;margin-bottom:6px
    }
    .row{display:flex;gap:12px;flex-wrap:wrap}
    .col{flex:1;min-width:220px}
    .btn{display:inline-block;padding:8px 12px;border-radius:8px;border:0;background:var(--green);color:#fff;cursor:pointer}
    .btn.alt{background:#3b82f6}
    .btn.ghost{background:#eee;color:#000}
    .muted{color:var(--muted)}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:8px;border:1px solid #eee;text-align:left;font-size:14px}
    th{background:#f9fafb}
    img.thumb{width:80px;height:60px;object-fit:cover;border-radius:6px}
    .actions a{margin-right:6px;text-decoration:none}
    @media (max-width:720px){ .row{flex-direction:column} .col{min-width:100%} .top-actions{float:none;margin-top:10px} }
    /* clear float */
    .clearfix::after{content:"";display:block;clear:both}
  </style>
</head>
<body>

<div class="container">

  <div class="panel clearfix">
    <div style="display:flex;align-items:center;justify-content:space-between">
      <div>
        <h2>Quản lý Sở Thú — Thêm / Tìm kiếm</h2>
        <p class="muted" style="margin:6px 0 0">Sử dụng form bên dưới để thêm động vật. Tên trường và xử lý upload giữ nguyên như file gốc.</p>
      </div>

      <div class="top-actions">
        <!-- Quay lại: link về index.php (login/signup) -->
        <a href="index.php" class="btn ghost" style="padding:8px 12px;border-radius:8px;text-decoration:none">Quay lại</a>
      </div>
    </div>

    <hr style="margin:14px 0">

    <!-- FORM: original fields and names preserved -->
    <form action="" name="form1" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col">
          <label for="Name">Name</label>
          <input type="text" id="Name" name="Name" class="form-control" placeholder="">
        </div>

        <div class="col">
          <label for="Species">Species</label>
          <input type="text" id="Species" name="Species" class="form-control" placeholder="">
        </div>

        <div class="col">
          <label for="Area">Area</label>
          <input type="text" id="Area" name="Area" class="form-control" placeholder="">
        </div>

        <div class="col">
          <label for="Date">Date of birth</label>
          <input type="date" id="Date" name="Date" class="form-control" placeholder="">
        </div>
      </div>

      <div style="margin-top:10px">
        <label for="Des">Description</label>
        <input type="text" id="Des" name="Des" class="form-control" placeholder="">
      </div>

      <div style="margin-top:10px">
        <label for="photo">Upload Photo</label>
        <input type="file" id="photo" name="photo" class="form-control" required>
      </div>

      <div style="margin-top:10px;display:flex;gap:8px;align-items:flex-end">
        <div style="flex:1">
          <label for="search">Search by Name</label>
          <input type="text" id="search" name="search_name" class="form-control" placeholder="Enter name to search">
        </div>
        <div style="display:flex;flex-direction:column;gap:8px">
          <button type="submit" name="insert" class="btn">Insert</button>
          <button type="submit" name="search" class="btn alt">Search</button>
        </div>
      </div>
    </form>
  </div>

  <div class="panel">
    <h2>Danh sách động vật</h2>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width:48px">#</th>
          <th>photo</th>
          <th>Name</th>
          <th>Description</th>
          <th style="width:120px">Delete</th>
          <th style="width:120px">Detail</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // original selection logic preserved exactly:
        if (!empty($link)) {
            if (isset($_POST["search"]) && !empty($_POST["search_name"])) {
                $search_name = mysqli_real_escape_string($link, $_POST["search_name"]);
                $res = mysqli_query($link, "SELECT * FROM table2 WHERE Name LIKE '%$search_name%'");
            } else {
                $res = mysqli_query($link, "SELECT * FROM table2");
            }
        }

        if (!empty($res)) {
            while($row=mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . (int)$row["id"] . "</td>";
                echo "<td>";
                $photo = htmlspecialchars($row["photo"] ?? '');
                if ($photo && file_exists(__DIR__ . '/' . $photo)) {
                    echo "<img src='".htmlspecialchars($photo)."' class='thumb' alt='photo'>";
                } else {
                    echo "<img src='uploads/placeholder.png' class='thumb' alt='placeholder'>";
                }
                echo "</td>";
                echo "<td>" . htmlspecialchars($row["AName"] ?? '') . "</td>";
                echo "<td>" . htmlspecialchars($row["des"] ?? '') . "</td>";
                echo "<td><a href='delete.php?id=" . (int)$row['id'] . "' onclick=\"return confirm('Xác nhận xóa?')\"><button type='button' class='btn' style='background:#ef4444'>Delete</button></a></td>";
                echo "<td><a href='view_animal.php?id=" . (int)$row['id'] . "'><button type='button' class='btn' style='background:#06b6d4'>Detail</button></a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='muted'>Không có bản ghi.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</div>

<?php
// preserve original insertion logic exactly (no change in behavior)
if(isset($_POST["insert"]))
{
    $target_dir = "uploads/";
    if (!is_dir(__DIR__ . '/' . $target_dir)) mkdir(__DIR__ . '/' . $target_dir, 0755, true);
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], __DIR__ . '/' . $target_file)) {
            // Lưu đường dẫn ảnh vào DB
            // keep original INSERT exactly as in homescreen.php
            mysqli_query($link, "INSERT INTO table2 VALUES (NULL,'$_POST[Name]' ,'$_POST[Species]','$_POST[Area]','$_POST[Date]','$target_file','$_POST[Des]')");
            echo "<script>window.location.href = window.location.href;</script>";
        } else {
            echo "<div class='panel' style='max-width:1100px;margin:12px auto;'><div style='color:#b91c1c'>Không lưu được file ảnh.</div></div>";
        }
    } else {
        echo "<div class='panel' style='max-width:1100px;margin:12px auto;'><div style='color:#b91c1c'>File không phải là ảnh hợp lệ.</div></div>";
    }
}
?>

</body>
</html>

