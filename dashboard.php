<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

function time_elapsed_string($datetime, $full = false) {
    date_default_timezone_set('Asia/Kolkata');
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

include 'includes/db_connect.php';

if (isset($_GET['update']) && $_GET['update'] == 'contribution') {
    $db->query('CALL calc_contribution()');
}

$goal = 10000;
$user_id = $_SESSION['user_id'];

$result = $db->query("SELECT COUNT(*) as count FROM participants WHERE registered_by = '$user_id'");
if ($result) {
    if ($row = $result->fetch_assoc()) {
        $my_participant_count = $row['count'];
    }

    $result->close();
}

$result = $db->query("SELECT contribution FROM users WHERE email = '$user_id'");
if ($result) {
    if ($row = $result->fetch_assoc()) {
        $my_total_contribution = $row['contribution'];
    }

    $result->close();
}

$result = $db->query("SELECT SUM(contribution) as contribution FROM users");
if ($result) {
    if ($row = $result->fetch_assoc()) {
        $total_contribution = $row['contribution'];
        $percentage_reached = ($total_contribution / $goal) * 100;
    }

    $result->close();
}

$participant_count = 0;
$result = $db->query("SELECT COUNT(*) AS count FROM registrations GROUP BY event_id ORDER BY COUNT(participant_id) DESC LIMIT 1");
if ($result) {
    if ($row = $result->fetch_assoc()) {
        $participant_count = $participant_count + $row['count'];
    }
    $result->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Fest Management</title>
    <?php include 'includes/_links.php'; ?>
</head>

<body>
    <?php include 'includes/_navbar.php'; ?>

    <main class="bg-light">
        <?php include 'includes/_dash_head.php'; ?>

        <div class="container py-5">
            <div class="card-deck d-block d-lg-flex">
                <div class="card border-0 shadow-sm mb-4 mb-lg-0">
                    <div class="card-body px-4 py-5">
                        <div class="d-flex align-items-center">
                            <span class="rounded-circle text-primary bg-light p-4 mr-4"><i
                                    class="fas fa-users fa-2x"></i></span>
                            <span>
                                <span class="d-block h2">
                                    <?php echo isset($my_participant_count) ? $my_participant_count : '-'; ?>
                                </span>
                                <h2 class="h6 text-secondary font-weight-normal mb-0">My participants</h2>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4 mb-lg-0">
                    <div class="card-body px-4 py-5">
                        <div class="d-flex align-items-center">
                            <span class="rounded-circle text-success bg-light p-4 mr-4"><i
                                    class="fas fa-coins fa-2x"></i></span>
                            <span>
                                <span class="d-block h2">
                                    <sup><small>&#8377;</small></sup>
                                    <?php echo isset($my_total_contribution) ? $my_total_contribution : '-'; ?>
                                </span>
                                <h2 class="h6 text-secondary font-weight-normal mb-0">My contribution</h2>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="card-deck d-block d-lg-flex">
                <div class="card border-0 shadow-sm mb-4 mb-lg-0">
                    <div class="card-body p-4">
                        <h4 class="h6 mb-0">Collection</h4>

                        <hr class="mt-3 mb-4">

                        <div class="d-block d-sm-flex justify-content-between align-items-center mb-4">
                            <div class="mb-3 mb-sm-0">
                                <span class="d-block">&#8377;</span>
                                <span
                                    class="h3 font-weight-medium"><?php echo isset($total_contribution) ? $total_contribution : '-'; ?></span>
                            </div>

                            <div class="align-self-end">
                                <div class="js-pie text-center" data-circles-text-class="content-centered-y"
                                    data-circles-value="<?php echo $percentage_reached; ?>" data-circles-max-value="100"
                                    data-circles-bg-color="rgba(0, 201, 167, 0.1)" data-circles-fg-color="#00c9a7"
                                    data-circles-radius="50" data-circles-stroke-width="4"
                                    data-circles-additional-text="%" data-circles-duration="500"
                                    data-circles-scroll-animate="true" data-circles-color="#00c9a7"
                                    data-circles-font-size="24"></div>
                            </div>
                        </div>

                        <a href="dashboard.php?update=contribution"
                            class="btn btn-block btn-primary transition-3d-hover">Update</a>
                    </div>

                    <div class="card-footer bg-white p-4">
                        <div class="text-center">
                            <label class="small text-muted">Goal:</label>
                            <small class="font-weight-medium">&#8377;<?php echo $goal; ?></small>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4 mb-lg-0">
                    <div class="card-body p-4">
                        <h4 class="h6 mb-0">Registrations</h4>

                        <hr class="mt-3 mb-4">

                        <div class="row">
                            <?php
                            $result = $db->query("SELECT event_name, COUNT(*) AS count FROM registrations NATURAL JOIN events GROUP BY event_id ORDER BY COUNT(participant_id) DESC LIMIT 4");

                            if ($result) {
                                while ($row = $result->fetch_assoc()) { ?>
                            <div class="col-3">
                                <div class="js-vr-progress progress-vertical rounded" data-toggle="tooltip"
                                    data-placement="right"
                                    title="<?php echo $row['event_name']; ?> (<?php echo $row['count']; ?>)">
                                    <div class="js-vr-progress-bar bg-primary rounded-bottom" role="progressbar"
                                        style="height: <?php echo $row['count'] / $participant_count * 100; ?>%"
                                        aria-valuenow="<?php echo $row['count'] / $participant_count * 100; ?>"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                                $result->close();
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="h6 mb-0">Recent Activity</h4>

                        <hr class="mt-3 mb-4">

                        <div class="overflow-hidden">
                            <div class="js-scrollbar pr-3" style="max-height: 250px;">
                                <ul class="list-unstyled u-indicator-vertical-dashed">
                                    <?php
                                    $result = $db->query("SELECT full_name, log_message, log_time FROM logs INNER JOIN users ON log_user = email ORDER BY log_time DESC");

                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) { ?>
                                    <li class="media u-indicator-vertical-dashed-item">
                                        <span class="btn btn-xs btn-icon btn-primary rounded-circle mr-3">
                                            <span class="btn-icon__inner"><?php echo $row['full_name'][0]; ?></span>
                                        </span>
                                        <div class="media-body">
                                            <h5 class="my-1" style="font-size: 0.875rem;">
                                                <?php echo $row['full_name']; ?></h5>
                                            <p class="small mb-1"><?php echo $row['log_message']; ?></p>
                                            <small
                                                class="d-block text-muted"><?php echo time_elapsed_string($row['log_time']); ?></small>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                        $result->close();
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
