<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/db_connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '" . $email . "' AND pass = '" . md5($password) . "'";
    $result = $db->query($query);

    if ($result) {
        if ($row = $result->fetch_assoc()) {
            $_SESSION['user_id'] = $row['email'];
            $_SESSION['user_name'] = $row['full_name'];

            if (isset($_GET['back'])) {
                header('Location: ' . $_GET['back']);
            } else {
                header('Location: dashboard.php');
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

    <main>
        <div class="container py-5" style="position: relative;">
            <form class="w-lg-50 w-md-75 mx-md-auto"
                action="<?php echo isset($_GET['back']) ? $_SERVER['PHP_SELF'] . '?back=' . $_GET['back'] : $_SERVER['PHP_SELF'];?><?php echo '' ?>"
                method="post">
                <div class="mb-5">
                    <h2 class="h3 text-primary font-weight-normal">
                        Welcome <span class="font-weight-semi-bold">back</span>
                    </h2>
                    <p class="text-muted">Login to continue.</p>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                        required autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********"
                        required>
                </div>

                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="small text-muted">Don't have an account?</span>
                        <a class="small" href="register.php">Sign up</a>
                    </div>

                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary py-2">Log in</button>
                    </div>
                </div>
            </form>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
