<?php

["db" => $db] = require_once __DIR__ . "/../src/app.php";

$is_login_error = $_SESSION["login_error"] ?? false;
unset($_SESSION["login_error"]);

if (isset($_SESSION["user_id"])) {
    header("Location: /dashboard.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Test</title>
</head>
<body>
    <?php if ($is_login_error): ?>
        <p>Login failed</p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <input type="submit" value="Login">
    </form>
    </body>
</html>
