<?php
include "connection.php";
$LaptopID=$_GET["LaptopID"];
$Brand="";
$Model="";
$Processor="";
$RAM="";
$Storage="";
$Price="";
$Quantity="";

$res=mysqli_query($link,"select * from laptops where LaptopID=$LaptopID");
while ($row=mysqli_fetch_array($res))
{
    $Brand=$row["Brand"];
    $Model=$row["Model"];
    $Processor=$row["Processor"];
    $RAM=$row["RAM"];
    $Storage=$row["Storage"];
    $Price=$row["Price"];
    $Quantity=$row["Quantity"];

}
header("location.index.php");
?>

<html lang="en" xmlns="">
<head>
    <title>User Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <!-- short column display for forms rows -->
    <!--visit https://www.w3schools.com/bootstrap/bootstrap_forms.asp search for forms template and use it.-->
    <div class="col-lg-">
        <h2>Update Laptop Data</h2>
        <form action="" method="post">
            <div class="form-group">
                <label>Brand:</label>
                <input type="text" class="form-control" name="Brand"
                       value="<?php echo $Brand; ?>">
            </div>
            <div class="form-group">
                <label>Model:</label>
                <input type="text" class="form-control" name="Model"
                       value="<?php echo $Model; ?>">
            </div>
            <div class="form-group">
                <label>Processor:</label>
                <input type="text" class="form-control" name="Processor"
                       value="<?php echo $Processor; ?>">
            </div>
            <div class="form-group">
                <label>RAM:</label>
                <input type="text" class="form-control" name="RAM"
                       value="<?php echo $RAM; ?>">
            </div>
            <div class="form-group">
                <label>Storage:</label>
                <input type="text" class="form-control" name="Storage"
                       value="<?php echo $Storage; ?>">
            </div>
            <div class="form-group">
                <label>Price:</label>
                <input type="text" class="form-control" name="Price"
                       value="<?php echo $Price; ?>">
            </div>
            <div class="form-group">
                <label>Quantity:</label>
                <input type="text" class="form-control" name="Quantity"
                       value="<?php echo $Quantity; ?>">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>

        </form>
    </div>
</div>

</body>

<?php
<?php
if (isset($_POST["update"])) {
    $Brand = mysqli_real_escape_string($link, $_POST["Brand"]);
    $Model = mysqli_real_escape_string($link, $_POST["Model"]);
    $Processor = mysqli_real_escape_string($link, $_POST["Processor"]);
    $RAM = mysqli_real_escape_string($link, $_POST["RAM"]);
    $Storage = mysqli_real_escape_string($link, $_POST["Storage"]);
    $Price = floatval($_POST["Price"]);
    $Quantity = intval($_POST["Quantity"]);

    $updateQuery = "UPDATE Laptops 
                    SET Brand='$Brand', Model='$Model', Processor='$Processor',
                        RAM='$RAM', Storage='$Storage', Price=$Price, Quantity=$Quantity
                    WHERE LaptopID=$LaptopID";

    if (mysqli_query($link, $updateQuery)) {
        echo "<script>alert('Update successful!'); window.location='index.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
}
?>

</html>