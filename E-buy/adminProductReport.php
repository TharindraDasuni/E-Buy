<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

    $rs =  Database::search("SELECT `product`.`id`,`product`.`title`,`category`.`name` AS `cname`,
    `brand`.`name` AS `bname`, `model`.`name` AS `mname`, `color`.`name` AS clr_name,
    `product`.`description`, `product_img`.`img_path` FROM `product` INNER JOIN `brand_has_model` ON
    `product`.`brand_has_model_id` = `brand_has_model`.`id`
    INNER JOIN `brand` ON `brand_has_model`.`brand_id` = `brand`.`id`
    INNER JOIN `color` ON `product`.`color_id` = `color`.`id`
    INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
    INNER JOIN `model` ON `brand_has_model`.`model_id` = `model`.`id`
    INNER JOIN `product_img` ON `product_img`.`product_id` = `product`.`id`
    ORDER BY `product`.`id` ASC");

    $num = $rs->num_rows;

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

        <!-- nav bar  -->
        <?php
        include "adminNavbar.php";
        ?>
        <!-- nav bar  -->

        <div class="offset-1 col-10 btn-toolbar justify-content-end mt-5">
            <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
            <button class="btn btn-danger me-5" onclick="printInvoice();"><i class="bi bi-file-earmark-pdf"></i> Export as PDF</button>
        </div>

        <div class="container" id="page">
            <div class="col-12 mt-3 mt-lg-4 text-item bg-light p-5 mb-5">
                <h2 class="text-center text-dark">
                    <link rel="icon" href="resource\logob.svg" />E-Buy Product Report
                </h2>

                <table class="table border border-2 border-dark table-hover mt-5 bg-light p-5">
                    <thead class="text-center">
                        <tr>
                            <th class="border border-2 border-dark">Product Id</th>
                            <th class="border border-2 border-dark">Product Image</th>
                            <th class="border border-2 border-dark">Product Name</th>
                            <th class="border border-2 border-dark">Category</th>
                            <th class="border border-2 border-dark">Brand Name</th>
                            <th class="border border-2 border-dark">Model</th>
                            <th class="border border-2 border-dark">Color</th>
                            <th class="border border-2 border-dark">Description</th>


                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        for ($i = 0; $i < $num; $i++) {
                            $d = $rs->fetch_assoc();
                        ?>
                            <tr>
                                <td class="text-center border border-2 border-dark"><?php echo $d["id"] ?></td>
                                <td class="text-center border border-2 border-dark"><img src="<?php echo $d["img_path"] ?>" height="120"></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["title"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["cname"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["bname"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["mname"] ?></td>
                                <td class="text-center border border-2 border-dark"><?php echo $d["clr_name"] ?></td>
                                <td class="text-center border border-2 border-dark justify-content-center"><?php echo $d["description"] ?></td>


                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>


                </table>
            </div>
        </div>

        <?php include "footer.php"; ?>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>


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
                            window.location = "adminSignin.php";
                        }
                    });
                </script>
            </body>
          </html>';
    exit();
}


?>