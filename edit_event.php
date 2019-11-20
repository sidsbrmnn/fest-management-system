<?php
session_start();

include_once 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=edit_event.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $event_fee = $_POST['event_fee'];
    $category_id = $_POST['category_id'];

    $query = "UPDATE events SET event_name = '$event_name', event_type = '$event_type', event_fee = '$event_fee', category_id = '$category_id' WHERE event_id = '$event_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        header('Location: events.php');
    } else {
        $error_message = mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Event - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <div class="container py-5" style="position: relative;">
        <?php
        if (isset($_GET['id'])) {
            $event_id = $_GET['id'];

            $query = "SELECT * FROM events WHERE event_id = '$event_id'";
            $result = mysqli_query($con, $query);

            if ($result) {
                if ($row = mysqli_fetch_array($result)) { ?>
        <h3>Edit <?php echo $row['event_name']; ?></h3>
        <div class="row mt-4">
            <div class="col-lg-6 col-12">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                    <div class="form-group">
                        <label for="event_name">Event name</label>
                        <input type="text" name="event_name" id="event_name" class="form-control"
                            value="<?php echo $row['event_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="event_type">Event type</label>
                        <select name="event_type" id="event_type" class="form-control" required>
                            <option <?php if ($row['event_type'] == 'Individual') { echo 'selected'; } ?>
                                value="Individual">Individual</option>
                            <option <?php if ($row['event_type'] == 'Group') { echo 'selected'; } ?> value="Group">Group
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="event_fee">Event fee</label>
                        <input type="number" name="event_fee" id="event_fee" class="form-control" min="1"
                            value="<?php echo $row['event_fee']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <?php
                            $query = "SELECT * FROM categories";
                            $result_cat = mysqli_query($con, $query);

                            if ($result_cat) {
                                while ($row_cat = mysqli_fetch_array($result_cat)) { ?>
                            <option <?php if ($row['category_id'] == $row_cat['category_id']) { echo 'selected'; } ?>
                                value="<?php echo $row_cat['category_id']; ?>">
                                <?php echo $row_cat['category_name']; ?>
                            </option>
                            <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <?php
                }
            }
        }
        ?>

        <?php include 'includes/_error_toast.php'; ?>
    </div>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
