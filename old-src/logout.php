<?php
session_start();

if (isset($_SESSION['user_id'])) {
    session_destroy();
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['cart']);

    header('Location: index.php');
} else {
    header('Location: index.php');
}
