<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ola</h1>
<?php
echo 'hi';
include '../controllers/Users.php';
echo 'hi';
$con = mysqli_connect(
    hostname:'localhost',
    username:'root',
    password:'',
    database:'jogodobicho',
    port:3306
);
$sql = "SELECT * FROM Users WHERE id = 1";
$result = mysqli_query(mysql: $con, query: $sql);
$result;
var_dump($result->fetch_all());
echo '<br>Cotroller<br>';

var_dump(UsersController\Users::show(1)->fetch_assoc());
echo 'hi';

?>
    
</body>
</html>