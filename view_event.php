<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Events - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <div class="container py-5" style="position: relative;">
        <?php
        if (isset($_GET['id'])) {
            $event_id = $_GET['id'];

            include 'includes/db_connect.php';

            $query = "SELECT * FROM events WHERE event_id = '$event_id'";
            $result = mysqli_query($con, $query);

            if ($result) {
                if ($row = mysqli_fetch_array($result)) { ?>
        <h3>
            <?php echo $row['event_name'] ?>
            <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="edit_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-warning btn-sm">
                <i class="far fa-edit"></i> Edit
            </a>
            <a href="delete_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-danger btn-sm">
                <i class="far fa-trash-alt"></i> Delete
            </a>
            <?php } ?>
            <span class="d-block lead">&#8377; <?php echo $row['event_fee']; ?>
            </span>
        </h3>
        <div class="row mt-4">
            <div class="col">
                <h3></h3>
            </div>
        </div>
        <?php
                } else {
                    $error_message = 'No such event found';
                }
            } else {
                $error_message = 'Something went wrong';
            }
        }
        ?>

        <?php include 'includes/_error_toast.php' ?>
    </div>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
