<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">Fest Management</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') { echo 'active'; } ?>">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'events.php') { echo 'active'; } ?>">
                    <a href="events.php" class="nav-link">Events</a>
                </li>
                <?php if (isset($_SESSION['user_id'])) { ?>
                <li
                    class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'participants.php') { echo 'active'; } ?>">
                    <a href="participants.php" class="nav-link">Participants</a>
                </li>
                <li
                    class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'organisers.php') { echo 'active'; } ?>">
                    <a href="organisers.php" class="nav-link">Organisers</a>
                </li>
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'users.php') { echo 'active'; } ?>">
                    <a href="users.php" class="nav-link">Users</a>
                </li>
                <?php } ?>
            </ul>
            <?php if (isset($_SESSION['user_id'])) { ?>
            <a href="logout.php" class="btn btn-outline-light">Log out</a>
            <?php } else { ?>
            <ul class="navbar-nav">
                <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'login.php') { echo 'active'; } ?>">
                    <a href="login.php" class="nav-link">Login</a>
                </li>
                <li class="nav-item  <?php if (basename($_SERVER['PHP_SELF']) == 'register.php') { echo 'active'; } ?>">
                    <a href="register.php" class="nav-link">Register</a>
                </li>
            </ul>
            <?php } ?>
        </div>
    </div>
</nav>
