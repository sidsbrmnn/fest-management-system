<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=select_events.php');
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: select_events.php?selected=none');
}
?>
