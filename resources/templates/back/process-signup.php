<?php

// Validate Username
if (empty($_POST["username"])) {
  die("Username is required");
}

// Validate email
// if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
//   die("Valid email is required");
// }

if (strlen($_POST["password"]) < 8) {
  die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
  die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/i", $_POST["password"])) {
  die("Password must contain at least one letter");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
  die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

require_once __DIR__ . "../../../config.php";

// Using the global connection object
global $connection;



$sql = "INSERT INTO users (user_name, user_email, user_password_hash, created_at)
        VALUES (?, ?, ?, ?)";

$stmt = $connection->stmt_init();


if (!$stmt->prepare($sql)) {
  die("SQL error: " . $connection->error);
}

$created_at = date('Y-m-d H:i:s');

$stmt->bind_param(
  "ssss",
  $_POST["username"],
  $_POST["email"],
  $password_hash,
  $created_at
);

if ($stmt->execute()) {

  header("Location: ../../../public/");
  header("Location: ../../../public/index.php");
  exit;
} else {

  if ($connection->errno === 1062) {
    die("Email already taken");
  } else {
    die($connection->error . " " . $connection->errno);
  }
}
