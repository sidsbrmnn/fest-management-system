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

    <main>
        <div class="container py-5" style="position: relative;">
            <?php
            if (isset($_GET['id'])) {
                $event_id = $_GET['id'];

                include 'includes/db_connect.php';

                $result = $db->query("SELECT * FROM events WHERE event_id = '$event_id'");
                if ($result) {
                    if ($row = $result->fetch_assoc()) { ?>
                        <h1 class="h3 font-weight-normal mb-4"><?php echo $row['event_name'] ?></h1>
                        <div class="row">
                            <div class="col">
                                <h3></h3>
                            </div>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <a href="edit_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="far fa-edit"></i> Edit
                                </a>
                                <a href="delete_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-danger btn-sm">
                                    <i class="far fa-trash-alt"></i> Delete
                                </a>
                            <?php } ?>
                        </div>
            <?php
                    } else {
                        $error_message = 'No such event found';
                    }
                } else {
                    $error_message = 'Something went wrong';
                }
            } ?>

            <?php include 'includes/_error_toast.php' ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
