<?php
session_start();
require_once 'database.php';
require 'functions.php';

if (isset($_SESSION['advisor'])) {
    header("Location: advisor.php");
    exit();
} elseif (isset($_SESSION['staff'])) {
    header("Location: staff.php");
    exit();
} elseif (!isset($_SESSION['student'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Invoice Info</title>
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Header -->
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4">
                <!-- Logo -->
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <i class="bi bi-circle-fill dark-blue-text" style="font-size: 3rem;"></i>
                    <span class="fs-1 fw-bold dark-blue-text" style="padding-left: 0.5rem;">UWindsor HMS</span>
                </a>

                <!-- Tabs -->
                <ul class="nav nav-tabs my-auto ms-4 mb-3" >
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="student.php" role="tab" aria-selected="false">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="student_advisor.php" aria-selected="false">
                            Advisor
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link " href="student_leases.php" aria-selected="false">
                            Leases
                        </a>
                    </li>
                </ul>  

                <!-- Logout Buttons -->
                <div class="my-auto ms-4">
                    <a class="btn btn-lg text-light dark-blue-bg" role="button" aria-expanded="false" href="logout.php">
                        Logout
                    </a>
                </div>
            </header>
        </div>
    
        <!-- Body -->
        <div class="container py-4">
            <!-- Invoice info -->
            <div class="row align-items-md-stretch">
                <div class="col-md-5">
                    <img src="images/invoice.jpeg" class="img-fluid" alt="Leases image">
                </div>
                <div class="col-md-7 p-5 mb-4 bg-light rounded-3">
                    <?php
                        echo '<h1 class="display-5 text-center fw-bold pb-2">Invoice #'.$_GET['invoice_id'].'</h1>';
                    ?>
                    <table class="table table-borderless">
                        <tbody>
                            <?php
                                $result = $connection->query("SELECT * FROM Invoice WHERE invoice_num=".$_GET['invoice_id']."");
                                $row = $result->fetch_assoc();

                                echo '<tr>';
                                echo '<td class="fw-bold fs-4">Student ID</td>';
                                echo '<td class="fs-4">'.$row["student_id"].'</td>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td class="fw-bold fs-4">Payment Due</td>';
                                echo '<td class="fs-4">'.$row["payment_due"].'</td>';
                                echo '</tr>';

                                echo '<tr>';
                                echo '<td class="fw-bold fs-4">Semester</td>';
                                echo '<td class="fs-4">'.$row["semester"].'</td>';
                                echo '</tr>';

                            ?>
                        </tbody>
                    </table>

                    <!-- Lease button -->
                    <?php
                        // get invoice num
                        $result_leases = $connection->query("SELECT l.lease_num FROM Invoice i, Leases l WHERE i.invoice_num=".$_GET['invoice_id']." AND i.lease_num=l.lease_num");
                        $row_leases = $result_leases->fetch_assoc();

                        echo '<a href="lease_info.php?lease_id=' . $row_leases["lease_num"] . '" class="btn btn-primary btn-lg w-100 mb-4" role="button">Lease</a>';
                    ?>

                    <!-- Receipt button -->
                    <?php
                        // get receipt num
                        $result_receipt = $connection->query("SELECT receipt_num FROM Receipt WHERE invoice_num=".$_GET['invoice_id']."");
                        // $row_receipt = $result_receipt->fetch_assoc();

                        if ($row_receipt = $result_receipt->fetch_assoc()) {
                            echo '<a href="reciept_info.php?reciept_id=' . $row_receipt["receipt_num"] . '" class="btn btn-primary btn-lg w-100" role="button">Receipt</a>';
                        }
                    ?>

                </div>
            </div>

        </div>

    </body>

</html>