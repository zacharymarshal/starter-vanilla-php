<?php

["db" => $db] = require_once __DIR__ . "/../src/app.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: /");
    exit;
}

$user = App\User::find($db, $_SESSION["user_id"]);

if (!$user) {
    header("Location: /");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Test</title>
</head>
<body>
    <p>User ID: <?= $user["user_id"] ?></p>
    <p>Email: <?= $user["email"] ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
