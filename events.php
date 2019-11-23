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
            <h1 class="h3 d-flex align-items-center justify-content-between font-weight-normal mb-4">
                <span>Events</span>
                <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="add_event.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                <?php } ?>
            </h1>
            <div class="row">
                <?php
                include 'includes/db_connect.php';

                $query = "SELECT * FROM events NATURAL JOIN categories";
                $result = mysqli_query($con, $query);

                if ($result) {
                    while ($row = mysqli_fetch_array($result)) { ?>
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span>
                                    <a href="view_event.php?id=<?php echo $row['event_id']; ?>"
                                        class="text-decoration-none text-dark">
                                        <?php echo $row['event_name']; ?>
                                    </a>
                                </span>
                                <?php if (isset($_SESSION['user_id'])) { ?>
                                <span class="float-right">
                                    <a href="edit_event.php?id=<?php echo $row['event_id']; ?>"
                                        class="text-decoration-none text-warning">
                                        <i class="far fa-edit fa-xs"></i>
                                    </a>
                                    <a href="delete_event.php?id=<?php echo $row['event_id']; ?>"
                                        class="text-decoration-none text-danger">
                                        <i class="far fa-trash-alt fa-xs"></i>
                                    </a>
                                </span>
                                <?php } ?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">&#8377; <?php echo $row['event_fee']; ?> -
                                <?php echo $row['event_type']; ?></h6>
                            <p class="card-text text-truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Eos, veritatis!</p>
                        </div>
                    </div>
                </div>
                <?php }
                } else {
                    $error_message = 'Something went wrong';
                }
                ?>
            </div>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
