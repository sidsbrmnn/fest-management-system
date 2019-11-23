<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

include 'includes/db_connect.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT COUNT(*) as count FROM participants WHERE registered_by = '$user_id'";
$result = mysqli_query($con, $query);

if ($result) {
    if ($row = mysqli_fetch_array($result)) {
        $my_participant_count = $row['count'];
    }
}

$query = "SELECT SUM(event_fee) as contribution FROM participants NATURAL JOIN registrations NATURAL JOIN events WHERE registered_by = '$user_id'";
$result = mysqli_query($con, $query);

if ($result) {
    if ($row = mysqli_fetch_array($result)) {
        $my_total_contribution = $row['contribution'];
    }
}

$query = "SELECT SUM(event_fee) as contribution FROM registrations NATURAL JOIN events";
$result = mysqli_query($con, $query);

if ($result) {
    if ($row = mysqli_fetch_array($result)) {
        $total_contribution = $row['contribution'];
    }
}

$goal = 10000;

if (isset($total_contribution)) {
    $percentage_reached = ($total_contribution / $goal) * 100;
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
        <div class="bg-primary">
            <div class="container py-5">
                <div class="row">
                    <div class="col d-flex align-items-end justify-content-between">
                        <span>
                            <h1 class="h3 text-white font-weight-medium mb-2">Howdy,
                                <?php echo $_SESSION['user_name']; ?></h1>
                            <span class="d-block text-white"><?php echo $_SESSION['user_id']; ?></span>
                        </span>
                        <a class="btn btn-outline-light btn-sm transition-3d-hover" href="select_events.php">
                            <span class="fas fa-plus small mr-2"></span>
                            New Registration
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
                                <h2 class="h6 text-secondary font-weight-normal mb-0">Total participants</h2>
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
                                <h2 class="h6 text-secondary font-weight-normal mb-0">Total contribution</h2>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- <div class="card border-0 shadow-sm">
                    <div class="card-body px-4 py-5">
                        <div class="d-flex align-items-center">
                            <span class="rounded-circle text-warning bg-light p-4 mr-4"><i
                                    class="fas fa-coins fa-2x"></i></span>
                            <span>
                                <span class="d-block h2">8723</span>
                                <h2 class="h6 text-secondary font-weight-normal mb-0">Lorem, ipsum.</h2>
                            </span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="container py-5">
            <div class="card-deck d-block d-lg-flex">
                <div class="card border-0 shadow-sm mb-4 mb-lg-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="h6">Collection</h4>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon btn-outline-dark border-0" type="button"
                                    data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm">
                                    <a href="#" class="dropdown-item">
                                        <small class="fas fa-cogs dropdown-item-icon"></small> Link 1
                                    </a>
                                    <a href="#" class="dropdown-item">Link 2</a>
                                    <a href="#" class="dropdown-item">Link 3</a>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-2 mb-4">

                        <div class="d-block d-sm-flex justify-content-between align-items-center">
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
                                    data-circles-additional-text="%" data-circles-duration="1000"
                                    data-circles-scroll-animate="true" data-circles-color="#00c9a7"
                                    data-circles-font-size="24"></div>
                            </div>
                        </div>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="h6">Registrations</h4>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon btn-outline-dark border-0" type="button"
                                    data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm">
                                    <a href="#" class="dropdown-item">
                                        <small class="fas fa-cogs dropdown-item-icon"></small> Link 1
                                    </a>
                                    <a href="#" class="dropdown-item">Link 2</a>
                                    <a href="#" class="dropdown-item">Link 3</a>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-2 mb-4">

                        <div class="row">
                            <div class="col-12">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-sm"></div>
            </div>
        </div>
    </main>

    <?php include 'includes/_scripts.php'; ?>
</body>

</html>
