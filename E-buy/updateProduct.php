<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Add Products</title>
    <link rel="icon" href="resource\logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="admin-body">

    <!-- Nav Bar -->
    <?php
    require "connection.php";
    include "header.php";
    if (isset($_SESSION["u"])) {
        if (isset($_SESSION["p"])) {
            $product = $_SESSION["p"];

    ?>
            <!-- Nav Bar -->

            <div class="container-fluid">
                <div class="offset-1 col-10 mt-0 mt-lg-4 text-item mb-5">
                    <h2 class="text-center fw-bold">Update Product</h2>
                    <div class="row">
                        <div class="row offset-1 offset-lg-1 col-10 col-lg-10 mt-4  productBox4 singleProduct">

                            <div class="row col-12 col-lg-6 singleProduct">

                                <div class="mb-2">
                                    <label for="form-lable" for="" class="add-p-txt pb-1">Product Name</label>
                                    <input type="text" value="<?php echo $product["title"]; ?>" class="form-control" id="title">
                                </div>

                                <div class="mb-2 col-12 col-lg-6">
                                    <label for="form-lable" for="" class="add-p-txt pb-1">Category</label>
                                    <select class="form-select" id="category" disabled>

                                        <?php

                                        $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                        $category_data = $category_rs->fetch_assoc();

                                        ?>

                                        <option><?php echo $category_data["name"]; ?></option>

                                    </select>
                                </div>

                                <div class="mb-2 col-12 col-lg-6">
                                    <label for="form-lable" for="" class="add-p-txt pb-1">Brand</label>
                                    <select class="form-select" id="brand" disabled>

                                        <?php

                                        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN 
                                                                                (SELECT `brand_id` FROM `brand_has_model` WHERE 
                                                                                `id`='" . $product["brand_has_model_id"] . "')");
                                        $brand_data = $brand_rs->fetch_assoc();

                                        ?>

                                        <option><?php echo $brand_data["name"]; ?></option>

                                    </select>
                                </div>

                                <div class="mb-2 col-12 col-lg-6">
                                    <label for="form-lable" for="" class="add-p-txt pb-1">Model</label>
                                    <select class="form-select" id="model" disabled>

                                        <?Php

                                        $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN 
                                                                                (SELECT `model_id` FROM `brand_has_model` WHERE 
                                                                                `id`='" . $product["brand_has_model_id"] . "')");
                                        $model_data = $model_rs->fetch_assoc();

                                        ?>

                                        <option><?php echo $model_data["name"]; ?></option>

                                </div>
                                </select>
                            </div>

                            <div class="mb-2 col-12 col-lg-6">
                                <label for="form-lable" for="" class="add-p-txt pb-1">Quantity</label>
                                <input type="number" class="form-control" value="<?php echo $product["qty"]; ?>" min="0" id="qty">
                            </div>


                            <div class="mb-2 col-12">
                                <label for="form-lable" for="" class="add-p-txt pb-1">Color</label>
                                <select class="form-select" id="clr" disabled>

                                    <?php

                                    $color_rs = Database::search("SELECT * FROM `color` WHERE
                                                                                        `id`='" . $product["color_id"] . "'");
                                    $color_data = $color_rs->fetch_assoc();

                                    ?>

                                    <option><?php echo $color_data["name"]; ?></option>

                                </select>
                            </div>
                            <!-- <div class="col-6 col-12 col-lg-6 mt-4">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" placeholder="Add New Color" id="clr_in" />
                                    <button class="btn btn-outline-primary" type="button" id="button-addon2">+ Add</button>
                                </div>
                            </div> -->

                            <?php

                            if ($product["condition_id"] == 1) {

                            ?>

                                <div class="mb-2 col-12 col-lg-10">
                                    <label for="form-lable" for="" class="add-p-txt pb-1">Condition</label>
                                    <div class="form-check form-check-inline mx-5">
                                        <input class="form-check-input" type="radio" id="b" name="c" checked disabled />
                                        <label class="form-check-label" for="b">Brandnew</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="u" name="c" disabled />
                                        <label class="form-check-label" for="u">Used</label>
                                    </div>
                                </div>

                            <?php

                            } else if ($product["condition_id"] == 2) {

                            ?>

                                <div class="mb-2 col-12 col-lg-10">
                                    <label for="form-lable" for="" class="add-p-txt pb-1">Condition</label>
                                    <div class="form-check form-check-inline mx-5">
                                        <input class="form-check-input" type="radio" id="b" name="c" disabled />
                                        <label class="form-check-label" for="b">Brandnew</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="u" name="c" checked disabled />
                                        <label class="form-check-label" for="u">Used</label>
                                    </div>
                                </div>

                            <?php

                            }

                            ?>

                            <div class="mb-2 col-12">
                                <label for="form-lable" for="" class="add-p-txt pb-1">Price</label>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" value="<?php echo $product["price"]; ?>" id="cost" disabled />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="mb-2 col-12 col-lg-12">
                                <label for="form-lable" for="" class="add-p-txt pb-1">Delivery cost Within Colombo</label>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="dwc" value="<?php echo $product["delivery_fee_colombo"]; ?>" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>


                            <div class="mb-2 col-12 col-lg-12">
                                <label for="form-lable" for="" class="add-p-txt pb-1">Delivery cost out of Colombo</label>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="doc" value="<?php echo $product["delivery_fee_other"]; ?>" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="form-lable" for="" class="add-p-txt pb-1">Description</label>
                                <textarea rows="3" class="form-control" id="desc"><?php echo $product["description"]; ?></textarea>
                            </div>

                        </div>


                        <div class="col-12 col-lg-6">

                            <div class="mb-2 col-12">
                                <label for="form-lable" for="" class="add-p-txt pb-1">Product Images</label>
                            </div>

                            <div class="row offset-lg-0 col-12 col-lg-12 d-flex justifi-content-center align-items-center singleProduct">


                                <?php
                                $img = array();
                                $img[0] = "resource\Other\add img2.svg";
                                $img[1] = "resource\Other\add img2.svg";
                                $img[2] = "resource\Other\add img2.svg";
                                $img[3] = "resource\Other\add img2.svg";
                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                $img_num = $img_rs->num_rows;
                                for ($x = 0; $x < $img_num; $x++) {
                                    $img_data = $img_rs->fetch_assoc();
                                    $img[$x] = $img_data["img_path"];
                                }
                                ?>

                                <div class="col-12 col-lg-8 p-2 m-auto border border-secondary rounded singleProduct" onclick="changeProductImage();" style="cursor: pointer;">
                                    <input type="file" class="d-none" id="imageuploader" multiple />
                                    <label for="imageuploader">
                                        <img src="<?php echo $img[0]; ?>" class="img-fluid rounded" id="i0" style="cursor: pointer;" />
                                    </label>
                                </div>

                                <div class="row  m-auto mt-1  col-12 col-lg-4 ">
                                    <div class="d-flex p-2 border border-secondary rounded" onclick="changeProductImage();" style="cursor: pointer;">
                                        <input type="file" class="d-none" id="imageuploader" style="cursor: pointer;" multiple />
                                        <label for="imageuploader">
                                            <img src="<?php echo $img[1]; ?>" class="img-fluid rounded" id="i1" style="cursor: pointer;" />
                                        </label>
                                    </div>
                                    <div class="d-flex p-2 border border-secondary rounded" onclick="changeProductImage();" style="cursor: pointer;">
                                        <input type="file" class="d-none" id="imageuploader" multiple />
                                        <label for="imageuploader">
                                            <img src="<?php echo $img[2]; ?>" class="img-fluid rounded" id="i2" style="cursor: pointer;" />
                                        </label>
                                    </div>
                                    <div class="d-flex p-2 border border-secondary rounded" onclick="changeProductImage();" style="cursor: pointer;">
                                        <input type="file" class="d-none" id="imageuploader" multiple />
                                        <label for="imageuploader">
                                            <img src="<?php echo $img[3]; ?>" class="img-fluid rounded" id="i3" style="cursor: pointer;" />
                                        </label>
                                    </div>
                                </div>

                                <!-- <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                <input type="file" class="d-none" id="imageuploader" multiple />
                                <label for="imageuploader" class="col-12 btn upload-btn" onclick="changeProductImage();">Upload Images</label>
                            </div> -->

                            </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="mb-2 col-12">
                                        <label for="form-lable" for="" class="add-p-txt pb-1">Payment Methods</label>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                            <div class="col-2 pm pm2"></div>
                                            <div class="col-2 pm pm3"></div>
                                            <div class="col-2 pm pm4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="mb-2 col-12">
                                    <label for="form-lable" for="" class="add-p-txt text-danger pb-1">Notice</label>
                                </div>
                                <label class="form-label">
                                    We are taking 5% of the product from price from every
                                    product as a service charge.
                                </label>
                            </div>

                            <div class="col-12 col-lg-12 d-grid mt-3 mb-3">
                                <button class="btn upload-btn" onclick="updateProduct();">Update Product</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    <?php

        }
    } else {
        header("Location:index.php");
    }

    require "footer.php";


    ?>




    <script src="script.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>