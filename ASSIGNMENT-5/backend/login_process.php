<?php
session_start();
include('db.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../admin_dashboard.php");
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that email.";
}
$conn->close();
?>
