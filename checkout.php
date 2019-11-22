<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=select_events.php');
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $err = urlencode('Select at least one event');
    header('Location: select_events.php?err=' . $err);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    include 'includes/db_connect.php';

    $participant_name = $_POST['participant_name'];
    $participant_email = $_POST['participant_email'];
    $participant_phone = $_POST['participant_phone'];
    $registered_by = $_POST['user_id'];

    $query = "INSERT INTO participants (participant_name, participant_email, participant_phone, registered_by) VALUES ('$participant_name', '$participant_email', '$participant_phone', '$registered_by')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $participant_id = mysqli_insert_id($con);

        foreach ($cart as $event_id => $event) {
            $query = "INSERT INTO registrations (participant_id, event_id) VALUES ('$participant_id', '$event_id')";
            $result = mysqli_query($con, $query);

            if (!$result) {
                $error_message = 'Failed to register for ' . $event['event_name'];
            }
        }

        unset($_SESSION['cart']);
        header('Location: registrations.php');
    } else {
        $error_message = mysqli_error($con);
    }
}

$total_amount = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <div class="container py-5" style="position: relative;">
            <h1 class="h3 font-weight-normal mb-4">Checkout Form</h1>
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center font-weight-normal mb-3">
                        <span class="text-muted">Selected events</span>
                        <span class="badge badge-secondary badge-pill"><?php echo count($_SESSION['cart']); ?></span>
                    </h4>
                    <ul class="list-group">
                        <?php foreach ($_SESSION['cart'] as $event_id => $event) {
                            $total_amount = $total_amount + $event['event_fee']; ?>
                        <li class="list-group-item d-flex justify-content-between" style="line-height: 1.25;">
                            <div>
                                <h6 class="mb-0"><?php echo $event['event_name']; ?></h6>
                                <small class="text-muted"><?php echo $event['event_type']; ?></small>
                            </div>
                            <span class="text-muted">&#8377;<?php echo $event['event_fee']; ?></span>
                        </li>
                        <?php } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (INR)</span>
                            <strong>&#8377;<?php echo $total_amount; ?></strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="font-weight-normal mb-3">Participant details</h4>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <div class="form-group">
                            <label for="participant_name">Name</label>
                            <input type="text" name="participant_name" id="participant_name" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="participant_email">Email</label>
                            <input type="email" name="participant_email" id="participant_email" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="participant_phone">Phone no</label>
                            <input type="text" name="participant_phone" id="participant_phone" class="form-control"
                                required>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Continue</button>
                    </form>
                </div>
            </div>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
