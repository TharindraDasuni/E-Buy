<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Wishlist</title>
    <link rel="icon" href="resource\logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="home-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
            include "connection.php";


            if (isset($_SESSION["u"])) {
                $user = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;
            ?>

                <div class="offset-lg-3 col-12 col-lg-6 mt-2 text-center">
                    <label class="form-label fs-1 fw-bold" style="color:white; font-family: Spaced; font-size: 25px;">Wishlist <i class="bi bi-cart4 fs-1 text-light"></i></label>
                </div>

                <div class="row">

                    <?php
                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $user . "'");
                    $watchlist_num = $watchlist_rs->num_rows;

                    if ($watchlist_num == 0) {
                    ?>
                        <!-- empty view -->
                        <div class="offset-1 col-10 col-lg-10 rounded-5 mt-1 me-5 mb-3 singleProduct crt-box">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-12 emptyWatchlist"></div>
                                        <div class="col-12 text-center">
                                            <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                        </div>
                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                            <a href="index.php" class="btn btn-outline-secondary fs-5 fw-bold rounded-5" style="font-family: Spaced;">Start Shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- empty view -->
                    <?php
                    } else {
                        for ($x = 0; $x < $watchlist_num; $x++) {
                            $watchlist_data = $watchlist_rs->fetch_assoc();

                            // Fetch product details
                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON product.id=product_img.product_id WHERE `id`='" . $watchlist_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();

                            // Fetch address details
                            $address_rs = Database::search("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE `user_email`='" . $user . "'");
                            $address_data = $address_rs->fetch_assoc();

                            // Initialize shipping cost
                            $ship = 0;
                            if ($address_data) {
                                if ($address_data["did"] == 1) {
                                    $ship = $product_data["delivery_fee_colombo"];
                                    $shipping = $shipping + $ship;
                                } else {
                                    $ship = $product_data["delivery_fee_other"];
                                    $shipping = $shipping + $ship;
                                }
                            }

                            // Fetch seller details
                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                            $seller_data = $seller_rs->fetch_assoc();
                            $seller = $seller_data ? ($seller_data["fname"] . " " . $seller_data["lname"]) : "Unknown Seller";

                            // Fetch color details
                            $color_rs = Database::search("SELECT * FROM `color` WHERE `id`='" . $product_data["color_id"] . "'");
                            $color_data = $color_rs->fetch_assoc();

                            // Fetch condition details
                            $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                            $condition_data = $condition_rs->fetch_assoc();
                    ?>

                            <div class="offset-1 col-10 col-lg-10 rounded-5 mt-3 me-5 mb-3 singleProduct crt-box">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="row">
                                            <div class="card mb-1 mx-0 col-12 crt-card">
                                                <div class="row g-0">
                                                    <div class="col-12 mt-1 mb-1">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class=" fs-6">Seller :</span>&nbsp;
                                                                <span class=" fs-6"><?php echo $seller; ?></span>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="card-body col-md-1 mb-1">
                                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                            <img src="<?php echo $product_data["img_path"]; ?>" class="img-fluid rounded-4" style="max-width: 200px;">
                                                        </span>
                                                    </div>
                                                    <div class="card-body col-md-4 mt-4">
                                                        <div class="">
                                                            <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>
                                                            <span class="">Color : <?php echo $color_data ? $color_data["name"] : "N/A"; ?></span><br>
                                                            <span class="">Condition : <?php echo $condition_data ? $condition_data["name"] : "N/A"; ?></span><br>
                                                            <span class="text-price fw-bold fs-4">Rs. <?php echo $product_data["price"]; ?> .00</span><br>
                                                            <span class="fs-6">Delivery Fee :</span>&nbsp;
                                                            <span class="fs-6">Rs.<?php echo $ship; ?>.00</span>
                                                            <div class=" d-none" id="msgdiv">
                                                                <div class="alert-box alert-box3" role="alert" id="msg"></div>
                                                            </div><br />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="d-grid card-body row mt-4">
                                                            <button class="btn mt-3 fw-bold checkout-btn rounded-5 offset-2 col-6" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="bi bi-cart4 fs-5 text-light"></i></button>
                                                            <button class="btn btn-outline-danger offset-2 mt-3 col-6 rounded-5" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);"><i class="bi bi-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- products -->
                    <?php
                        }
                    }
                    ?>
                </div>


        </div>
    </div>

    <?php include "footer.php"; ?>

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
                                    window.location = "signin.php";
                                }
                            });
                        </script>
                    </body>
                  </html>';
            exit();
        }
            ?>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
</body>

</html>



