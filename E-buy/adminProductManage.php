<?php
session_start();

if (isset($_SESSION["a"])) {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Product Management</title>
    <link rel="icon" href="resource\logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="admin-body">

    <!-- Nav Bar -->
    <?php include "adminNavbar.php" ?>
    <!-- Nav Bar -->

    <div class="offset-1 col-10 mt-0 mt-lg-4 text-item">
        <h2 class="text-center fw-bold">Administration of Products</h2>

        <div class="row mt-5 mb-5 p-mng-box">

            <!-- Register Brand -->
            <div class="col-10 col-lg-4 offset-1 pt-3 pb-4 mt-5">

                <lable for="form-lable" class="p-mng-txt">Brand Name</lable>
                <input type="text" placeholder="Enter Your Brand" class="form-control mt-3 mb-3 search-bar" id="brand" />


                <div class="d-none" id="msgDiv1" onclick="reload();">
                    <div class="alert alert-danger" id="msg1"></div>
                </div>

                <div class="mt-4">
                    <button class="register-btn col-12" onclick="registerBrand();">Register Brand</button>
                </div>

            </div>
            <!-- Register Brand -->

            <!-- Register Category -->
            <div class="offset-1  offset-lg-2 col-10 col-lg-4 pt-3 pb-4 mt-5">

                <lable for="form-lable" class="p-mng-txt">Category</lable>
                <input type="text" placeholder="Enter Your Category" class="form-control mt-3 mb-3 search-bar" id="cat" />


                <div class="d-none" id="msgDiv2" onclick="reload();">
                    <div class="alert alert-danger" id="msg2"></div>
                </div>

                <div class="mt-4">
                    <button class="register-btn col-12" onclick="registerCat();">Register Category</button>
                </div>

            </div>
            <!-- Register Category -->

            <!-- Register Color -->
            <div class="col-10 col-lg-4 offset-1 pt-3 pb-4 mt-5 mb-5">

                <lable for="form-lable" class="p-mng-txt">Color</lable>
                <input type="text" placeholder="Enter Your Color" class="form-control mt-3 mb-3 search-bar" id="color" />

                <div class="d-none" id="msgDiv3" onclick="reload();">
                    <div class="alert alert-danger" id="msg3"></div>
                </div>

                <div class="mt-4">
                    <button class="register-btn col-12" onclick="registerColor();">Register Color</button>
                </div>

            </div>
            <!-- Register Color -->

            <!-- Register Model -->
            <div class="offset-1  offset-lg-2 col-10 col-lg-4 pt-3 pb-4 mt-5 mb-5">

                <lable for="form-lable" class="p-mng-txt">Model</lable>
                <input type="text" placeholder="Enter Your Model" class="form-control mt-3 mb-3 search-bar" id="model" />


                <div class="d-none" id="msgDiv4" onclick="reload();">
                    <div class="alert alert-danger" id="msg4"></div>
                </div>

                <div class="mt-4">
                    <button class="register-btn col-12" onclick="registerModel();">Register Model</button>
                </div>

            </div>
            <!-- Register Model -->

        </div>
        <?php include "footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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