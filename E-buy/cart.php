<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Cart</title>
    <link rel="icon" href="resource\logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="home-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
if (isset($_SESSION["u"])) {
            include "connection.php";

                $user = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;
            ?>

                <div class="offset-1 col-12 col-lg-6 mt-2">
                        <label class="form-label fs-2 fw-bold" style="color:white; font-family: Spaced; font-size: 25px;">Cart <i class="bi bi-cart4 fs-2 text-light"></i></label>
                    </div>
                
                <div class="row">
                    <div class="offset-1 col-12 col-lg-6 rounded-5 mt-1 me-5 mb-3 singleProduct crt-box">
                        <div class="row">

                            <!-- <div class="col-12 col-lg-6">
                            <hr />
                        </div>

                        <div class="col-12">
                            <hr />
                        </div> -->

                            <?php

                            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                            $cart_num = $cart_rs->num_rows;

                            if ($cart_num == 0) {
                            ?>
                                <!-- Empty View -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 emptyCart my-5"></div>
                                        <div class="col-12 text-center mb-2">
                                            <label class="form-label fs-5 ">
                                                You have no items in your Cart yet.
                                            </label>
                                        </div>
                                        <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                            <a href="index.php" class="btn btn-outline-secondary fs-5 fw-bold rounded-5" style="font-family: Spaced;">
                                                Start Shopping
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Empty View -->
                            <?php
                            } else {
                            ?>
                                <!-- products -->
                                <div class="col-12 col-lg-12">
                                    <div class="row">

                                        <?php

                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_data = $cart_rs->fetch_assoc();

                                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                        product.id=product_img.product_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                            $address_rs = Database::search("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON 
                                    user_has_address.city_id=city.id INNER JOIN `district` ON 
                                    city.district_id=district.id WHERE `user_email`='" . $user . "'");
                                            $address_data = $address_rs->fetch_assoc();

                                            $ship = 0;

                                            if ($address_data["did"] == 1) {
                                                $ship = $product_data["delivery_fee_colombo"];
                                                $shipping = $shipping + $ship;
                                            } else {
                                                $ship = $product_data["delivery_fee_other"];
                                                $shipping = $shipping + $ship;
                                            }

                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                            $seller_data = $seller_rs->fetch_assoc();
                                            $seller = $seller_data["fname"] . " " . $seller_data["lname"];


                                            $color_rs = Database::search("SELECT * FROM `color` WHERE 
                                                            `id`='" . $product_data["color_id"] . "'");
                                            $color_data = $color_rs->fetch_assoc();

                                            $condition_rs = Database::search("SELECT * FROM `condition` WHERE 
                                                            `id`='" . $product_data["condition_id"] . "'");
                                            $condition_data = $condition_rs->fetch_assoc();

                                        ?>
                                            <div class="card mb-3 mx-0 col-12 crt-card">
                                                <div class="row g-0">
                                                    <div class="col-md-12 mt-3 mb-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class=" fs-6">Seller :</span>&nbsp;
                                                                <span class=" fs-6"><?php echo $seller; ?></span>&nbsp;
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="card-body col-md-4 mb-3">

                                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                            <img src="<?php echo $product_data["img_path"]; ?>" class="img-fluid rounded-4" style="max-width: 200px;">
                                                        </span>

                                                    </div>
                                                    <div class="card-body col-md-5">
                                                        <div class="">

                                                            <h3 class="card-title"><?php echo $product_data["title"]; ?></h3>

                                                            <span class="">Color : <?php echo $color_data["name"] ?></span>
                                                            <br>
                                                            <span class="">Condition : <?php echo $condition_data["name"] ?></span>
                                                            <br>
                                                            <!-- <span class=" fs-5">Price :</span>&nbsp; -->
                                                            <span class="text-price fw-bold fs-4">Rs. <?php echo $product_data["price"]; ?> .00</span></br>
                                                            <span class="fs-6">Delivery Fee :</span>&nbsp;
                                                            <span class="fs-6">Rs.<?php echo $ship; ?>.00</span>

                                                            <div class=" d-none" id="msgdiv">
                                                                <div class="alert-box alert-box3" role="alert" id="msg"></div>                                     
                                                            </div>
                                                            <div class="d-flex align-items-center gap-1 mt-3" id="loadQty();">
                                                                <button class="btn btn-dark btn-sm text-white fw-bold" onclick="decrementCartQty('<?php echo $cart_data['id']; ?>');">-</button>
                                                                <input type="number" id="qty<?php echo $cart_data['id']; ?>" class="form-control form-control-sm text-center bg-dark border-dark text-white" style="max-width: 100px;" value="<?php echo $cart_data["qty"] ?>" disabled>
                                                                <button class="btn btn-dark btn-sm text-white fw-bold" onclick="incrementCartQty('<?php echo $cart_data['id']; ?>');">+</button>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="d-grid card-body ">
                                                            <a class="btn btn-outline-danger offset-7  col-4" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);"><i class="bi bi-trash"></i></a>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="col-md-12 mb-3">
                                                        <div class="row">
                                                            <div class="col-6 col-md-6">
                                                                <span class=" fs-5 text-light">Total <i class="bi bi-info-circle"></i></span>
                                                            </div>
                                                            <div class="col-6 col-md-6 text-end">
                                                                <span class="fw-bold fs-5 text-light">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php

                                        }

                                        ?>

                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- products -->

                    <!-- summary -->
                    <div class=" col-12 col-lg-4 rounded-5 mt-2 mb-3 singleProduct crt-box">
                        <div class="row">

                            <div class="offset-4 col-6 rounded-5">
                                <label class="form-label fs-3 fw-bold mt-1 mb-0" style="color:white; font-family: Spaced;">Summary</label>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-6 mb-3">
                                <span class="fs-6 ">Items Count</span>
                            </div>

                            <div class="col-6 text-end mb-3">
                                <span class="fs-6 "><?php echo $cart_num; ?></span>
                            </div>

                            <div class="col-6 mb-3">
                                <span class="fs-6 ">Subtotal</span>
                            </div>

                            <div class="col-6 text-end mb-3">
                                <span class="fs-6 ">Rs. <?php echo $total; ?> .00</span>
                            </div>

                            <div class="col-6">
                                <span class="fs-6 ">Total Shipping</span>
                            </div>

                            <div class="col-6 text-end">
                                <span class="fs-6 ">Rs. <?php echo $shipping; ?> .00</span>
                            </div>

                            <div class="col-12 mt-3">
                                <hr />
                            </div>

                            <div class="col-6 mt-2">
                                <span class="fs-5 fw-bold">Total</span>
                            </div>

                            <div class="col-6 mt-2 text-end">
                                <span class="fs-5 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
                            </div>

                            <div class="col-12 mt-5 mb-3 d-grid">
                                <button class="btn btn-primary fs-5 fw-bold checkout-btn rounded-5" onclick="checkOut();">CHECKOUT</button>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        <!-- summary -->
    <?php
                            }

    ?>

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

</div>
</div>


<script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>

<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

<script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>

