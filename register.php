<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/db_connect.php';

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result)) {
            $error_message = 'User already exists with the given email';
        } else {
            $query = "INSERT INTO users (email, pass, full_name, phone) VALUES ('$email', '". md5($password) . "', '$full_name', '$phone')";
            $result = mysqli_query($con, $query);

            if ($result) {
                $_SESSION['user_id'] = $email;
                $_SESSION['user_name'] = $full_name;

                header('Location: dashboard.php');
            } else {
                $error_message = mysqli_error($con);
            }
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
    <title>Register - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <div class="container py-5" style="position: relative;">
            <form class="w-lg-50 w-md-75 mx-md-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-5">
                    <h2 class="h3 text-primary font-weight-normal">
                        Welcome to <span class="font-weight-semi-bold">Fest Management</span>
                    </h2>
                    <p class="text-muted">Fill out the form to get started.</p>
                </div>

                <div class="form-group">
                    <label for="full_name" class="form-label">Full name</label>
                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full name"
                        required autofocus>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                        required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="********"
                        required>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone number</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone number" required>
                </div>

                <div class="mb-4">
                    <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                        <input type="checkbox" class="custom-control-input" id="terms_checkbox" name="terms_checkbox"
                            required>
                        <label class="custom-control-label" for="terms_checkbox">
                            <small>I confirm that the information given in this form is true, complete and
                                accurate.</small>
                        </label>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="small text-muted">Already have an account?</span>
                        <a class="small" href="login.php">Log in</a>
                    </div>

                    <div class="col-6 text-right">
                        <button type="submit" class="btn btn-primary py-2">Get started</button>
                    </div>
                </div>
            </form>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
