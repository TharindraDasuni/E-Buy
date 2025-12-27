<?php
session_start();

// if (isset($_SESSION["a"])) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Inventory Management</title>
    <link rel="icon" href="resource\logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="admin-body">

    <!-- Nav Bar -->
    <?php include "adminNavbar.php" ?>
    <!-- Nav Bar -->

    <div class="adminBody">
        <div class="row">
            <div class="col-5">
                <h2 class="text-center">Product Registration</h2>

                <div class="mb-3">
                    <label for="form-lable" for="">Product Name</label>
                    <input type="text" class="form-control">
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="form-lable" for="">Brand</label>
                        <select class="form-select">
                            <option>Select</option>
                            <option>Apple</option>
                        </select>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="form-lable" for="">Category</label>
                        <select class="form-select">
                            <option>Select</option>
                            <option>Phone</option>
                        </select>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="form-lable" for="">Color</label>
                        <select class="form-select">
                            <option>Select</option>
                            <option>white</option>
                        </select>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="form-lable" for="">Product Image</label>
                       <input class="form-control" type="file">
                    </div>

                    
                    <div class="mb-3">
                        <label for="form-lable" for="">Description</label>
                        <textarea class="form-control"></textarea>
                    </div>

                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>