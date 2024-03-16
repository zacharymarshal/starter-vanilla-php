<?php

["db" => $db] = require_once __DIR__ . "/../src/app.php";

$user_id = App\User::lookup($db, $_POST["email"]);
if ($user_id) {
    session_regenerate_id(true);
    $_SESSION["user_id"] = $user_id;
    header("Location: /dashboard.php");
    exit;
}

$_SESSION["login_error"] = true;
header("Location: /");
