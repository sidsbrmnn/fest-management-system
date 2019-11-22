<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=events.php');
}

if (isset($_GET['id'])) {
    include 'includes/db_connect.php';

    $event_id = $_GET['id'];
    $query = "DELETE FROM events WHERE event_id = '$event_id'";
    mysqli_query($con, $query);

    header('Location: events.php');
}
