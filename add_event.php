<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: events.php');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a href="index.php" class="navbar-brand">Fest Management</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="events.php" class="nav-link">Events</a></li>
                </ul>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Log out</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h3>Add Event</h3>
        <div class="row mt-4">
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
                <?php if (isset($error_message)) { ?>
                <small class="d-block text-danger mt-2">
                    <?php echo $error_message; ?>
                </small>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
