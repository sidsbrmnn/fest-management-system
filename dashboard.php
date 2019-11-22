<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <div class="container py-5">
            <h1 class="h3 font-weight-normal mb-4">Hi, <?php echo $_SESSION['user_name']; ?></h1>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
