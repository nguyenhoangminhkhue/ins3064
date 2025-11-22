<?php
include "connection.php";
$id=$_GET["id"];
$firstname="";
$lastname="";
$email="";
$contact="";
$Des="";

$res=mysqli_query($link,"select * from table1 where id=$id");
while ($row=mysqli_fetch_array($res))
{
    $firstname=$row["AName"];
    $lastname=$row["Species"];
    $email=$row["Area"];
    $contact=$row["Date"];
    $Des=$row["des"];

}
header("location.index.php");
?>

<html lang="en" xmlns="">
<head>
    <title>User Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
     <meta http-equiv="X-UA-Compatible" content="IE-edge">
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
                <input type="text" class="form-control" required id="firstname" placeholder="" name="AName" value="<?php echo $firstname; ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Species:</label>
                <input type="text" class="form-control" required id="Species" placeholder="" name="Species" value="<?php echo $lastname; ?>">
            </div>
            <div class="form-group">
                <label for="email">Area:</label>
                <input type="text" class="form-control" required id="Area" placeholder="" name="Area" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="contact">Date of birth:</label>
                <input type="text" class="form-control" required id="Date" placeholder="" name="Date" value="<?php echo $contact; ?>">
            </div>
            <div class="form-group">
                <label for="email">Description:</label>
                <input type="text" class="form-control" required id="Des" placeholder="" name="des" value="<?php echo $Des; ?>">
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo:</label>
                <input type="file" class="form-control" required id="photo" name="photo">
            </div>
            <button type="submit" name="update" class="btn btn-default">Update</button>

        </form>
    </div>
</div>

</body>

<?php
if(isset($_POST["update"]))
{
        
        $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    // move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    if ($check !== false) {
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        mysqli_query($link,"update table1 set AName='$_POST[AName]',Species='$_POST[Species]',Area='$_POST[Area]',Date='$_POST[Date]',des='$_POST[des]', photo='$target_file' where id=$id");
        echo "<div class='alert alert-success'>Update thành công.</div>";
    } else {    

         echo "<div class='alert alert-danger'>File không phải là ảnh hợp lệ.</div>";
    }
}
?>

</html>