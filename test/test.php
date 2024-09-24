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
echo "hi";
include "../controllers/Users.php";
include "../controllers/Credentials.php";

$username = "lipe";
$password = "0000";

$credentials = new Credentials($username, $password);
$user_id = $credentials->login();
echo $user_id;

echo "<br> Welcome " . $_SESSION["username"] . "<br>";

echo "bye";
?>

</body>
</html>
