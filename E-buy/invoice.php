<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Invoice</title>
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
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

                $rs = Database::search("SELECT * FROM `invoice` WHERE order_id = '" . $oid . "'");
                $num = $rs->num_rows;

                $d = $rs->fetch_assoc();

            ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-5" onclick="printInvoice();"><i class="bi bi-file-earmark-pdf"></i> Export as PDF</button>
                </div>

                <div class="col-md-12 col-lg-12">
                    <hr />
                </div>

                <div class="col-12 bg-light" id="page">
                    <div class="row">

                        <div class="invoiceHeader">
                            <div class="col-12 p-5">
                                <div class="row">

                                    <div class="row">
                                        <h1 style="font-family: BlackFuture; color: #97219fa6;" class="col-6">E-Buy</h1>
                                        <h1 style="font-family: Spaced;" class="col-6 text-end fw-bold text-dark">I N V O I C E</h1>
                                    </div>

                                    <div class="col-12 fw-bold  text-secondary">
                                        <span>No 51,Homagama, Colombo 10, Sri Lanka.</span><br />
                                        <span>+94 112575445</span><br />
                                        <span>ebuy@gmail.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-2 border-light" />
                        </div>

                        <div class="col-12 mb-4 ps-5 pe-5 text-dark">
                            <div class="row">

                                <?php

                                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id = city.id WHERE `user_email`='" . $umail . "'");
                                $address_data = $address_rs->fetch_assoc();

                                ?>

                                <div class="col-6 text-dark">
                                    <h5 class="fw-bold">ISSUED TO :</h5>
                                    <span><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></span><br />
                                    <span><?php echo $address_data["line1"] . " , " . $address_data["line2"] . " , " . $address_data["name"] . " . "; ?></span><br />
                                    <span><?php echo $_SESSION["u"]["mobile"]; ?></span><br />
                                    <span><?php echo $umail; ?></span>
                                </div>

                                <?php

                                $invoice_rs = Database::search("SELECT * FROM invoice INNER JOIN product ON invoice.product_id=product.id 
                                INNER JOIN `brand_has_model` ON 
                                brand_has_model.id=product.brand_has_model_id 
                                    INNER JOIN `color` ON color.id=product.color_id 
                                    INNER JOIN `category` ON category.id=product.category_id
                                    INNER JOIN `condition` ON condition.id=product.condition_id  
                                
                                    INNER JOIN `brand` ON brand.id=brand_has_model.brand_id
                                    
                                    WHERE invoice.order_id='" . $oid . "'");
                                $invoice_data = $invoice_rs->fetch_assoc();

                                ?>

                                <div class="col-6 text-end">
                                    <h4 class=""><?php echo $invoice_data["id"]; ?></h4>
                                    <span class="fw-bold">Data & Time: </span>&nbsp;
                                    <span class="fw-bold"><?php echo $invoice_data["date"]; ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="mb-4 ps-5 pe-5 text-dark">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="border border-1 border-dark">
                                        <th class="text-center">Order ID</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Color</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $invoice_rs = Database::search("SELECT `invoice`.`order_id`,`product`.`title`,`invoice`.`qty`,`product`.`price`,`product`.`delivery_fee_colombo`,`product`.`delivery_fee_other`,`color`.`name` FROM `invoice` INNER JOIN `product` ON
                                `invoice`.`product_id` = `product`.`id` INNER JOIN `color` ON
                                `color`.`id`=`product`.`color_id`
                                WHERE `order_id` = '" . $oid . "'");
                                    $invoice_num = $invoice_rs->num_rows;

                                    $delivery = 0;
                                    $sub_total = 0;
                                    $qty = 0;

                                    for ($x = 0; $x < $invoice_num; $x++) {
                                        $in_data = $invoice_rs->fetch_assoc();


                                        if ($city_data["district_id"] == 1) {
                                            $delivery = $delivery + 300;
                                        } else {
                                            $delivery = $delivery + 350;
                                        }

                                        $sub_total = $sub_total + ($in_data["price"] * $in_data["qty"]);

                                    ?>
                                        <tr>
                                            <td class="text-dark fs-6 p-3"><?php echo $in_data["order_id"]; ?></td>
                                            <td class=" text-center fs-6 p-3"><?php echo $in_data["title"]; ?></td>
                                            <td class=" fs-6 text-center pt-3"><?php echo $in_data["name"]; ?></td>
                                            <td class=" fs-6 text-center pt-3">Rs. <?php echo $in_data["price"]; ?> .00</td>
                                            <td class="fs-6 text-center pt-3"><?php echo $in_data["qty"]; ?></td>
                                            <td class=" fs-6 text-end pt-3">Rs. <?php echo $in_data["price"]; ?> .00</td>
                                        </tr>
                                    <?php

                                    }

                                    ?>


                                </tbody>
                                <tfoot>

                                    <tr>
                                        <td colspan="4" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold text-muted">SUBTOTAL</td>
                                        <td class="text-end text-muted">Rs. <?php echo $sub_total; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-secondary text-muted">DELIVERY FEE</td>
                                        <td class="text-end border-secondary  text-muted">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <?php
                                        
                                        $total = $invoice_data["total"];
                                        
                                        ?>

                                        <td colspan="4" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-dark text-dark">NET TOTAL</td>
                                        <td class="fs-5 text-end fw-bold border-dark text-dark">Rs. <?php echo $total; ?> .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-12 text-center mt-5">
                            <span class="fs-3 fw-bold text-dark" style="font-family: Spaced;">Thank You for Your Purchasing</span>
                        </div>

                        <div class="offset-1 col-10 mt-3 mb-3 border-0 border-5 border-secondary rounded" style="background-color: #e7f2ff;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold">NOTICE : </label>
                                    <br />
                                    <label class="form-label fs-6">Purchased items can return befor 7 days of Delivery.</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-secondary" />
                        </div>

                        <div class="col-12 mb-4 ps-5 pe-5  text-center mb-3">
                            <label class="form-label fs-6 text-black text-muted">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
                </div>

            <?php
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>