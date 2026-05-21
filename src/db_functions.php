<?php

namespace Db;

use Exception;
use PgSql\Result;
use PgSql\Connection;

class DbException extends Exception
{
}

function connect(string $url): Connection
{
    $conn = pg_connect($url, PGSQL_CONNECT_FORCE_NEW);
    if (!$conn) {
        throw new Exception("Failed to connect to database");
    }

    return $conn;
}

/**
 * @param array<int|string, scalar|null> $params
 */
function query(Connection $conn, string $sql, array $params = []): Result
{
    if (empty($params)) {
        $result = pg_query($conn, $sql);
    } else {
        $result = pg_query_params($conn, $sql, $params);
    }

    if ($result === false) {
        throw new DbException("Query failed: " . pg_last_error($conn));
    }

    return $result;
}

/**
 * @return callable(): Connection
 */
function db(string $db_url): callable
{
    return function () use ($db_url): Connection {
        /** @var Connection|null $db */
        static $db = null;
        if ($db !== null) {
            return $db;
        }

        $db = connect($db_url);

        return $db;
    };
}
