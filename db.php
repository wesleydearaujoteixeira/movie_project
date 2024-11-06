<?php

$db_name = "movie";
$db_host = "localhost";
$user  = "root";
$password = "";


$conn = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $user, $password);


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);




?>