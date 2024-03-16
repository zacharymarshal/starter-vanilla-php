<?php

namespace App;

use function Db\query;

class User {
    public static function lookup($db, string $email): ?int
    {
        $sql = <<<'SQL'
            SELECT user_id
            FROM users
            WHERE LOWER(email) = $1
            SQL;
        $res = query($db(), $sql, [strtolower($email)]);
        $row = pg_fetch_row($res);

        if (!$row) {
            return null;
        }

        return $row[0];
    }

    public static function find($db, int $user_id): ?array
    {
        $sql = <<<'SQL'
            SELECT user_id, email
            FROM users
            WHERE user_id = $1
            SQL;
        $res = query($db(), $sql, [$user_id]);
        $row = pg_fetch_assoc($res);

        if (!$row) {
            return null;
        }

        return $row;
    }
}
