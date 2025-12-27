<?php
session_start();
include "header.php";
$user = $_SESSION["u"];
require "connection.php";

if (isset($user)) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Buy | History</title>
        <link rel="icon" href="resource\logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />

    </head>

    <body class="home-body">

        <div class="container-fluid ">
            <div class="row">

                <div class="offset-1 col-10 mt-0 mt-lg-4 text-item mb-5">
                    <h2 class="text-center fw-bold">Purchased History</h2>
                </div>

                <?php
                $rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $user["email"] . "'");
                $num = $rs->num_rows;

                if ($num > 0) {
                    // not empty

                ?>

                    <div class="row">

                    <?php
        while ($d = $rs->fetch_assoc()) {
        ?>
                            <div class="offset-1 col-12 col-lg-10 rounded-5 mt-1 me-5 mb-3 singleProduct crt-box">
                                <div>
                                    <h5>Order Id <span class="text-info">#<?php echo $d["id"]; ?></span></h5>
                                    <p><?php echo $d["date"]; ?></p>
                                </div>

                                <div class="ps-5 pe-5">
                                    <table class="table table-hover  text-light">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col" class="text-end pe-5">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rs2 = Database::search("SELECT *, invoice.qty AS i_qty  FROM `invoice`  INNER JOIN `product` ON invoice.product_id
= product.id WHERE invoice.order_id = '" . $d["order_id"] . "'");

                                            $num2 = $rs2->num_rows;

                                            for ($i = 0; $i < $num2; $i++) {
                                                $d2 = $rs2->fetch_assoc();

                                            ?>
                                                <tr>
                                                    <td><?php echo $d2["title"]; ?></td>
                                                    <td><?php echo $d2["i_qty"]; ?></td>
                                                    <td class="text-end">Rs. <?php echo $d2["price"] * $d2["i_qty"]; ?>.00</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>

                                    </table>

                                </div>
                                <?php

                                $city_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id = city.id WHERE `user_email`='" . $user["email"] . "'");
                                $city_data = $city_rs->fetch_assoc();

                                $delivery = 0;

                                if ($city_data["district_id"] == 2) {
                                    $delivery = $d2["delivery_fee_colombo"];
                                } else {
                                    $delivery = $d2["delivery_fee_other"];
                                }

                                $t = $d2["total"];
                                $g = $t - $delivery;


                                ?>

                                <div class="pe-5">
                                    <h6 class="d-flex justify-content-end text-muted">Delivery Fee: <?php echo $delivery; ?></h6>
                                    <h5 class="d-flex justify-content-end ">Net Total: <?php echo $d["total"]; ?></h5>
                                </div>
                                <!-- oder history card -->

                            </div>
                        <?php
                        }
                        ?>
                    </div>

                <?php
                } else {
                    //empty
                ?>
                    <div class="col-12 text-center offset-lg-2  col-lg-8 rounded-5  singleProduct crt-box">
                        <h4>You have not odered anything yet</h4>
                        <a href="index.php" class="btn buy-btn mt-3">Start Shopping</a>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
        </div>

        <?php include "footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
    echo "<script>window.location.href='signin.php';</script>";
}
?>