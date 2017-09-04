<?php

$serverName = "127.0.0.1";
$userName = "root";
$passWord = "admin";
$dbName = "loja";

$con = new mysqli($serverName, $userName, $passWord, $dbName);

if($con->connect_error) {
	die("Canexão falhou " . $con->connect_error);
}