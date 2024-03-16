<?php

require_once __DIR__ . "/../vendor/autoload.php";

use function Db\db;
use function Db\query;

$db = db((string) getenv("DATABASE_URL"));

$sql = <<<'SQL'
    CREATE TABLE IF NOT EXISTS users (
        user_id SERIAL PRIMARY KEY,
        email character varying NOT NULL
    );
    CREATE UNIQUE INDEX IF NOT EXISTS users_email_idx ON users (LOWER(email));
    SQL;
query($db(), $sql);

echo "Ran migrations\n";
