<?php
session_start();
require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Store</title>
    <link rel="icon" href="resource\logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="home-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <?php

            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];
            ?>

                <div class="col-12 justify-content-center mb-3">
                    <div class="row">
                        <div class="offset-1 col-10 mt-0 mt-lg-4 text-item">
                            <h2 class="text-center fw-bold">Store Manage</h2>
                        </div>

                        <!-- products -->
                        <div class="col-12 mb-3">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-5">

                                        <?php

                                        $product_rs = Database::search("SELECT * FROM product WHERE `user_email` ='" . $email . "'  ORDER BY
                                            datetime_added");

                                        $product_num = $product_rs->num_rows;

                                        if ($product_num == 0) {

                                        ?>


                                            <div class="col-10 col-lg-10 mt-5 singleProduct crt-box rounded-5">
                                                <div class="row">
                                                    <div class="col-12 emptyproduct"></div>
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fs-4 mt-4">You Have Not Added Any Items Yet</label>
                                                    </div>
                                                    <div class="offset-lg-5 col-12 col-lg-2 d-grid mb-3 mt-3">
                                                        <a href="addProduct.php" class="btn btn-outline-secondary fs-5 fw-bold rounded-5" style="font-family: Spaced;">Add Product</a>
                                                    </div>
                                                </div>
                                            </div>


                                            <?php

                                        } else {

                                            for ($x = 0; $x < $product_num; $x++) {
                                                $product_data = $product_rs->fetch_assoc();

                                            ?>

                                                <div class="card crd col-6 col-lg-2 mt-5 mb-2" style="width: 14rem;">

                                                    <?Php

                                                    $img_rs = Database::search("SELECT * FROM product_img WHERE
                                                        product_id='" . $product_data['id'] . "'");

                                                    $img_data = $img_rs->fetch_assoc();

                                                    ?>
                                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>'><img src="<?php echo $img_data["img_path"]; ?>" class="card-img img-thumbnail mt-2" style="height: 180px;"></a>
                                                    <div class="card-body ms-0 m-0 text-center">
                                                        <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>

                                                        <?php

                                                        if ($product_data["condition_id"] == 1) {

                                                        ?>

                                                            <span class="badge text-bg-light opacity-60 mb-2" style="font-size: 20;">Brand New</span><br />

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <span class="badge text-bg-dark opacity-60 mb-2" style="font-size: 20;">Used</span><br />

                                                        <?php

                                                        }

                                                        ?>

                                                        <span class="card-text text-light  fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                                        <?php

                                                        if ($product_data["qty"] == 0) {

                                                        ?>
                                                            <span class="card-text avl-txt">Out of stock</span><br />
                                                        <?php

                                                        } else {

                                                        ?>

                                                            <span class="card-text avl-txt">Available Now</span><br />

                                                        <?php

                                                        }

                                                        ?>

                                                        <!-- <span class="card-text text-light"><?php echo $product_data["qty"]; ?> Items Available</span><br /> -->

                                                        <div class="row mb-2 mt-2">
                                                            <button class="col-12 btn buy-btn py-1" onclick="updateSendId(<?php echo $product_data['id']; ?>);">Update</button>
                                                        </div>

                                                        <?php
                                                        if ($product_data["status_id"] == 1) {
                                                        ?>
                                                            <div class="row mb-2 mt-2">
                                                                <button class="col-12 btn btn-dark py-1 rounded-5 fw-bold" style="font-family: Spaced;" type="checkbox" role="switch" id="changeStatus(<?php echo $product_data['id']; ?>);" onclick="changeStatus(<?php echo $product_data['id']; ?>); location.reload();">Deactivate</button>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="row mb-2 mt-2">
                                                                <button class="col-12 btn btn-dark py-1 rounded-5 fw-bold" style="font-family: Spaced;" type="checkbox" role="switch" id="changeStatus(<?php echo $product_data['id']; ?>)" onclick="changeStatus(<?php echo $product_data['id']; ?>); location.reload();">Activate</button>
                                                            </div>

                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                        <?php

                                            }
                                        }

                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- products -->



                    <!-- Paginition -->
                    <!-- <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-5 mb-5 text-light">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <?php

                                    for ($y = 1; $y <= $number_of_pages; $y++) {
                                        if ($y == $pageno) {
                                    ?>
                                            <li class="page-item active">
                                                <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                            </li>
                                        <?Php
                                        } else {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }

                                    ?>

                                    <li class="page-item">
                                        <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->
                    <!-- Paginition -->

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
        </div>
    </div>

    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>