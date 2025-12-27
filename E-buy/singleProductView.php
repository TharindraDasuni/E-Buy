<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,product.title,user.fname,user.lname,
    color.name,category.name AS catname,condition.name AS conname,status.name AS sname,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,product.category_id,
    product.brand_has_model_id,product.condition_id,product.status_id,product.user_email,product.color_id,
    model.name AS mname,brand.name AS bname FROM `product` 
    INNER JOIN `brand_has_model` ON 
    brand_has_model.id=product.brand_has_model_id 
    INNER JOIN `user` ON user.email=product.user_email
    INNER JOIN `color` ON color.id=product.color_id 
    INNER JOIN `category` ON category.id=product.category_id
    INNER JOIN `condition` ON condition.id=product.condition_id  
    INNER JOIN `status` ON status.id=product.status_id 
    INNER JOIN `brand` ON brand.id=brand_has_model.brand_id
    INNER JOIN `model` ON model.id=brand_has_model.model_id 
    WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

        $model_rs = Database::search("SELECT * FROM product INNER JOIN `model` INNER JOIN `brand_has_model` ON 
        model.id=brand_has_model.model_id WHERE product.brand_has_model_id=brand_has_model.id AND product.id='" . $pid . "' ");
        $model_data = $model_rs->fetch_assoc();

        $brand_rs = Database::search("SELECT * FROM product INNER JOIN `brand` INNER JOIN `brand_has_model` ON 
        brand.id=brand_has_model.brand_id WHERE product.brand_has_model_id=brand_has_model.id AND product.id='" . $pid . "' ");
        $brand_data = $brand_rs->fetch_assoc();



?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>E-Buy | Single Product</title>
            <link rel="icon" href="resource\logo.png" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="style.css" />

        </head>

        <body class="home-body">

            <div class="container-fluid">
                <div class="row">

                    <?php include "header.php"; ?>

                    <div class="col-12 mt-0 singleProduct">
                        <div class="row">
                            <div class="offset-1 col-10">

                                <!-- product images -->
                                <div class="row productBox">

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-6 col-lg-12 align-items-center">
                                                <br />
                                                <div class="mainImg bg-light rounded-4" id="mainImg"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" col-12 col-lg-2 order-2 order-lg-1 mt-3">
                                        <ul>


                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {

                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["img_path"];
                                            ?>
                                                    <li class="d-flex justify-content-center align-items-center mb-1">
                                                        <img src="<?php echo $img[$x]; ?>" class="img-thumbnail mt-0 mb-1 shadow-lg productImg" id="product_img<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" style="height: 155px; width: 200px;" />
                                                    </li>

                                                <?php

                                                }
                                            } else {

                                                ?>

                                                <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                                    <img src="resource\empty.svg" class="img-thumbnail mt-1 mb-1" style="height: 155px;" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                            <?php


                                            }

                                            ?>
                                        </ul>
                                    </div>
                                    <!-- product images -->

                                    <!-- product box -->

                                    <div class="ms-0 col-12 col-lg-6 order-3 productBox2 mt-3 mb-5">
                                        <div class="row">
                                            <div class="col-12 ps-5 pe-5">

                                                <div class="row mt-lg-3 ">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                            <li class="breadcrumb-item active" aria-current="page"> <?php echo $product_data["title"]; ?></li>
                                                        </ol>
                                                    </nav>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-2 fw-bold text-dark"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 my-2  d-none d-lg-block">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>

                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class="fs-6 text-dark">4.8 Stars | 45 Reviews and Ratings</label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <?php

                                                $price = $product_data["price"];
                                                $adding_price = ($price / 100) * 5;
                                                $new_price = $price + $adding_price;
                                                $difference = $new_price - $price;
                                                $percentage = ($difference / $price) * 100;

                                                ?>

                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-3 text-danger fw-bold">Rs.<span class="fs-1 text-danger fw-bold"><?php echo $price; ?></span>.00</span>

                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <span class="fs-4 text-dark text-u"><s>Rs.<?php echo $new_price; ?>.00</s></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                <span class="fs-4 fw-bold text-info">Save Rs. <?php echo $difference; ?> .00 </span><span class="fs-4 text-danger">(<?php echo $percentage; ?>%)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- qty add -->
                                                <div class="d-flex align-items-center gap-1 mt-3">
                                                    <button class="btn bg-light border-dark text-dark btn-sm fw-bold" onclick='qty_dec();'>-</button>
                                                    <input type="number" class="form-control form-control-sm text-center bg-light border-dark text-dark fw-bold" style="max-width: 100px;" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" disabled>
                                                    <button class="btn bg-light border-dark text-dark btn-sm fw-bold" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'>+</button>
                                                </div>
                                                <!-- qty add -->



                                                <div class="p-2 col-12 my-2 text-dark border border-1 border-secondary rounded mt-3">
                                                    <span class="fs-6"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                    <span class="fs-6"><b>Return : </b>1 Month Return Policy | Buyer protection</span><br />
                                                    <span class="fs-6"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <div class="row">

                                                            <div class="col-12 col-lg-6 ">
                                                                <span class="fs-6 text-dark"><b>Seller :</b> <?php echo $product_data["fname"]; ?> <?php echo $product_data["lname"]; ?></span>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <span class="fs-6 text-dark"><b>Sold : </b>100 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="offset-lg-1 col-12 col-lg-10 border border-2 border-danger rounded">
                                                    <div class="row">
                                                        <div class="col-3 col-lg-2  border-end border-2 border-danger">
                                                            <img src="resource\tag.png" />
                                                        </div>
                                                        <div class="col-9 col-lg-10">
                                                            <span class="fs-6 text-danger fw-bold">
                                                                Enjoy a 5% Discount with Your VISA or MasterCard
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-12 mt-3 mb-5">

                                                    <div class="row">

                                                        <div class="col-8 col-lg-9 d-grid">
                                                            <button class="btn buy-btn2" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid ?>);">Buy Now</button>
                                                        </div>

                                                        <div class="col-1 ms-0">
                                                            <button class="btn crt-btn" onclick="addToCart(<?php echo $product_data['id']; ?>);">
                                                                <i class="bi bi-cart4 fs-5 text-danger"></i></button>
                                                        </div>
                                                        <div class="col-1 ms-4 ms-lg-2">
                                                            <button class="btn btn-outline-dark wish-btn" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                                <i class="bi bi-heart-fill fs-6 text-danger"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div>
            </div>
            <!-- product box -->

            </div>
            </div>

            <!-- Related Items -->

            <div class="ms-5 col-12">
                <div class="col-11 row d-block mt-4 mb-3 border-bottom border-1 border-light">
                    <div>
                        <span class="fs-3 text-white" style="font-family: Spaced;">Related Items</span>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="ms-5 row d-flex justify-content-center">

                    <?php

                    $c_product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $product_data["category_id"] . "'LIMIT 5 OFFSET 0");
                    $c_product_num = $c_product_rs->num_rows;

                    for ($z = 0; $z < $c_product_num; $z++) {
                        $c_product_data = $c_product_rs->fetch_assoc();

                    ?>


                        <a href='<?php echo "singleProductView.php?id=" . ($c_product_data["id"]); ?>' class="col-12 col-lg-2">

                            <div class="col-12">

                                <!-- card -->
                                <div class="card crd offset-3 offset-lg-0 col-6 col-lg-4 mt-2 mb-2" style="width: 14rem;">

                                    <?php

                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $c_product_data["id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    ?>

                                    <img src="<?php echo $image_data["img_path"]; ?>" class="card-img" style="height: 200px;"/>

                                    <div class="card-body ms-0 m-0 text-center">
                                        <h5 class="card-title fw-bold fs-6"><?php echo $c_product_data["title"]; ?></h5>
                                        <span class="avl-txt" style="font-size: 30;">Brand New</span><br />
                                        <span class="card-text text-light  fw-bold">Rs.<?php echo $c_product_data["price"]; ?>.00</span><br />
                                    </div>

                                </div>

                            </div>
                        </a>
                    <?php
                    }

                    ?>
                </div>
            </div>
            <!-- Related Items -->
            </div>

            <!-- Product Details -->
            <div class="ms-5 col-12">
                <div class="col-11">
                    <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-light">
                        <div class="col-12">
                            <span class="fs-3 text-white" style="font-family: Spaced;">Product Details</span>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-lg-11 text-white productBox3">
                    <div class="row">

                        <div class="col-10 mt-3">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Product Name </label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <label class="form-label fs-6"><?php echo $product_data["title"]; ?></label>
                                </div>
                            </div>
                        </div>


                        <div class="col-10 mt-1">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Category </label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <label class="form-label fs-6"><?php echo $product_data["catname"]; ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mt-1">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Brand </label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <label class="form-label fs-6"><?php echo $brand_data["name"]; ?></label>
                                </div>
                            </div>
                        </div>

                        <div class=" col-10 mt-1">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Color </label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <label class="form-label fs-6"><?php echo $product_data["name"]; ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mt-1">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Model </label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <label class="form-label fs-6"><?php echo $model_data["name"]; ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mt-1">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Status </label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <label class="form-label fs-6"><?php echo $product_data["sname"]; ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mt-1">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Condition </label>
                                </div>
                                <div class="col-8 col-lg-9">
                                    <label class="form-label fs-6"><?php echo $product_data["conname"]; ?></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mt-1">
                            <div class="row">
                                <div class="col-3 col-lg-2">
                                    <label class="form-label fs-6 fw-bold">Description </label>
                                </div>
                                <div class="col-8 col-lg-10">
                                    <label class="form-label fs-6"><?php echo $product_data["description"]; ?></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Product Details -->

            <!-- Feedbacks -->
            <div class="ms-5 col-11">
                <div class="col-12">
                    <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-light">
                        <div class="col-12">
                            <span class="fs-3 text-white" style="font-family: Spaced;">Feedbacks</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 productBox3 text-light">
                    <div class="row me-0" style="height: 300px;">

                        <?php

                        $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                        $feedback_num = $feedback_rs->num_rows;

                        for ($x = 0; $x < $feedback_num; $x++) {
                            $feedback_data = $feedback_rs->fetch_assoc();
                        ?>
                            <div class="col-11 mt-4 mb-1 mx-0">
                                <div class="border border-1 border-light rounded  ps-3 ps-lg-5 pt-2">
                                    <div class="row">
                                        <?php

                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                        $user_data = $user_rs->fetch_assoc();

                                        ?>
                                        <div class="col-10 mt-1 mb-1 ms-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></div>
                                        <div class="col-1 mt-1 mb-1 me-0 text-end ">
                                            <?php
                                            if ($feedback_data["type_id"] == 1) {
                                            ?>
                                                <span class="badge bg-success">Positive</span>
                                        </div>
                                    <?php
                                            } else if ($feedback_data["type_id"] == 2) {
                                    ?>
                                        <span class="badge bg-warning">Neutral</span>
                                    </div>
                                </div>
                            <?php
                                            } else if ($feedback_data["type_id"] == 3) {
                            ?>
                                <span class="badge bg-danger">Negative</span>
                            </div>
                        <?php
                                            }
                        ?>

                        <div class="row ps-3 ps-lg-5">
                            <div class="col-12 col-lg-3">
                                <b>
                                    <?php echo $feedback_data["feedback"]; ?>
                                </b>
                            </div>
                            <div class="col-12 col-lg-8 text-end">
                                <label class="form-label fs-6"><?php echo $feedback_data["date"]; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Feedbacks -->

        <?php
                        }

        ?>


        </div>
        </div>

        </div>
        </div>

        <?php include "footer.php"; ?>
        </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the inconvinient");
    }
} else {
    echo ("Something went wrong");
}

?>