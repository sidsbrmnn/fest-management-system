<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'festmanagement';

$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die('Could not connect to the database');
}
?>
