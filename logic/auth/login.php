<?php

include('../../config/database.php');

if (isset($_POST['submit'])) {
    $conn = connection();
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['status'] = 'login';
        header("location: ../../pages/dashboard/index.php");
    } else {
        echo "<script>alert('Invalid username or password')</script>";
        header("location: ../../pages/auth/login.php?error=Invalid username or password");
    }
}