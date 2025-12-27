<?php

session_start();

require "connection.php";

if (isset($_SESSION["a"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Buy | Admin Dashboard</title>
        <link rel="icon" href="resource\logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="home-body" onload="chartLoad();">

        <!-- Nav Bar -->
        <?php include "adminNavbar.php" ?>
        <!-- Nav Bar -->

        <?php

        $today = date("Y-m-d");
        $thismonth = date("m");
        $thisyear = date("Y");

        $daily = "0";
        $monthly = "0";
        $total = "0";
        $qty = "0";
        $e = "0";
        $f = "0";

        $invoice_rs = Database::search("SELECT * FROM `invoice`");
        $invoice_num = $invoice_rs->num_rows;

        for ($x = 0; $x < $invoice_num; $x++) {
            $invoice_data = $invoice_rs->fetch_assoc();

            $f = $f + $invoice_data["qty"]; //total qty

            $d = $invoice_data["date"];
            $splitDate = explode(" ", $d); //separate date from time
            $pdate = $splitDate[0]; //sold date

            if ($pdate == $today) {
                $daily = $daily + $invoice_data["total"];
                $qty = $qty + $invoice_data["qty"];
            }

            $splitMonth = explode("-", $pdate); //separate date as year,month & date
            $pyear = $splitMonth[0]; //year
            $pmonth = $splitMonth[1]; //month

            if ($pyear == $thisyear) {
                if ($pmonth == $thismonth) {
                    $monthly = $monthly + $invoice_data["total"];
                    $e = $e + $invoice_data["qty"];
                    $total = $qty * $monthly;
                }
            }
        }

        ?>
        <div class="container-fluid">
            <div class="row mt-2">
                <!-- Chart -->
                <div class="offset-lg-1 col-12 col-lg-5 mt-lg-4 text-item align-content-between mb-5">
                    <h3 class="fw-bold text-center">Most Sold Products</h3>
                    <div class="offset-1 col-10 mt-4 border border-light rounded-4 p-5"><canvas id="myChart"></canvas>
                    </div>
                </div>
                <!-- Chart -->

                <!-- Daily Earning -->
                <div class="offset-lg-1 col-12 col-lg-4 mt-lg-4 text-item">
                    <h3 class="fw-bold text-center">Income in Day</h3>
                    <div class="offset-1  text-center  col-10 mt-4 border border-light rounded-4 p-4" style="background-color: rgb(80, 10, 99); font-family: Spaced;">

                        <span class="fs-2 text-light fw-bold"><?php echo $daily; ?>.00 LKR</span>
                    </div>
                    <!-- Daily Earning -->

                    <!-- Monthly Earning -->
                    <h3 class="fw-bold text-center mt-5">Income in Month</h3>
                    <div class="offset-1  text-center  col-10 mt-4 border border-light rounded-4 p-4" style="background-color: #ee30d1; font-family: Spaced;">

                        <span class="fs-2 text-light fw-bold"><?php echo $monthly; ?>.00 LKR</span>
                    </div>
                    <!-- Monthly Earning -->

                    <!-- Monthly Earning -->
                    <h3 class="fw-bold text-center mt-5">Total Income</h3>
                    <div class="offset-1  text-center  col-10 mt-4 border border-light rounded-4 p-4" style="background-color: white; font-family: Spaced;">

                        <span class="fs-2 text-secondary fw-bold"><?php echo $total; ?>.00 LKR</span>
                    </div>
                    <!-- Monthly Earning -->

                </div>



                <div class="offset-1 col-10 col-lg-10 mt-5 mt-lg-4 text-item mb-5">
                    <h2 class="text-center fw-bold">Reports</h2>


                    <div class="row">
                        <div class="col-12 col-lg-3 mt-3">
                            <a href="adminProductReport.php"><button class="btn search-btn text-light col-12 rounded-4 fs-4" style="height: 100px; font-family: Spaced;">Product Report</button></a>
                        </div>
                        <div class="col-12 col-lg-3 mt-3">
                            <a href="adminSellingReport.php"><button class="btn search-btn text-light col-12 rounded-4 fs-4" style="height: 100px; font-family: Spaced;">Sellings Report</button></a>
                        </div>
                        <div class="col-12 col-lg-3 mt-3">
                            <a href="adminDailyEarningsReport.php"><button class="btn search-btn text-light col-12 rounded-4 fs-4" style="height: 100px; font-family: Spaced;">Daily Earning Report</button></a>
                        </div>
                        <div class="col-12 col-lg-3 mt-3">
                            <a href="adminUserReport.php"><button class="btn search-btn text-light col-12 rounded-4 fs-4" style="height: 100px; font-family: Spaced;">User Report</button></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <?php include "footer.php"; ?>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
       
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </body>

    </html>

<?php
} else {
    echo '<html>
            <head>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            </head>
            <body>
                <script type="text/javascript">
                    Swal.fire({
                        icon: "error",
                        title: "You are Not Logged Yet!",
                        text: "Please Login First"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "adminSignin.php";
                        }
                    });
                </script>
            </body>
          </html>';
    exit();
}
?>