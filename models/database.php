<?php
$env = parse_ini_file(__DIR__ . '/../.env');

$db_server = $env['DB_SERVER'];
$db_user = $env['DB_USER'];
$db_pass = $env['DB_PASS'];
$db_name = $env['DB_NAME'];

try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} catch(mysqli_sql_exception) {
    die("Connection failed: " . mysqli_connect_error());
}
?>