<?php
session_start();

// Database credentials - update if needed
DB_HOST:
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'food_order';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    die('Failed to connect to MySQL: (' . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function currentUser($mysqli) {
    if (!isLoggedIn()) return null;
    $id = (int)$_SESSION['user_id'];
    $res = $mysqli->query("SELECT id,name,email,is_admin FROM users WHERE id=$id");
    return $res ? $res->fetch_assoc() : null;
}

function isAdmin($mysqli) {
    $u = currentUser($mysqli);
    return $u && $u['is_admin'] == 1;
}

function esc($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/**
 * Check whether a table exists in the current database.
 * Returns true/false and doesn't raise an exception.
 */
function tableExists($mysqli, $table) {
    $table = $mysqli->real_escape_string($table);
    $res = $mysqli->query("SHOW TABLES LIKE '$table'");
    if (!$res) return false;
    return $res->num_rows > 0;
}

/**
 * Return array of missing core tables (empty = all present)
 */
function missingCoreTables($mysqli) {
    $core = ['users','categories','products','orders','order_items'];
    $miss = [];
    foreach ($core as $t) {
        if (!tableExists($mysqli, $t)) $miss[] = $t;
    }
    return $miss;
}

?>