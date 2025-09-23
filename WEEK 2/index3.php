<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>This is my first PHP file</h1> 
        <?php
        //http://ins3064.test/?x=5
           $x = $_GET["x"];
           $y = $_GET["y"];
           // Arithmetic operators +, -, *, /, %
           echo "x + y =" . ($x +$y) . "<br>";
           // others
           // Comparison operators: ==, !=, <, >, <=, >=
           echo "x ==y: " . ($x == $y) . "<br>";
        ?>
    </body>
</html>