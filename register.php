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
    $phone_no = $_POST['phone_no'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result)) {
            $error_message = 'User already exists with the given email';
        } else {
            $query = "INSERT INTO users (email, password, full_name, phone_no) VALUES ('$email', '". md5($password) . "', '$full_name', '$phone_no')";
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

<body class="bg-light">
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <div class="container text-center py-5" style="position: relative;">
            <h1 class="h3 font-weight-normal mb-4">Enter your details to register</h1>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-10 col-12 mx-auto">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <label for="full_name" class="sr-only">Full name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control py-4"
                                placeholder="Full name" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email address</label>
                            <input type="email" name="email" id="email" class="form-control py-4"
                                placeholder="Email address" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control py-4"
                                placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_no" class="sr-only">Phone number</label>
                            <input type="text" name="phone_no" id="phone_no" class="form-control py-4"
                                placeholder="Phone number" required>
                        </div>
                        <hr>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="agree-terms" required>
                            <label class="custom-control-label" for="agree-terms">
                                <small>I confirm that the information
                                    given in this form is true, complete and accurate.</small>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Register</button>
                    </form>
                </div>
            </div>

            <?php include 'includes/_error_toast.php'; ?>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
