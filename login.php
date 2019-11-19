<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/db_connect.php';

    $email = mysqli_real_escape_string($_POST['email']);
    $password = mysqli_real_escape_string($_POST['password']);

    $query = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '". md5($password) . "'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['user_id'] = $row['email'];
            $_SESSION['user_name'] = $row['full_name'];

            header('Location: index.php');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a href="index.php" class="navbar-brand">Fest Management</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="events.php" class="nav-link">Events</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="login.php" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h3>Login</h3>
        <div class="row mt-4">
            <div class="col-md-6 col-12">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
