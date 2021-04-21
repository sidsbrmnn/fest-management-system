<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a href="index.php" class="navbar-brand">Fest Management</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <?php if (isset($_SESSION['user_id'])) { ?>
                <li
                    class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
    echo 'active';
} ?>">
                    <a href="dashboard.php" class="nav-link">Home</a>
                </li>
                <?php } else { ?>
                <li
                    class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') {
    echo 'active';
} ?>">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <?php } ?>
                <li
                    class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'events.php') {
    echo 'active';
} ?>">
                    <a href="events.php" class="nav-link">Events</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])) { ?>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Log out <i
                            class="fas fa-sign-out-alt"></i></a>
                </li>
                <?php } else { ?>
                <li
                    class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'login.php') {
    echo 'active';
} ?>">
                    <a href="login.php" class="nav-link">Login</a>
                </li>
                <li
                    class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'register.php') {
    echo 'active';
} ?>">
                    <a href="register.php" class="nav-link">Register</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
