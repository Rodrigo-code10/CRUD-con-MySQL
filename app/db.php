<?php
$host="mysql";
$user="user";
$password="password";
$database="database";

$conn=new mysqli('mysql','user','password','database');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
