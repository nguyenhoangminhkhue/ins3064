<?php
include "connection.php";
?>

<html lang="en" xmlns="">
<head>
    <title>User Account</title>
    <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <!-- short column display for forms rows -->
   <!--visit https://www.w3schools.com/bootstrap/bootstrap_forms.asp search for forms template and use it.-->
    <div class="col-lg-4">
    <h2>User data form</h2>
    <form action="" name="form1" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname">Name:</label>
            <input type="text" class="form-control" id="AName" placeholder="" name="AName">
        </div>
        <div class="form-group">
            <label for="lastname">Species:</label>
            <input type="text" class="form-control" id="Species" placeholder="" name="Species">
        </div>
        <div class="form-group">
            <label for="email">Area:</label>
            <input type="text" class="form-control" id="Area" placeholder="" name="Area">
        </div>
        <div class="form-group">
            <label for="contact">Date of birth</label>
            <input type="date" class="form-control" id="Date" placeholder="" name="Date">
        </div>
        <div class="form-group">
            <label for="email">Description:</label>
            <input type="text" class="form-control" id="Des" placeholder="" name="Des">
        </div>
        <div class="form-group">
        <label for="photo">Upload Photo:</label>
        <input type="file" class="form-control" required id="photo" name="photo">
    </div>
    <div class="form-group">
    <label for="search">Search by Name:</label>
    <input type="text" class="form-control" id="search" name="search_name" placeholder="Enter firstname to search">
</div>
        <button type="submit" name="insert" class="btn btn-default">Insert</button>
        <button type="submit" name="search" class="btn btn-primary">Search</button>
        <a href="index.php" class="btn btn-primary mt-3">Quay lại</a>
    </form>
</div>
</div>

<!-- new column inserted for records -->
<!-- Search for boostrap table template online and copy code -->
<div class="col-lg-12">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>photo</th>
            <th>Name</th>
            <th>Description</th>
            <th>Delete</th>
            <th>Detail</th>
        </tr>
        </thead>
        <tbody>
        <!-- Database connection -->
        <?php
        if (!empty($link)) {
    if (isset($_POST["search"]) && !empty($_POST["search_name"])) {
        $search_name = mysqli_real_escape_string($link, $_POST["search_name"]);
        $res = mysqli_query($link, "SELECT * FROM table1 WHERE AName LIKE '%$search_name%'");
    } else {
        $res = mysqli_query($link, "SELECT * FROM table1");
    }
}

        while($row=mysqli_fetch_array($res))
        {
            echo "<tr>";
            echo "<td>"; echo $row["id"]; echo "</td>";
            echo "<td><img src='" . $row["photo"] . "' width='80'></td>";
            echo "<td>"; echo $row["AName"]; echo "</td>";
            echo "<td>"; echo $row["des"]; echo "</td>";
            echo "<td>"; ?> <a href="delete.php?id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-danger">Delete </button></a> <?php echo "</td>";
            echo "<td>"; ?> <a href="view_animal.php?id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-info">Detail </button></a> <?php echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>

<!-- new records insertion into database table -->
<!-- records delete from database table -->
<!-- records update from database table -->

<!-- to automatically refresh the pages after crud activity   window.location.href=window.location.href; -->
<?php
if(isset($_POST["insert"]))
{
    // mysqli_query($link,"insert into table1 values (NULL,'$_POST[firstname]' ,'$_POST[lastname]','$_POST[email]','$_POST[contact]','$_FILES[photo]')");
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    // move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

        // Lưu đường dẫn ảnh vào DB
        mysqli_query($link, "INSERT INTO table1 VALUES (NULL,'$_POST[AName]' ,'$_POST[Species]','$_POST[Area]','$_POST[Date]','$target_file','$_POST[Des]')");

        echo "<script>window.location.href = window.location.href;</script>";
    } else {
        echo "<div class='alert alert-danger'>File không phải là ảnh hợp lệ.</div>";
    }
}

?>
</html>