<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="btn d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" color="white" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                    </svg></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <a class="navbar-brand ps-5 ps-lg-4" href="index.php" style="color:white; font-family: BlackFuture; font-size: 35px;"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-amd" viewBox="0 0 16 16">
                        <path d="m.334 0 4.358 4.359h7.15v7.15l4.358 4.358V0H.334ZM.2 9.72l4.487-4.488v6.281h6.28L6.48 16H.2V9.72Z" />
                    </svg>
                    E-Buy
                </a>

                <div class="container justify-content-center d-flex">
                    <div class="row align-content-center">
                        <ul class="offset-lg-4 navbar-nav mr-auto mt-2 mt-lg-0">


                            <li class="nav-item active ">
                                <a class="nav-link text-nav" href="index.php" style="color:white;">Home</a>
                            </li>

                            <li class="nav-item active">
                                <a class="nav-link text-nav " href="cart.php" style="color:white;">cart</a>
                            </li>

                            
                            <li class="nav-item active">
                                <a class="nav-link text-nav " href="watchlist.php" style="color:white;">Wishlist</a>
                            </li>

                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle text-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                                    Selling
                                </a>
                                <ul class="dropdown-menu dropdwn-lists">
                                    <li><a class="dropdown-item navbar-txt" href="addProduct.php">Add Products</a></li>
                                    <!-- <li><a class="dropdown-item navbar-txt" href="#">Oders</a></li> -->
                                    <li><a class="dropdown-item navbar-txt" href="stockManage.php">Store</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                                    More
                                </a>
                                <ul class="dropdown-menu  dropdwn-lists">
                                    <li><a class="dropdown-item navbar-txt" href="watchlist.php">Wish List</a></li>     
                                    <li><a class="dropdown-item navbar-txt" href="cart.php">cart</a></li>                     
                                    <li><a class="dropdown-item navbar-txt" href="orderHistory.php">Purchased History</a></li>                       
                                    <li><a class="dropdown-item navbar-txt" href="updateProfile.php">Profile</a></li>
                                </ul>
                            </li>


                            <div class="px-5 col-12 col-lg-3 mt-2 text-center text-lg-end d-lg-none">
                                <?php
                                if (isset($_SESSION["u"])) {
                                    $session_data = $_SESSION["u"];
                                ?>

                                    <button class="login-or-signup text-decoration-none text-light" onclick="signout();">Sign Out</button>
                                <?php
                                } else {
                                ?>
                                    <button class="login-or-signup">
                                        <a href="signin.php" class="text-decoration-none text-light">
                                            Sign In or Sign Up
                                        </a></button>
                                <?php
                                }
                                ?>
                            </div>

                        </ul>
                    </div>
                </div>

            </div>

            <div class="pe-5 col-12 col-lg-3 mt-2 text-center text-lg-end d-none d-lg-block">
                <div class="row">
                    <div class="col-7">
                        <?php
                        if (isset($_SESSION["u"])) {
                            $session_data = $_SESSION["u"];
                        ?>
                            <span class="text-light"><span class="text-nav">Welcome</span>
                                <b><?php echo $session_data["fname"] . " " . $session_data["lname"]; ?></b>
                            </span>
                         
                    </div>

                    <div class="col-4">
                    <button class="login-or-signup text-decoration-none text-light" onclick="signout();">Sign Out</button>
                        <?php
                        } else {
                        ?>
                    </div>
                </div>

                <button class="login-or-signup">
                    <a href="signin.php" class="text-decoration-none text-light">
                        Sign In or Sign Up
                    </a></button>
            <?php
                        }
            ?>
            </div>
        </div>

    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="script.js"></script>
</body>

</html>