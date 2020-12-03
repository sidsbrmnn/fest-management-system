<?php
session_start();

include_once 'includes/db_connect.php';

if (isset($_POST['type']) && $_POST['type'] == 'add' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $query = "SELECT event_name, event_fee, event_type FROM events WHERE event_id = '$event_id'";
    $result = $db->query($query);

    if ($result) {
        if ($row = $result->fetch_assoc()) {
            $_SESSION['cart'][$event_id]['event_name'] = $row['event_name'];
            $_SESSION['cart'][$event_id]['event_fee'] = $row['event_fee'];
            $_SESSION['cart'][$event_id]['event_type'] = $row['event_type'];

            header('Location: select_events.php');
        }
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'remove' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    if (isset($_SESSION['cart'][$event_id])) {
        unset($_SESSION['cart'][$event_id]);
    }

    header('Location: select_events.php');
}
?>
