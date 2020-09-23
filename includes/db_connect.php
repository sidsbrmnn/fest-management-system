<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'festmanagement';

$db = new mysqli($host, $username, $password, $database);

if ($db->connect_error) {
    die('Connect Error (' . $db->connect_errno . ')' . $db->connect_error);
}
