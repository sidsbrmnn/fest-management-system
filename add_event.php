<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=add_event.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/db_connect.php';

    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $event_fee = $_POST['event_fee'];
    $category_id = $_POST['category_id'];

    $query = "INSERT INTO events (event_name, event_type, event_fee, category_id) VALUES ('$event_name', '$event_type', '$event_fee', '$category_id')";
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
    <title>Add Event - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <div class="container py-5" style="position: relative;">
            <h1 class="h3 font-weight-normal mb-4">Create an event</h1>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <label for="event_name">Event name</label>
                            <input type="text" name="event_name" id="event_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="event_type">Event type</label>
                            <select name="event_type" id="event_type" class="form-control" required>
                                <option value="Individual">Individual</option>
                                <option value="Group">Group</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="event_fee">Event fee</label>
                            <input type="number" name="event_fee" id="event_fee" class="form-control" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <?php
                                include 'includes/db_connect.php';
                                $query = "SELECT * FROM categories";
                                $result = mysqli_query($con, $query);

                                if ($result) {
                                    while ($row = mysqli_fetch_array($result)) { ?>
                                <option value="<?php echo $row['category_id']; ?>">
                                    <?php echo $row['category_name']; ?>
                                </option>
                                <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
