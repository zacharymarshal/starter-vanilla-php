<?php

require_once __DIR__ . "/../vendor/autoload.php";

use function Db\db;
use function Db\query;

$db = db((string) getenv("DATABASE_URL"));

session_start();

return [
    "db" => $db,
];
