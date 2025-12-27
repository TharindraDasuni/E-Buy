<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy</title>
    <link rel="icon" href="resource\logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body class="home-body">

    <div class="container-fluid body-image">
        <div class="row">

            <?php include "header.php"; ?>

            <div class="col-12 justify-content-center mb-3">
                <div class="row mb-5 mt-4 mt-lg-0">

                    <div class="offset-lg-1  col-lg-1"></div>
                    <!-- basic search -->
                    <div class="col-12 col-lg-6">

                        <div class="input-group mt-0 mb-3 mt-lg-3">
                            <input type="text" class="form-control search-bar" aria-label="Text input with dropdown button" id="basic_search_txt">

                            <select class="form-select search-bar-cat" style="max-width: 250px;" id="basic_search_select">
                                <option value="0">All Categories</option>


                                <?php
                                require "connection.php";

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>

                                <?php
                                }

                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-3 mb-3 search-btn" onclick="basicSearch(0);">Search</button>
                    </div>


                    <!-- Basic search -->

                    <!-- Advanced Search Button-->
                    <div class="col-12 col-lg-2 mt-2 mt-lg-3 text-center text-lg-start">
                        <lable class="fw-bold navbar-txt text-secondary fs-6" onclick="adsearchbody();" style="cursor: pointer;">Advanced</lable>
                    </div>
                    <!-- Advanced Search Button-->
                </div>


            </div>

            <!-- Advanced Search body-->
            <div class="d-none" id="adsearch">
                <div class="border border-light rounded-4 p-4 offset-lg-1 col-12 col-lg-10 advancedSearch">
                    <div class="row col-12">

                        <!-- category select -->
                        <div class="row col-6 ms-auto">
                            <label class="col-3 text-white fw-bold py-2">CATEGORY</label>

                            <select class="form-select lable-search bg-dark" id="cat">
                                <option value="0">Select Category</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `category`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $data = $rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $data["id"] ?>"><?php echo $data["name"] ?></option>

                                <?php
                                }
                                ?>
                            </select>

                        </div>
                        <!-- category select -->

                        <!-- Brand select -->
                        <div class="row col-6 ms-auto">
                            <label class="col-3 text-white fw-bold py-2">BRAND</label>

                            <select class="form-select lable-search bg-dark" id="brand">
                                <option value="0">Select Brand</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `brand`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $data = $rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $data["id"] ?>"><?php echo $data["name"] ?></option>

                                <?php

                                }

                                ?>
                            </select>
                        </div>
                        <!-- Brand select -->

                        <!-- Brand select -->
                        <div class="row col-6 ms-auto">
                            <label class="col-3 text-white fw-bold py-2">MODEL</label>

                            <select class="form-select lable-search bg-dark" id="model">
                                <option value="0">Select Model</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `model`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $data = $rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $data["id"] ?>"><?php echo $data["name"] ?></option>

                                <?php

                                }

                                ?>
                            </select>
                        </div>
                        <!-- Brand select -->

                        <!-- Color select -->
                        <div class="row col-6 ms-auto">
                            <label class="col-3 text-white fw-bold py-2">COLOR</label>

                            <select class="form-select lable-search bg-dark" id="color">
                                <option value="0">Select Color</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `color`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $data = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $data["id"] ?>"><?php echo $data["name"] ?></option>

                                <?php

                                }

                                ?>
                            </select>
                        </div>
                        <!-- Color select -->

                        <div class="row col-6 ms-auto">
                            <label class="col-3 text-white fw-bold py-2">CONDITION</label>

                            <select class="form-select lable-search bg-dark" id="c2">
                                <option value="0">Select Condition</option>
                                <?php

                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                $condition_num = $condition_rs->num_rows;

                                for ($x = 0; $x < $condition_num; $x++) {
                                    $condition_data = $condition_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $condition_data["id"]; ?>"><?php echo $condition_data["name"]; ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>

                        <div class="row col-3 ms-auto py-1 pt-5">
                            <input type="text" class="form-control text-white lable-search bg-dark" placeholder="Price From..." id="min" />
                        </div>

                        <div class="row col-3 ms-auto py-1 pt-5">
                            <input type="text" class="form-control text-white lable-search bg-dark" placeholder="Price To..." id="max" />
                        </div>

                        <div class="row col-12 col-lg-6 ms-auto mb-1 py-1 pt-4">
                            <input type="text" class="form-control text-white lable-search bg-dark" placeholder="Type keyword to search..." id="t" />
                        </div>


                        <div class="row col-4 ms-auto mt-4 mb-2">
                            <select class="form-select bg-dark text-white " id="s">
                                <option value="0">Sort By</option>
                                <option value="1">PRICE LOW TO HIGH</option>
                                <option value="2">PRICE HIGH TO LOW</option>
                                <option value="3">QUANTITY LOW TO HIGH</option>
                                <option value="4">QUANTITY HIGH TO LOW</option>
                            </select>
                        </div>


                        <div class="row col-12 col-lg-2 mb-1 ms-auto d-grid py-1 pt-4">
                            <button class="btn btn-primary search-btn" onclick="advancedSearch(0);">SEARCH</button>
                        </div>



                    </div>
                </div>

            </div>
        </div>
        <!-- Advanced Search body-->

        <div id="advancedSearchResult">
            <div id="basicSearchResult">
                <div class="col-12 text-item-home px-5 pt-5 mt-5 mb-5">
                    <h2>Shop Smart</h2>
                    <!-- <h2>Where Shopping Meets Simplicity</h2> -->
                    <p class="mt-4">Your Gateway to Great Deals</p>
                </div>

                <div class="px-lg-5 col-12 mt-lg-5 pt-lg-5">
                    <div class="row mt-5 pt-5">


                        <?php

                        $c_rs = Database::search("SELECT * FROM `category`");
                        $c_num = $c_rs->num_rows;

                        for ($y = 0; $y < $c_num; $y++) {

                            $c_data = $c_rs->fetch_assoc();

                        ?>

                            <!-- Category Name -->
                            <div class="col-12 mt-5 mb-3">
                                <a href="#" class="text-decoration-none fs-3" style="font-family: Spaced; color: white;"><?php echo $c_data["name"]; ?></a> &nbsp;&nbsp;
                            </div>
                            <!-- Category Name -->

                            <!-- products -->
                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row justify-content-center gap-5">

                                            <?php

                                            if (isset($_GET["page"])) {
                                                $pageno = $_GET["page"];
                                            } else {
                                                $pageno = 1;
                                            }

                                            $product_resultset = Database::search("SELECT * FROM `product` WHERE
                                        category_id='" . $c_data['id'] . "' AND status_id='1'");
                                            $product_count = $product_resultset->num_rows;

                                            $result_per_page = 5;
                                            $number_of_pages = ceil($product_count / $result_per_page);

                                            $page_result = ($pageno - 1) * $result_per_page;

                                            $product_rs = Database::search("SELECT * FROM product WHERE
                                            category_id='" . $c_data['id'] . "' AND status_id='1' ORDER BY
                                            datetime_added DESC LIMIT " . $result_per_page . " OFFSET " . $page_result . " ");

                                            $product_num = $product_rs->num_rows;

                                            for ($x = 0; $x < $product_num; $x++) {
                                                $product_data = $product_rs->fetch_assoc();

                                            ?>

                                                <div class="card crd col-6 col-lg-2 mt-2 mb-2" style="width: 14rem;">

                                                    <?Php

                                                    $img_rs = Database::search("SELECT * FROM product_img WHERE
                                                    product_id='" . $product_data['id'] . "'");

                                                    $img_data = $img_rs->fetch_assoc();

                                                    ?>


                                                    <?php

                                                    if ($product_data["qty"] == 0) {

                                                    ?>
                                                        <img src="<?php echo $img_data["img_path"]; ?>" class="card-img img-thumbnail mt-2" style="height: 180px;">
                                                        <div class="card-body ms-0 m-0 text-center">
                                                            <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>

                                                            <?php

                                                            if ($product_data["condition_id"] == 1) {

                                                            ?>
                                                                <span class="badge text-bg-light opacity-60 mb-2" style="font-size: 20;">Brand New</span><br />
                                                            <?php

                                                            } else {
                                                            ?>
                                                                <span class="badge text-bg-dark  opacity-60 mb-2" style="font-size: 20;">Used</span><br />
                                                            <?php
                                                            }

                                                            ?>


                                                            <span class="card-text text-light  fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                                            <span class="card-text avl-txt">Out of stock</span><br />

                                                            <div class="row mb-2 mt-2">

                                                                <a href='' class="col-7 btn buy-btn py-0" style="cursor: not-allowed;">Buy Now</a>

                                                                <button class="ms-1 col-1 btn btn-outline-none py-0" style="cursor: not-allowed;">
                                                                    <i class="bi bi-cart4 fs-5 text-light"></i>
                                                                </button>

                                                                <button class="ms-4 col-1 btn btn-outline-none  py-0 px-0" style="cursor: not-allowed;">
                                                                    <i class="bi bi-suit-heart-fill fs-5 text-light"></i>
                                                                </button>

                                                            </div>

                                                        <?php

                                                    } else {

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
                                                                    <span class="badge text-bg-dark  opacity-60 mb-2" style="font-size: 20;">Used</span><br />
                                                                <?php
                                                                }

                                                                ?>


                                                                <span class="card-text text-light  fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                                                <span class="card-text avl-txt">Available Now</span><br />

                                                                <div class="row mb-2 mt-2">
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-7 btn buy-btn py-0">Buy Now</a>

                                                                    <button onclick="addToCart(<?php echo $product_data['id']; ?>);" class="ms-1 col-1 btn btn-outline-none py-0">
                                                                        <i class="bi bi-cart4 fs-5 text-light"></i>
                                                                    </button>

                                                                    <button onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" class="ms-4 col-1 btn btn-outline-none  py-0 px-0">
                                                                        <i class="bi bi-suit-heart-fill fs-5 text-light"></i>
                                                                    </button>

                                                                </div>

                                                            <?php

                                                        }

                                                            ?>

                                                            <!-- <span class="card-text text-light"><?php echo $product_data["qty"]; ?> Items Available</span><br /> -->



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

                            <?php

                        }

                            ?>

                            <!-- Paginition -->
                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-5 mb-5 text-light">
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
                            </div>
                            <!-- Paginition -->

                            <?php include "footer.php"; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>