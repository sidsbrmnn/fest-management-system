<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=new_participant.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Participant - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <div class="container py-5" style="position: relative;">
        <h3>New Participant</h3>

        <?php include 'includes/_error_toast.php'; ?>
    </div>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
