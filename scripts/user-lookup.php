<?php

["db" => $db] = require_once __DIR__ . "/../src/app.php";

$email = $argv[1] ?? null;

if (!$email) {
    echo "Usage: php user-lookup.php <email>" . PHP_EOL;
    exit(1);
}

$user_id = App\User::lookup($db, $email);
if (!$user_id) {
    echo "User not found" . PHP_EOL;
    exit(1);
}

$user = App\User::find($db, $user_id);
if (!$user) {
    echo "User not found" . PHP_EOL;
    exit(1);
}

echo "User ID: {$user["user_id"]}" . PHP_EOL;
echo "Email: {$user["email"]}" . PHP_EOL;
