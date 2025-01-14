<?php
session_start();
require_once 'database.php';

if (isset($_SESSION['staff'])) {
    header("Location: staff.php");
    exit();
} elseif (isset($_SESSION['student'])) {
    header("Location: student.php");
    exit();
} elseif (!isset($_SESSION['advisor'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Advisor Student View Info</title>
        <link rel="stylesheet" href="css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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
                        <a class="nav-link" href="advisor.php" role="tab" aria-selected="false">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="advisor_view_of_students.php" aria-selected="false">
                            Students
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
            <div class="row align-items-md-stretch">
                <div class="col-md-5">
                    <img src="images/profile.jpeg" class="img-fluid" alt="Profile image">
                </div>
                <!-- Student Profile -->
                <div class="col-md-7 p-5 mb-4 bg-light rounded-3">
                    <h1 class="display-5 text-center fw-bold pb-2">Student Profile</h1>
                    <table class="table table-borderless">
                        <tbody>
                            <?php
                                 $result = $connection->query("SELECT * FROM Student WHERE advisor_id=".$_SESSION['advisor']."");

                                while($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td class="fw-bold fs-4">Name</td>';
                                    echo '<td class="fs-4">'.$row["student_fname"].' '.$row["student_lname"].'</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td class="fw-bold fs-4">Student ID</td>';
                                    echo '<td class="fs-4">'.$row["student_id"].'</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td class="fw-bold fs-4">Birthday</td>';
                                    echo '<td class="fs-4">'.$row["DOB"].'</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td class="fw-bold fs-4">Gender</td>';
                                    echo '<td class="fs-4">'.$row["gender"].'</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td class="fw-bold fs-4">Degree</td>';
                                    echo '<td class="fs-4">'.$row["program"].' - '.$row["deg_category"].'</td>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo '<td class="fw-bold fs-4">Room Status</td>';
                                    echo '<td class="fs-4">'.$row["current_status"].'</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
   

    </body>
</html>