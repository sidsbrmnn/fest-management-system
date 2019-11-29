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
    $organiser_id = $_POST['organiser_id'];
    $event_desc = $_POST['event_desc'];
    $event_date = $_POST['event_year'] . '-' . $_POST['event_month'] . '-' . $_POST['event_date'];

    $result = $db->query("INSERT INTO events (event_name, event_type, event_fee, category_id, event_desc, event_date, organiser_id) VALUES ('$event_name', '$event_type', '$event_fee', '$category_id', '$event_desc', '$event_date', '$organiser_id')");
    if ($result) {
        header('Location: events.php');
    } else {
        $error_message = $db->error;
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
        <?php include 'includes/_dash_head.php'; ?>

        <div class="bg-light py-5">
            <div class="container" style="position: relative;">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-4">
                        <h2 class="h4">Create an event</h1>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_name" class="form-label">Event name</label>
                                <input type="text" name="event_name" id="event_name" class="form-control"
                                    placeholder="Event X" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_type" class="form-label">Event type</label>
                                <select name="event_type" id="event_type" class="form-control custom-select" required>
                                    <option value="Individual">Individual</option>
                                    <option value="Group">Group</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_month" class="form-label">Event date</label>
                                <select name="event_month" id="event_month" class="form-control custom-select" required>
                                    <option value="" disabled>Select month</option>
                                    <option value="01">January</option>
                                    <option value="02">Febuary</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12" selected>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-group">
                                <label for="event_date" class="form-label">&nbsp;</label>
                                <select name="event_date" id="event_date" class="form-control custom-select" required>
                                    <option value="" disabled>Select date</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18" selected>18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="form-group">
                                <label for="event_year" class="form-label">&nbsp;</label>
                                <select name="event_year" id="event_year" class="form-control custom-select" required>
                                    <option value="" disabled>Select year</option>
                                    <option value="2019" selected>2019</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="event_fee" class="form-label">Event fee</label>
                                <input type="number" name="event_fee" id="event_fee" class="form-control" min="1"
                                    placeholder="100" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control custom-select" required>
                                    <option value="" disabled selected>Select category</option>
                                    <?php
                                    include 'includes/db_connect.php';

                                    $result = $db->query("SELECT * FROM categories ORDER BY category_name");
                                    if ($result) {
                                        while ($row = $result->fetch_object()) { ?>
                                    <option value="<?php echo $row->category_id; ?>">
                                        <?php echo $row->category_name; ?>
                                    </option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organiser_id" class="form-label">Organiser</label>
                                <select name="organiser_id" id="organiser_id" class="form-control custom-select"
                                    required>
                                    <option value="" disabled selected>Select organiser</option>
                                    <?php
                                    include 'includes/db_connect.php';

                                    $result = $db->query("SELECT * FROM organisers ORDER BY organiser_name");
                                    if ($result) {
                                        while ($row = $result->fetch_object()) { ?>
                                    <option value="<?php echo $row->organiser_id; ?>">
                                        <?php echo $row->organiser_name; ?>
                                    </option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="event_desc" class="form-label">Description</label>
                                <textarea name="event_desc" id="event_desc" rows="5" class="form-control"
                                    required></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm-wide transition-3d-hover mr-1">Add</button>
                    <a href="#" class="btn btn-secondary btn-sm-wide transition-3d-hover">Cancel</a>

                </form>

                <?php include 'includes/_error_toast.php'; ?>
            </div>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
