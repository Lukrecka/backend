<?php

$env = parse_ini_file("db_conn.env");

foreach ($env as $key => $val) {
    $_ENV[$key] = $val;
}

?>