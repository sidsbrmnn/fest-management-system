<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/db_connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . md5($password) . "'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['user_id'] = $row['email'];
            $_SESSION['user_name'] = $row['full_name'];

            if (isset($_GET['back'])) {
                header('Location: ' . $_GET['back']);
            } else {
                header('Location: index.php');
            }
        } else {
            $error_message = 'Invalid email/password';
        }
    } else {
        $error_message = 'Something went wrong';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <div class="container py-5" style="position: relative;">
        <h3>Login</h3>
        <div class="row mt-4">
            <div class="col-md-6 col-12">
                <form
                    action="<?php echo $_SERVER['PHP_SELF'] . isset($_GET['back']) ? '?back=' . $_GET['back'] : ''; ?>"
                    method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>

        <?php include 'includes/_error_toast.php'; ?>
    </div>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
