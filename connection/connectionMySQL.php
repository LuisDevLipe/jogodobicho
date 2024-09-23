<?php
namespace Connection;
$con = mysqli_connect(hostname:'localhost',username:'root',password:'',database:'jogodobicho',port:3306);
if (mysqli_connect_errno()) {
    exit(''. mysqli_connect_error());
}