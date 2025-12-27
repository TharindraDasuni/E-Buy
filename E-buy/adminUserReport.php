<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $rs =  Database::search("SELECT * FROM `user`
    INNER JOIN `gender` ON `gender`.`id` = `user`.`gender_id`
    ORDER BY `user`.`email` ASC");

    $num = $rs->num_rows;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>E-Buy</title>
        <link rel="icon" href="resources/logo.png" />

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="resources/bootstrap_files/bootstrap.css" />
        <link rel="stylesheet" href="resources/bootstrap_files/bootstrap.min.css" />

    </head>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Buy | Daily Earnings</title>
        <link rel="icon" href="resource\logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="home-body">

        <!-- nav bar  -->
        <?php
        include "adminNavbar.php";
        ?>
        <!-- nav bar  -->

        <div class="offset-1 col-10 btn-toolbar justify-content-end mt-5">
            <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
            <button class="btn btn-danger me-5" onclick="printInvoice();"><i class="bi bi-file-earmark-pdf"></i> Export as PDF</button>
        </div>

        <div class="container" id="page">

            <div class="col-12 mt-3 mt-lg-4 text-item bg-light p-5">
                <h2 class="text-center  text-dark">
                    <link rel="icon" href="resource\logob.svg" />E-Buy User Report
                </h2>

                <table class="table border border-2 border-dark table-hover mt-5">
                    <thead class="text-center">
                        <tr>
                            <th class="border border-2 border-dark">Email</th>
                            <th class="border border-2 border-dark">First Name</th>
                            <th class="border border-2 border-dark">Last Name</th>
                            <th class="border border-2 border-dark">Mobile</th>
                            <th class="border border-2 border-dark">Joined Date</th>
                            <th class="border border-2 border-dark">Status</th>
                            <th class="border border-2 border-dark">Gender</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        for ($i = 0; $i < $num; $i++) {
                            $d = $rs->fetch_assoc();
                        ?>
                            <tr>
                                <td class="text-center border border-2 border-dark"><?php echo $d["email"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["fname"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["lname"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["mobile"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["joined_date"] ?></td>

                                <?php

                                if ($d["status"] == 1) {
                                ?>

                                    <td class="text-center border border-2 border-dark">Active User</td>

                                <?php
                                } else {
                                ?>

                                    <td class="text-center border border-2 border-dark">Inactive User</td>

                                <?php
                                }

                                ?>

                                <td class="text-center border border-2 border-dark"><?php echo $d["gender_name"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>


                </table>
            </div>
        </div>

        <?php include "footer.php"; ?>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
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