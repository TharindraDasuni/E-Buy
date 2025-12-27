<?php
require "connection.php";

session_start();

$text = $_POST["t"];
$select = $_POST["s"];

$q = "SELECT * FROM `product`";

if (!empty($text) && $select == 0) {

    $q .= " WHERE title LIKE '%" . $text . "%' AND `status_id`='1'";
} else if (empty($text) && $select != 0) {

    $q .= " WHERE category_id='" . $select . "' AND `status_id`='1'";
} else if (!empty($text) && $select != 0) {

    $q .= " WHERE title LIKE '%" . $text . "%' AND category_id='" . $select . "' AND `status_id`='1'";
}

?>

<div class="row">

    <!-- products -->

    <div class="col-12 mb-3">
        <div class="row">

            <div class="col-12">
                <div class="row justify-content-center gap-5">

                    <?php

                    if ("0" != $_POST["page"]) {
                        $pageno = $_POST["page"];
                    } else {
                        $pageno = 1;
                    }

                    $product_result = Database::search($q);
                    $p_count = $product_result->num_rows;

                    $result_per_page = 5;
                    $number_of_pages = ceil($p_count / $result_per_page);

                    $page_result = ($pageno - 1) * $result_per_page;

                    $product_rs = Database::search($q . " LIMIT " . $result_per_page . " OFFSET " . $page_result . "");

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
                                    <span class="badge text-bg-light opacity-60 mb-2" style="font-size: 20;">Used</span><br />
                                <?php
                                }

                                ?>

                                <span class="card-text text-light  fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                <?php

                                if ($product_data["qty"] == 0) {

                                ?>

                                    <span class="card-text avl-txt">Out of stock</span><br />

                                    <div class="row mb-2 mt-2">

                                        <a href='' class="col-7 btn buy-btn py-0" style="cursor: not-allowed;">Buy Now</a>

                                        <button class="ms-1 col-1 btn btn-outline-none py-0">
                                            <i class="bi bi-cart4 fs-5 text-light"></i>
                                        </button>

                                        <button class="ms-4 col-1 btn btn-outline-none  py-0 px-0">
                                            <i class="bi bi-suit-heart-fill fs-5 text-light"></i>
                                        </button>

                                    </div>

                                <?php

                                } else {

                                ?>

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

    <!-- Paginition -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                } ?> aria-label="Next">
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