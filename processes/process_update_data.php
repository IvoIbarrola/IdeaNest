<?php

session_start();

include '../config/db_connection.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$id = $_SESSION['user_id'];

$sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $username, $email, $password, $id);

if ($stmt->execute()) {
    $_SESSION['user_name'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    echo "<script>alert('Datos actualizados correctamente');</script>";
    echo "<script>window.location.href = '../public/views/inicio.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>