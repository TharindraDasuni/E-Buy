<?php

session_start();

include "connection.php";

$pageno = 0;
$page = $_POST["p"];

if (0 != $page) {
    $pageno = $page;
} else {
    $pageno = 1;
}

$q = "SELECT * FROM `stock` INNER JOIN `product` ON `stock`.`product_id`=
`product`.`id` ORDER BY `stock`.`id` ASC;";

$rs = Database::search($q);
$num = $rs->num_rows;

$results_per_page = 5;
$num_of_pages = ceil($num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;

// $q2 = $q . " LIMIT $results_per_page OFFSET $page_results";
// $rs2 = Database::search($q2);
$rs2 = Database::search("SELECT * FROM `stock` INNER JOIN `product` ON `stock`.`product_id`=
`product`.`id` ORDER BY `stock`.`id` ASC LIMIT $results_per_page OFFSET $page_results");
$num2 = $rs2->num_rows;

if ($num2 == 0) {
    //     echo ("No Products Available");
    // } else {
    for ($i = 0; $i < $num2; $i++) {
        $d = $rs->fetch_assoc();
    }
}
?>

<div class="row">

    <div class="col-12 d-flex justify-content-center">
        <div class="row gap-2">

            <?php
            $c_rs = Database::search("SELECT * FROM `category`");
            $c_num = $c_rs->num_rows;

            for ($y = 0; $y < $c_num; $y++) {

                $c_data = $c_rs->fetch_assoc();
                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c_data["id"] . "' AND 
    `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

                $product_num = $product_rs->num_rows;

                for ($z = 0; $z < $product_num; $z++) {
                    $product_data = $product_rs->fetch_assoc();
            ?>

                    <div class="card crd col-6 col-lg-2 mt-2 mb-2" style="width: 14rem;">

                        <?php

                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                        $image_data = $image_rs->fetch_assoc();

                        ?>

                        <img src="<?php echo $image_data["img_path"]; ?>" class="card-img img-thumbnail mt-2" />
                        <div class="card-body ms-0 m-0 text-center">
                            <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                            <span class="badge text-bg-light opacity-70" style="font-size: 20;">New</span><br /><br />
                            <span class="card-text text-light  fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                            <?php

                            if ($product_data["qty"] > 0) {

                            ?>

                                <span class="card-text avl-txt">Available Now</span><br />
                                <span class="card-text text-light"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-12 btn btn-warning">Buy Now</a>
                                <div class="row"><button class="col-5 btn cart mt-2 py-0" onclick="addToCart(<?php echo $product_data['id']; ?>);">
                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                    </button>

                                <?php

                            } else {

                                ?>

                                    <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                    <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
                                    <button class="col-12 btn btn-warning disabled">Buy Now</button>
                                    <button class="col-12 btn btn-dark mt-2 disabled">
                                        <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                    </button>

                                <?php

                            }

                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data["id"] . "' AND 
                    `user_email`='" . $_SESSION["u"]["email"] . "'");

                            $watchlist_num = $watchlist_rs->num_rows;

                            if ($watchlist_num == 1) {
                                ?>
                                    <button class="col-12 btn btn-outline-light mt-2 cart py-0" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>); '>
                                        <i class="bi bi-heart-fill text-light fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                    </button>
                                <?php
                            } else {
                                ?>
                                    <button class="col-5 btn btn-outline-light mt-2 cart py-0" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>); '>
                                        <i class="bi bi-heart-fill text-light fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                    </button>
                                </div>
                            <?php
                            }

                            ?>


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

<!-- pagination -->
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous" <?php
                                                                if ($pageno <= 1) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="loadProduct(<?php echo ($pageno - 1) ?>);" <?php

                                                                                                                    }
                                                                                                                        ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php
                for ($y = 0; $y <= $num_of_pages; $y++) {
                    if ($y == $pageno) {
        ?>
                <li class="page-item active">
                    <a class="page-link" onclick="loadProduct(<?php echo $y ?>);"><?php echo $y ?></a>
                </li>
            <?php
                    } else {
            ?>
                <li class="page-item">
                    <a class="page-link" onclick="loadProduct(<?php echo $y ?>);"><?php echo $y ?></a>
                </li>
        <?php

                    }
                }
        ?>

        <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li> -->
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next" <?php
                                                            if ($pageno >= $num_of_pages) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onclick="loadProduct(<?php echo ($pageno + 1) ?>);" <?php

                                                                                                                }
                                                                                                                    ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<!-- pagination -->
<?php
            }
?>