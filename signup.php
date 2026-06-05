<?php
session_start();
mysqli_report(MYSQLI_REPORT_OFF);

function signup_error(string $msg): void {
    $_SESSION['signup_error'] = $msg;
    $_SESSION['AddRegisterDisplay'] = 'style="display:block"';
    $_SESSION['AddLoginDisplay'] = 'style="display:none"';
    header('Location: index.php');
    exit;
}

if (empty($_POST["name"])) {
    signup_error("Username is required.");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    signup_error("A valid email address is required.");
}

if (strlen($_POST["psw"]) < 8) {
    signup_error("Password must be at least 8 characters.");
}

if (!preg_match("/[a-z]/i", $_POST["psw"])) {
    signup_error("Password must contain at least one letter.");
}

if (!preg_match("/[0-9]/", $_POST["psw"])) {
    signup_error("Password must contain at least one number.");
}

if ($_POST["psw"] !== $_POST["password_confirmation"]) {
    signup_error("Passwords do not match.");
}

$password_hash = password_hash($_POST["psw"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    signup_error("Database error. Please try again.");
}

$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

if ($stmt->execute()) {
    $_SESSION['signup_success'] = true;
    header("Location: index.php");
    exit;
} else {
    if ($mysqli->errno === 1062) {
        signup_error("Jau eksistē konts ar šādu e-pastu vai paroli.");
    } else {
        signup_error("Reģistrācija neizdevās. Lūdzu mēģiniet atkal.");
    }
}
