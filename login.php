<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['user'] = $row['fullname'];
            echo "<script>window.location.href='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Incorrect password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Email not found!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>