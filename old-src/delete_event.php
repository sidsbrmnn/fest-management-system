<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=events.php');
}

if (isset($_GET['id'])) {
    include 'includes/db_connect.php';

    $event_id = $_GET['id'];
    $result = $db->query("DELETE FROM events WHERE event_id = '$event_id'");
    if ($result) {
        header('Location: events.php');
    } else {
        header('Location: events.php?err=' . urlencode('Cannot delete the event.'));
    }
}
