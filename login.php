<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["psw"])) {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $mysqli = require __DIR__ . "/database.php";

    $email = $_POST["email"] ?? "";
    $psw = $_POST["psw"] ?? "";

    $stmt = $mysqli->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($psw, $user["password_hash"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        header("Location: index.php");
        exit;
    }

    $_SESSION["login_failed"] = true;
    $_SESSION["AddLoginDisplay"] = 'style="display:block"';
    header("Location: index.php");
    exit;
}
