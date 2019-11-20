<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <div class="container py-5">
        <?php if (isset($_SESSION['user_id'])) { ?>
        <h1>Hi, <?php echo $_SESSION['user_name']; ?></h1>
        <?php } ?>
    </div>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
