<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?back=users.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main>
        <?php include 'includes/_dash_head.php'; ?>

        <div class="container py-5">
            <div class="mb-4">
                <h1 class="h3"></h1>
            </div>
            <div class="row">
                <?php
                include 'includes/db_connect.php';

                $db->query("CALL calc_contribution()");

                $result = $db->query("SELECT full_name, email, contribution, COUNT(participant_id) AS participant_count FROM users LEFT JOIN participants ON users.email = participants.registered_by GROUP BY email ORDER BY full_name");

                if ($result) {
                    while ($row = $result->fetch_assoc()) { ?>
                <div class="col-lg-4">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="btn btn-icon btn-primary rounded-circle mb-2">
                                    <span class="btn-icon__inner"><?php
                                        $names = split_name($row['full_name']);
                                        echo $names[0][0] . $names[1][0];
                                        ?></span>
                                </span>
                                <h2 class="h6 mb-0"><?php echo $row['full_name']; ?></h2>
                            </div>

                            <div class="d-flex justify-content-around">
                                <div class="bg-light rounded p-3">
                                    <span class="d-block small font-weight-semi-bold small">Participants</span>
                                    <span class="lead"><?php echo $row['participant_count']; ?></span>
                                </div>
                                <div class="bg-light rounded p-3">
                                    <span class="d-block small font-weight-semi-bold">Contribution</span>
                                    <span
                                        class="lead"><?php echo isset($row['contribution']) ? '&#8377;' . $row['contribution'] : '-'; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white py-3">
                            <a class="btn btn-sm btn-outline-primary transition-3d-hover"
                                href="mail:<?php echo $row['email']; ?>">
                                <span class="far fa-envelope mr-2"></span>
                                Send a Message
                            </a>
                        </div>
                    </div>
                </div>
                <?php }
                    $result->close();
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
