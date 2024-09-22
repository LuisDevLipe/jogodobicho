<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "jogodobicho";
$port = 3306;

$con = mysqli_connect(hostname: $host, username: $user, password: $pass, database: $db, port: $port);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
