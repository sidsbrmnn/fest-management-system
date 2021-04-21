<?php
session_start();

if (isset($_GET['err'])) {
    $error_message = $_GET['err'];
}
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

                $result = $db->query('SELECT * FROM events NATURAL JOIN categories ORDER BY event_name');
                if ($result) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h4 class="h6">
                                                <a href="view_event.php?id=<?php echo $row['event_id']; ?>"><?php echo $row['event_name']; ?></a>
                                            </h4>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-light bg-white border-0" type="button" data-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm">
                                                    <!-- <a href="edit_event.php?id=<?php // echo $row['event_id']; 
                                                                                    ?>"
                                                class="dropdown-item">
                                                <small class="fas fa-edit dropdown-item-icon"></small> Edit
                                            </a> -->
                                                    <a href="delete_event.php?id=<?php echo $row['event_id']; ?>" class="dropdown-item">
                                                        <small class="fas fa-trash-alt dropdown-item-icon"></small> Delete</a>
                                                    <a href="#" class="dropdown-item">Link 3</a>
                                                </div>
                                            </div>
                                            <h6 class="card-subtitle mb-2 text-muted">&#8377;
                                                <?= $row['event_fee'] ?>
                                                -
                                                <?= $row['event_type'] ?>
                                            </h6>
                                            <p class="card-text overflow-hidden" style="height: 48px;">
                                                <?= $row['event_desc'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                    $result->close();
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
