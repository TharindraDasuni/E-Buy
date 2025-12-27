<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy</title>
    <link rel="icon" href="resource\logo.png" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />

</head>

<body class="main-content">

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <div class="col-12 login-box rounded-5" style="height: 75vh;">
                <div class="row">
                    <div class="col-6 d-none d-lg-block item content rounded-5" style="height: 75vh;">

                        <a href="index.php" class="text-decoration-none">
                            <h2 class="logo p-5 mb-5 item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-amd" viewBox="0 0 16 16">
                                    <path d="m.334 0 4.358 4.359h7.15v7.15l4.358 4.358V0H.334ZM.2 9.72l4.487-4.488v6.281h6.28L6.48 16H.2V9.72Z" />
                                </svg>
                                E-Buy
                            </h2>
                        </a>

                        <div class="col-12 px-5 pt-5 mt-5 text-item"><br /><br /><br />
                            <h2>Welcome to Our <br /><span>E-commerce World</span></h2>
                            <p>Discover Endless Shopping Possibilities With Us.</p>
                        </div>

                        <div class="col-12 social-icon ms-5">
                            <a href="#"><i class="bi bi-facebook" style="color:white;"></i></a>
                            <a href="#"><i class="bi bi-twitter" style="color:white;"></i></a>
                            <a href="#"><i class="bi bi-youtube" style="color:white;"></i></a>
                            <a href="#"><i class="bi bi-instagram" style="color:white;"></i></a>
                            <a href="#"><i class="bi bi-linkedin" style="color:white;"></i></a>
                        </div>
                    </div>

                    <!-- SignIn Box -->
                    <div class="col-12 col-lg-6 d-flex justify-content-center login-section">
                        <div class="align-content-center">

                            <div class="box d-none" id="signIn-Box">
                                <div class="form" id="forgetPassword">

                                    <h2 class="login-heading text-center pb-2">Sign In</h2>

                                    <?php

                                    $email = "";
                                    $password = "";

                                    if (isset($_COOKIE["email"])) {
                                        $email = $_COOKIE["email"];
                                    }

                                    if (isset($_COOKIE["password"])) {
                                        $password = $_COOKIE["password"];
                                    }

                                    ?>

                                    <div class="col-12 d-none mt-5 pb-1 text-center" id="msgdiv">
                                        <div class="alert-box alert-box2" role="alert" id="msg">
                                        </div>
                                    </div>



                                    <div class="inputBox mt-5">
                                        <input type="text" required="required" id="email2" value="<?php echo $email; ?>" class="p-2">
                                        <span>Email Address</span>
                                        <i></i>
                                    </div>

                                    <div class="inputBox mt-5">
                                        <input type="password" required="required" id="password2" value="<?php echo $password; ?>" class="p-2">
                                        <span>Password</span>
                                        <i></i>
                                    </div>

                                    <div class="remember-password">
                                        <div class="mt-4 pb-5">
                                            <label for=""><input type="checkbox" class="form-check-input" id="rememberme">Remember Me</label>
                                        </div>

                                        <div class="text-end mt-4 pb-5">
                                            <a href="#" class="forget-pw" onclick="changePassword();" style="text-decoration: none;">Forget Password</a>
                                        </div>
                                    </div>

                                    <button class="button mt-1 p-2" onclick="signIn();">Log In</button>
                                    <div class="create-account  mt-4">
                                        <p class="mt-3">Create A New Account? <a href="#" onclick="changeView();" style="text-decoration: none;" class="forget-pw">Sign Up</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- SignIn Box -->

                            <!-- SignUp Box -->
                            <div class="box">
                                <div class="form" id="signUp-Box">

                                    <h2 class="login-heading text-center">Sign Up</h2>

                                    <div class="col-12 d-none" id="msgdiv2">
                                        <div class="alert-box alert-box2 pb-2" role="alert" id="msg2">
                                        </div>
                                    </div>

                                    <div class="inputBox mt-3">
                                        <input type="text" required="required" id="fname" class="p-2">
                                        <span>First Name</span>
                                        <i></i>
                                    </div>
                                    <div class="inputBox mt-3">
                                        <input type="text" required="required" id="lname" class="p-2">
                                        <span>Last Name</span>
                                        <i></i>
                                    </div>
                                    <div class="inputBox mt-3">
                                        <input type="text" required="required" id="email" class="p-2">
                                        <span>Email Address</span>
                                        <i></i>
                                    </div>
                                    <div class="inputBox mt-3">
                                        <input type="password" required="required" id="password" class="p-2">
                                        <span>Password</span>
                                        <i></i>
                                    </div>
                                    <div class="inputBox mt-3">
                                        <input type="text" required="required" id="mobile" class="p-2">
                                        <span>Contact Number</span>
                                        <i></i>
                                    </div>

                                    <div class="create-account mt-3">
                                        <p>Already Have An Account? <a href="#" onclick="changeView();" style="text-decoration: none;" class="forget-pw">Sign In</a></p>
                                    </div>

                                    <button class="button p-2 mt-2" onclick="signUp();">Sign Up</button>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!-- SignUp Box -->


                </div>

                <!-- footer -->
                <div class="col-12 mt-4">
                    <p class="text-center copywrite">&copy; 2024 E-Buy.lk | All Rights Reserved</p>
                </div>
                <!-- footer -->
            </div>

        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>