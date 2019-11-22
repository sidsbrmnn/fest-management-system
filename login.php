<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
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
            <h1 class="h3 text-center font-weight-normal mb-4">Please sign in</h1>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-10 col-12 mx-auto">
                    <form
                        action="<?php echo isset($_GET['back']) ? $_SERVER['PHP_SELF'] . '?back=' . $_GET['back'] : $_SERVER['PHP_SELF'];?><?php echo '' ?>"
                        method="post">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email address</label>
                            <input type="email" name="email" id="email" class="form-control py-4"
                                placeholder="Email address" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control py-4"
                                placeholder="Password" required>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                    </form>
                </div>
            </div>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
