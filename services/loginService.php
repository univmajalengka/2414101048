<?php
include "../config/connection.php";
session_start();
$login_message = "";

if (isset($_SESSION["is_login"])) {
  header("location: ../admin/index.php");
}

if (isset($_POST["login"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"] ?? "");
  $password = $_POST["password"] ?? "";
  $enc_password = hash("sha256", $password);

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$enc_password'";

  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();

    $_SESSION["username"] = $data["username"];
    $_SESSION["is_login"] = true;

    header("location: ../admin/index.php");
    exit;
  }

  echo "<script>alert('Username atau kata sandi salah.'); window.location.href='../user/login.php';</script>";
  $conn->close();
}
