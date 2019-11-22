<?php
session_start();

include_once 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=organisers.php');
}

if (isset($_POST['type']) && $_POST['type'] == 'remove' && isset($_POST['org_id'])) {
    $org_id = $_POST['org_id'];

    $query = "DELETE FROM organisers WHERE org_id = '$org_id'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $error_message = 'Something went wrong.';
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'add') {
    $org_name = $_POST['org_name'];
    $org_email = $_POST['org_email'];
    $org_phone = $_POST['org_phone'];

    $query = "INSERT INTO organisers (org_name, org_email, org_phone) VALUES ('$org_name', '$org_email', '$org_phone')";
    $result = mysqli_query($con, $query);

    if ($result) {
        header('Location: organisers.php');
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
    <title>Organisers - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <div class="container py-5" style="position: relative;">
            <h1 class="h3 d-flex align-items-center justify-content-between font-weight-normal mb-4">
                Organisers
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newOrganiserModal">
                    <i class="fas fa-plus"></i> Add
                </button>
            </h1>
            <div class="modal fade" id="newOrganiserModal" tabindex="-1" role="dialog"
                aria-labelledby="newOrganiserLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newOrganiserLabel">Add new organiser</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="type" value="add">
                                <div class="form-group">
                                    <label for="org_name">Name</label>
                                    <input type="text" name="org_name" id="org_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="org_email">Email</label>
                                    <input type="email" name="org_email" id="org_email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="org_phone">Phone</label>
                                    <input type="text" name="org_phone" id="org_phone" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM organisers";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $row['org_name']; ?></td>
                        <td><?php echo $row['org_email']; ?></td>
                        <td><?php echo $row['org_phone']; ?></td>
                        <td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="org_id" value="<?php echo $row['org_id']; ?>">
                                <input type="hidden" name="type" value="remove">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="far fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php }
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
