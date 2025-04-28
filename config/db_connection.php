<?php
$host = 'mysql';
$dbname = 'ideanest_db';
$username_db = 'user';
$password_db = 'password';

$conn = new mysqli($host, $username_db, $password_db, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
