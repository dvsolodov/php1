<?php

function getDb()
{
    static $db = null;
    if (is_null($db)) {
        $db = @mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect: " . mysqli_connect_error());
    }
    return $db;
}

function getAll(string $sql): ?array
{
    if ($result = mysqli_query(getDb(), $sql)) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    return null;
}

function getOne(string $sql): ?array
{
    if ($result = mysqli_query(getDb(), $sql)) {
       return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    return null;
}

function executeQuery(string $sql): ?bool
{
    if (mysqli_query(getDb(), $sql) === true) {
        return true;
    }

    return null;
}

function clearString(string $string): string
{
    return strip_tags(htmlspecialchars(mysqli_escape_string(getDb(), $string)));
}
