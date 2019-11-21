<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=participants.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Participants - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <div class="container py-5" style="position: relative;">
        <h3>
            Participants
            <a href="select_events.php" class="btn btn-primary float-right"><i class="fas fa-plus"></i> New</a>
        </h3>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'includes/db_connect.php';

                $query = "SELECT * FROM participants";
                $result = mysqli_query($con, $query);

                if ($result) {
                    while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $row['participant_name']; ?></td>
                    <td><?php echo $row['participant_email']; ?></td>
                    <td><?php echo $row['participant_phone']; ?></td>
                    <td>
                        <a href="view_participant.php?id=<?php echo $row['participant_id']; ?>"
                            class="btn btn-danger btn-sm">
                            <i class="far fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>

        <?php include 'includes/_error_toast.php'; ?>
    </div>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
