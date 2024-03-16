<?php

["db" => $db] = require_once __DIR__ . "/../src/app.php";

session_destroy();
header("Location: /");
