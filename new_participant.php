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
        <h5 class="mt-4">Select Events</h5>
        <div class="row">
            <?php
            include 'includes/db_connect.php';

            $query = "SELECT * FROM events";
            $result = mysqli_query($con, $query);
            if ($result) {
                while ($row = mysqli_fetch_array($result)) { ?>
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['event_name']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">&#8377; <?php echo $row['event_fee']; ?></h6>
                        <p class="card-text text-truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos,
                            veritatis!</p>
                        <form action="update_cart.php" method="post">
                            <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                            <?php if (isset($_SESSION['cart'][$row['event_id']])) { ?>
                            <input type="hidden" name="type" value="remove">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-times"></i> Remove
                            </button>
                            <?php } else { ?>
                            <input type="hidden" name="type" value="add">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-check"></i> Select
                            </button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>

        <?php include 'includes/_error_toast.php'; ?>
    </div>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
