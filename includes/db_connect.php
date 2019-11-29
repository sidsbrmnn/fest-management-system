<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'festmanagement';

$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die('Could not connect to the database');
}

$db = new mysqli('localhost', 'root', '', 'festmanagement');

if ($db->connect_error) {
    die('Connect Error (' . $db->connect_errno . ')' . $db->connect_error);
}
?>
