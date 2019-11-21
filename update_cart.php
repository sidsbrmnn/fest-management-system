<?php
session_start();

include_once 'includes/db_connect.php';

if (isset($_POST['type']) && $_POST['type'] == 'add' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $query = "SELECT event_name, event_fee FROM events WHERE event_id = '$event_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['cart'][$event_id] = $row;

            header('Location: new_participant.php');
        }
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'remove' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    if (isset($_SESSION['cart'][$event_id])) {
        unset($_SESSION['cart'][$event_id]);
    }

    header('Location: new_participant.php');
}
?>
