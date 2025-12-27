<?php

require "connection.php";

session_start();


$search_txt = $_POST["t"];
// $pageno = 0;
// $page = $_POST["page"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$from = $_POST["min"];
$to = $_POST["max"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_id`='" . $category . "'";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= "WHERE `brand_has_model_id`= '" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_id`='" . $model . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= "WHERE `brand_has_model_id`= '" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $model != 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $brand . "' 
        AND `model_id`='" . $model . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= "WHERE `brand_has_model_id`= '" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= "WHERE `condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= "AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0 && $status == 0) {
        $query .= "WHERE `color_id`='" . $color . "'";
        $status = 1;
    } else if ($color != 0 && $status != 0) {
        $query .= "AND `color_id`='" . $color . "'";
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= "WHERE `price` >= '" . $from . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `price` >= '" . $from . "'";
        }
    } else if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= "WHERE `price` <= '" . $to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `price` <= '" . $to . "'";
        }
    } else if (!empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= "WHERE `price` BETWEEN '" . $from . "' AND '" . $to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `price` BETWEEN '" . $from . "' AND '" . $to . "'";
        }
    }
} else if ($sort == 1) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` ASC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE category_id='" . $category . "' ORDER BY price ASC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND category_id='" . $category . "' ORDER BY price ASC";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY price ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY price ASC";
        }
    }

    if ($brand == 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                model_id='" . $model . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY price ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY price ASC";
        }
    }

    if ($brand != 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                        model_id='" . $model . "' AND brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY price ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY price ASC";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE condition_id='" . $condition . "' ORDER BY price ASC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND condition_id='" . $condition . "' ORDER BY price ASC";
    }

    if ($color != 0 && $status == 0) {
        $query .= " WHERE color_id='" . $color . "' ORDER BY price ASC";
        $status = 1;
    } else if ($color != 0 && $status != 0) {
        $query .= " AND color_id='" . $color . "' ORDER BY price ASC";
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price >= '" . $from . "' ORDER BY price ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price >= '" . $from . "' ORDER BY price ASC";
        }
    } else if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price <= '" . $to . "' ORDER BY price ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price <= '" . $to . "' ORDER BY price ASC";
        }
    } else if (!empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY price ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY price ASC";
        }
    }
} else if ($sort == 2) {
    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` DESC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE category_id='" . $category . "' ORDER BY price DESC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND category_id='" . $category . "' ORDER BY price DESC";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY price DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY price DESC";
        }
    }

    if ($brand == 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                model_id='" . $model . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY price DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY price DESC";
        }
    }

    if ($brand != 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                        model_id='" . $model . "' AND brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY price DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY price DESC";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE condition_id='" . $condition . "' ORDER BY price DESC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND condition_id='" . $condition . "' ORDER BY price DESC";
    }

    if ($color != 0 && $status == 0) {
        $query .= " WHERE color_id='" . $color . "' ORDER BY price DESC";
        $status = 1;
    } else if ($color != 0 && $status != 0) {
        $query .= " AND color_id='" . $color . "' ORDER BY price DESC";
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price >= '" . $from . "' ORDER BY price DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price >= '" . $from . "' ORDER BY price DESC";
        }
    } else if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price <= '" . $to . "' ORDER BY price DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price <= '" . $to . "' ORDER BY price DESC";
        }
    } else if (!empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY price DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY price DESC";
        }
    }
} else if ($sort == 3) {
    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `qty` ASC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE category_id='" . $category . "' ORDER BY qty ASC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND category_id='" . $category . "' ORDER BY qty ASC";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY qty ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY qty ASC";
        }
    }

    if ($brand == 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                model_id='" . $model . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY qty ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY qty ASC";
        }
    }

    if ($brand != 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                        model_id='" . $model . "' AND brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY qty ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY qty ASC";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE condition_id='" . $condition . "' ORDER BY qty ASC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND condition_id='" . $condition . "' ORDER BY qty ASC";
    }

    if ($color != 0 && $status == 0) {
        $query .= " WHERE color_id='" . $color . "' ORDER BY qty ASC";
        $status = 1;
    } else if ($color != 0 && $status != 0) {
        $query .= " AND color_id='" . $color . "' ORDER BY qty ASC";
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price >= '" . $from . "' ORDER BY qty ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price >= '" . $from . "' ORDER BY qty ASC";
        }
    } else if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price <= '" . $to . "' ORDER BY qty ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price <= '" . $to . "'";
        }
    } else if (!empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY qty ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY qty ASC";
        }
    }
} else if ($sort == 4) {
    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `qty` DESC";
        $status = 1;
    }

    if (!empty($search_txt)) {
        $query .= " WHERE title LIKE '%" . $search_txt . "%' ORDER BY qty DESC";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE category_id='" . $category . "' ORDER BY qty DESC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND category_id='" . $category . "' ORDER BY qty DESC";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY qty DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY qty DESC";
        }
    }

    if ($brand == 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                                                model_id='" . $model . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY qty DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY qty DESC";
        }
    }

    if ($brand != 0 && $model != 0) {

        $brand_has_model_rs = Database::search("SELECT * FROM brand_has_model  WHERE 
                        model_id='" . $model . "' AND brand_id='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;

        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE brand_has_model _id='" . $pid . "' ORDER BY qty DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND brand_has_model _id='" . $pid . "' ORDER BY qty DESC";
        }
    }

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE condition_id='" . $condition . "' ORDER BY qty DESC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND condition_id='" . $condition . "' ORDER BY qty DESC";
    }

    if ($color != 0 && $status == 0) {
        $query .= " WHERE color_id='" . $color . "' ORDER BY qty DESC";
        $status = 1;
    } else if ($color != 0 && $status != 0) {
        $query .= " AND color_id='" . $color . "' ORDER BY qty DESC";
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price >= '" . $from . "' ORDER BY qty DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price >= '" . $from . "' ORDER BY qty DESC";
        }
    } else if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price <= '" . $to . "' ORDER BY qty DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price <= '" . $to . "' ORDER BY qty DESC";
        }
    } else if (!empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " WHERE price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY qty DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND price BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY qty DESC";
        }
    }
}

?>

<div class="row">
    <div class="col-12 mb-3">


        <div class="row mt-5 pt-5">
            <div class="col-12 mb-3">

                <div class="row justify-content-center gap-5">

                    <?php

                    if ($_POST["page"] != "0") {

                        $pageno = $_POST["page"];
                    } else {

                        $pageno = 1;
                    }

                    $product_rs = Database::search($query);
                    $product_num = $product_rs->num_rows;

                    $results_per_page = 5;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $viewed_results_count = ((int)$pageno - 1) * $results_per_page;

                    $query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
                    $results_rs = Database::search($query);
                    $results_num = $results_rs->num_rows;

                    while ($results_data = $results_rs->fetch_assoc()) {

                    ?>

                        <div class="card crd col-6 col-lg-2 mt-2 mb-2" style="width: 14rem;">

                            <?Php

                            $img_rs = Database::search("SELECT * FROM product_img WHERE product_id='" . $results_data['id'] . "'");

                            $img_data = $img_rs->fetch_assoc();

                            ?>
                            <a href='<?php echo "singleProductView.php?id=" . ($results_data["id"]); ?>'><img src="<?php echo $img_data["img_path"]; ?>" class="card-img img-thumbnail mt-2" style="height: 180px;"></a>

                            <div class="card-body ms-0 m-0 text-center">
                                <h5 class="card-title fw-bold fs-6"><?php echo $results_data["title"]; ?></h5>

                                <?php

                                if ($results_data["condition_id"] == 1) {

                                ?>

                                    <span class="badge text-bg-light opacity-60 mb-2" style="font-size: 20;">Brand New</span><br />

                                <?php

                                } else {

                                ?>

                                    <span class="badge text-bg-light opacity-60 mb-2" style="font-size: 20;">Used</span><br />


                                <?php

                                }

                                ?>

                                <span class="card-text text-light  fw-bold">Rs. <?php echo $results_data["price"]; ?> .00</span><br />

                                <?php

                                if ($results_data["qty"] == 0) {

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
                                        <a href='<?php echo "singleProductView.php?id=" . ($results_data["id"]); ?>' class="col-7 btn buy-btn py-0">Buy Now</a>

                                        <button onclick="addToCart(<?php echo $results_data['id']; ?>);" class="ms-1 col-1 btn btn-outline-none  py-0">
                                            <i class="bi bi-cart4 fs-5 text-light"></i>
                                        </button>

                                        <button onclick="addToWatchlist(<?php echo $results_data['id']; ?>);" class="ms-4 col-1 btn btn-outline-none  py-0 px-0">
                                            <i class="bi bi-suit-heart-fill fs-5 text-light"></i>
                                        </button>

                                    </div>

                                <?php

                                }

                                ?>

                                <!-- <span class="card-text text-light"><?php echo $results_data["qty"]; ?> Items Available</span><br /> -->

                            </div>
                        </div>

                    <?php
                    }

                    ?>
                </div>
            </div>

        </div>

    </div>
</div>



<!-- Paginition -->

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-5 mb-5 text-light">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                        ?> onclick="advancedSearch('<?php echo ($pageno - 1); ?>')" <?php
                                                                                                } ?>>&laquo;
                </a>
            </li>

            <?php

            for ($page = 1; $page <= $number_of_pages; $page++) {

                if ($page == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch('<?php echo ($page); ?>')" class="active">
                            <?php echo $page; ?>
                        </a>
                    </li>
                <?Php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch('<?php echo ($page); ?>')">
                            <?php echo $page; ?>
                        </a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                        ?> onclick="advancedSearch('<?php echo ($pageno + 1); ?>')" <?php
                                                                                                } ?>>&raquo;
                </a>
            </li>
        </ul>
    </nav>
</div>
</div>
</div>

<!-- Paginition -->

<?php include "footer.php"; ?>