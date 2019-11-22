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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Entry Fee</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'includes/db_connect.php';

                    $query = "SELECT * FROM events NATURAL JOIN categories";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['event_name']; ?></td>
                        <td><?php echo $row['event_type']; ?></td>
                        <td><?php echo $row['event_fee']; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td>
                            <a href="view_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-primary btn-sm">
                                <i class="far fa-eye"></i> View
                            </a>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                            <a href="edit_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-warning btn-sm">
                                <i class="far fa-edit"></i> Edit
                            </a>
                            <a href="delete_event.php?id=<?php echo $row['event_id']; ?>" class="btn btn-danger btn-sm">
                                <i class="far fa-trash-alt"></i> Delete
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }
                    } else {
                        $error_message = 'Something went wrong';
                    }
                    ?>
                </tbody>
            </table>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
