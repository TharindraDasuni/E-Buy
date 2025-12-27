<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="btn d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" color="white" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

            <a class="navbar-brand ps-5 ps-lg-4" href="index.php" style="color:white; font-family: BlackFuture; font-size: 35px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-amd" viewBox="0 0 16 16">
                    <path d="m.334 0 4.358 4.359h7.15v7.15l4.358 4.358V0H.334ZM.2 9.72l4.487-4.488v6.281h6.28L6.48 16H.2V9.72Z" />
                </svg>
                E-Buy
            </a>
            <a class="navbar-brand ps-5 ps-lg-1 pt-0" href="adminDashboard.php" style="color:white; font-family: Spaced; font-size: 25px;">Admin Dashboard</a>

            <div class="container d-flex">
                <div class="row align-content-center">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                        <li class="nav-item active offset-2 col-12 col-lg-5">
                            <a class="nav-link text-nav" href="adminUserManagement.php" style="color:white;">Manage Users</a>
                        </li>

                        <li class="nav-item active col-12 col-lg-6">
                            <a class="nav-link text-nav" href="adminProductManage.php" style="color:white;">Manage Products</a>
                        </li>

                        <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle text-nav" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;">
                                Reports
                                </a>
                                <ul class="dropdown-menu dropdwn-lists">
                                    <li><a class="dropdown-item navbar-txt" href="adminUserReport.php">User Report</a></li>
                                    <li><a class="dropdown-item navbar-txt" href="adminProductReport.php">Product Report</a></li>
                                    <li><a class="dropdown-item navbar-txt" href="adminSellingReport.php">Selling Report</a></li>
                                    <!-- <li><a class="dropdown-item navbar-txt" href="#">Oders</a></li> -->
                                    <li><a class="dropdown-item navbar-txt" href="adminDailyEarningsReport.php">Daily Earnings Report</a></li>
                                </ul>
                            </li>

                        <!-- <li class="nav-item active col-12 col-lg-5 ">
                            <a class="nav-link text-nav" href="adminStock.php" style="color:white;">Manage Inventory</a>
                        </li> -->
                        <!-- 
                        <li class="nav-item active col-12 col-lg-4">
                            <a class="nav-link text-nav" href="adminReport.php" style="color:white;">Reports</a>
                        </li> -->

                    </ul>


                    <!-- <div class="px-5 col-12 col-lg-3 mt-2 text-center text-lg-end d-lg-none">
                        <?php
                        if (isset($_SESSION["a"])) {
                            $session_data = $_SESSION["a"];
                        ?>

                            <button class="login-or-signup text-decoration-none text-light" onclick="adminsignout();">Sign Out</button>
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
                    </div> -->

                    </ul>
                </div>
            </div>

        </div>

        <div class="pe-5 col-12 col-lg-3 text-center text-lg-end d-none d-lg-block">
            <div class="row">
                <div class="col-7">
                    <?php
                    if (isset($_SESSION["a"])) {
                        $session_data = $_SESSION["a"];
                    ?>
                        <span class="text-light"><span>Hello</span>
                            <?php echo $session_data["fname"] . " " . $session_data["lname"]; ?>
                        </span>

                </div>

                <div class="col-4">
                    <button class="login-or-signup text-decoration-none text-light" onclick="adminsignout();">Sign Out</button>
                <?php
                    } else {
                ?>
                </div>
            </div>

            <button class="login-or-signup">
                <a href="adminsignin.php" class="text-decoration-none text-light">
                    Sign In or Sign Up
                </a></button>
        <?php
                    }
        ?>
        </div>
    </div>

</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>