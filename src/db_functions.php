<?php

namespace Db;

use Exception;
use PgSql\Result;
use PgSql\Connection;

class DbException extends Exception
{
}

function pg_conn_str_from_url(string $url, int $conn_timeout = 10): string
{
    $host = parse_url($url, PHP_URL_HOST);
    $port = parse_url($url, PHP_URL_PORT) ?: 5432;
    $database = substr(parse_url($url, PHP_URL_PATH) ?: "", 1);
    $user = parse_url($url, PHP_URL_USER);
    $password = parse_url($url, PHP_URL_PASS);

    // get additional options like application_name
    parse_str(parse_url($url, PHP_URL_QUERY) ?: "", $options);
    $options_str = implode(" ", array_map(function ($arg, $val) {
        return "--{$arg}={$val}";
    }, array_keys($options), $options));

    $conn_str = "host={$host} port={$port} dbname={$database}"
          . " user={$user} password={$password}"
          . " connect_timeout={$conn_timeout}"
          . " options='{$options_str}'";

    return $conn_str;
}


function connect(string $url): Connection
{
    $conn = pg_connect(pg_conn_str_from_url($url), PGSQL_CONNECT_FORCE_NEW);
    if (!$conn) {
        throw new Exception("Failed to connect to database");
    }

    return $conn;
}

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

function db(string $db_url): callable
{
    static $db;
    return function () use ($db, $db_url): Connection {
        if ($db) {
            return $db;
        }

        $db = connect($db_url);

        return $db;
    };
}

function read_rows_assoc(Result $res, callable $cb = null): iterable
{
    while ($row = pg_fetch_assoc($res)) {
        if ($cb) {
            yield $cb($row);
        } else {
            yield $row;
        }
    }
}
