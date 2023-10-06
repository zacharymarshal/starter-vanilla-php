<?php

// https://getcomposer.org/doc/01-basic-usage.md#autoloading
require_once __DIR__ . "/../vendor/autoload.php";

use App\SayIt;

use function Db\db;
use function Db\query;

$db = db((string) getenv("DATABASE_URL"));

$res = query(
    $db(),
    <<<'SQL'
        SELECT NOW()
        SQL
);
$ts = pg_fetch_row($res) ?: [];

$sayIt = new SayIt("Welcome! The time is {$ts[0]}");
$sayIt->speak();
