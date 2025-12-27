<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimeZone($tz);
    $date = $d->format("Y-m-d");

    $rs =  Database::search("SELECT `invoice`.`id`,`invoice`.`order_id`,`product`.`title`,`invoice`.`date`,`user`.`fname`,`user`.`lname`,`invoice`.`total`,`invoice`.`qty` FROM `invoice` INNER JOIN `product` ON
    `invoice`.`product_id` = `product`.`id`
    INNER JOIN `user` ON `user`.`email` = `invoice`.`user_email`
    WHERE `date` LIKE '" . $date . "%'
    ORDER BY `invoice`.`id` ASC");

    $num = $rs->num_rows;

?>

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
                    <link rel="icon" href="resource\logob.svg" />E-Buy Daily Earnings Report
                </h2>


                <table class="col-12 table border border-2 border-dark table-hover mt-5">
                    <thead class="text-center">
                        <tr>
                            <th class="border border-2 border-dark">Invoice ID</th>
                            <th class="border border-2 border-dark">Order Id</th>
                            <th class="border border-2 border-dark">Product Name</th>
                            <th class="border border-2 border-dark">Selling Date</th>
                            <th class="border border-2 border-dark">Buyer Name</th>
                            <th class="border border-2 border-dark">Quantity</th>
                            <th class="border border-2 border-dark">Amount</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $g_total = 0;

                        for ($i = 0; $i < $num; $i++) {
                            $d = $rs->fetch_assoc();

                            $g_total = $g_total + $d["total"];

                        ?>
                            <tr>
                                <td class="text-center border border-2 border-dark"><?php echo $d["id"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["order_id"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["title"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["date"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["fname"] . " " . $d["lname"]; ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["qty"] ?></td>
                                <td class="text-center border border-2 border-dark">Rs. <?php echo $d["total"] ?>.00</td>

                            </tr>
                        <?php
                        }
                        ?>

                        <tr>
                            <td class="text-center border border-2 border-dark fw-bold fs-5" colspan="6">Grand Total</td>
                            <td class="text-center border border-2 border-dark fw-bold fs-5">Rs. <?php echo $g_total; ?>.00</td>
                        </tr>

                    </tbody>


                </table>
            </div>
        </div>

        <?php include "footer.php"; ?>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
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