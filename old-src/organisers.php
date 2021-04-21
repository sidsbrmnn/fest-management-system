<?php
session_start();

include_once 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=organisers.php');
}

if (isset($_POST['type']) && $_POST['type'] == 'remove' && isset($_POST['organiser_id'])) {
    $organiser_id = $_POST['organiser_id'];

    $result = $db->query("DELETE FROM organisers WHERE organiser_id = '$organiser_id'");
    if (!$result) {
        $error_message = 'Organiser cannot be deleted.';
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'add') {
    $organiser_name = $_POST['organiser_name'];
    $organiser_phone = $_POST['organiser_phone'];

    $result = $db->query("INSERT INTO organisers (organiser_name, organiser_phone) VALUES ('$organiser_name', '$organiser_phone')");
    if ($result) {
        header('Location: organisers.php');
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
    <title>Organisers - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <?php include 'includes/_dash_head.php'; ?>

        <div class="container py-5" style="position: relative;">
            <h1 class="h3 d-flex align-items-center justify-content-between font-weight-normal mb-4">
                <span>Organisers</span>
                <button type="button" class="btn btn-primary btn-sm transition-3d-hover" data-toggle="modal" data-target="#newOrganiserModal">
                    <i class="fas fa-plus"></i> Add
                </button>
            </h1>
            <div class="modal fade" id="newOrganiserModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="newOrganiserForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
                            <div class="modal-header">
                                <h5 class="modal-title">New organiser</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="type" value="add">
                                <div class="form-group">
                                    <label for="organiser_name" class="form-label">Name</label>
                                    <input type="text" name="organiser_name" id="organiser_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="organiser_phone" class="form-label">Phone</label>
                                    <input type="text" name="organiser_phone" id="organiser_phone" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm-wide transition-3d-hover">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $db->query('SELECT * FROM organisers');
                    if ($result) {
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['organiser_name']; ?></td>
                                <td><?php echo $row['organiser_phone']; ?></td>
                                <td>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="organiser_id" value="<?php echo $row['organiser_id']; ?>">
                                        <input type="hidden" name="type" value="remove">
                                        <button type="submit" class="bg-transparent border-0 text-danger p-0">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php }
                        $result->close();
                    }
                    ?>
                </tbody>
            </table>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
    <script>
        $(document).ready(function() {
            $('#newOrganiserForm').validate({
                rules: {
                    organiser_name: {
                        required: true,
                    },
                    organiser_phone: {
                        required: true,
                        phoneIN: true
                    }
                }
            });
        })
    </script>
</body>

</html>
