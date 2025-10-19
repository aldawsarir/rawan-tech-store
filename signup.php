<!DOCTYPE html>
<html lang="en">

<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('This email is already registered! Please log in.');
                window.location.href='index.php?open=login';
              </script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $email, $password);

        if ($stmt->execute()) {
            echo "<script>
  alert('Account created successfully! Please log in to continue.');
  window.location.href = 'index.php?showLogin=1';
</script>";
        } else {
            echo "<script>alert('Something went wrong while creating the account.'); window.history.back();</script>";
        }
    }

    $check->close();
    if (isset($stmt)) $stmt->close();
    $conn->close();
}
?>