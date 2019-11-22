<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=users.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <div class="container py-5" style="position: relative;">
            <h1 class="h3 font-weight-normal mb-4">Users</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'includes/db_connect.php';

                    $query = "SELECT * FROM users";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone_no']; ?></td>
                        <td><?php echo $row['total_amount']; ?></td>
                    </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
