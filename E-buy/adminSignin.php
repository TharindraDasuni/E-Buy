<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Buy | Admin Login</title>
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
                            <h2>Welcome to the <br /><span>Admin Portal</span></h2>
                            <p>Manage and streamline your e-commerce operations with ease.</p>

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

                            <div class="box" id="signIn-Box">
                                <div class="form" id="forgetPassword">

                                    <h2 class="login-heading text-center pb-2">Admin Sign In</h2>

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
                                        <input type="text" required="required" id="e" value="<?php echo $email; ?>" class="p-2">
                                        <span>Email Address</span>
                                        <i></i>
                                    </div>

                                    <div class="inputBox mt-5">
                                        <input type="password" required="required" id="p" value="<?php echo $password; ?>" class="p-2">
                                        <span>Password</span>
                                        <i></i>
                                    </div>

                                    <div class="remember-password">
                                        <div class="mt-4 pb-5">
                                            <label for=""><input type="checkbox" class="form-check-input" id="rememberme">Remember Me</label>
                                        </div>

                                        <div class="text-end mt-4 pb-5">
                                            <a href="#" class="forget-pw" onclick="adminchangePassword();" style="text-decoration: none;">Forget Password</a>
                                        </div>
                                    </div>

                                    <button class="button p-2" onclick="changeViewAdmin();">Send Verification Code</button>

                                         
                                    <div class="create-account">
                                    <p class="mt-3">Back to User Login? <a href="#" onclick="back();" style="text-decoration: none;" class="forget-pw">User Login</a></p>
                                    </div>
                                   
                                    </div>
                                </div>
                            </div>
                            <!-- SignIn Verification Box -->

                            <div class="box  d-none" id="signIn-Box-V">
                                <div class="form" id="forgetPassword">

                                    <h2 class="login-heading text-center pb-5">Admin Sign In</h2>

                                    <div class="col-12 d-none mt-5 pb-1 text-center" id="msgdiv2">
                                        <div class="alert-box alert-box2" role="alert" id="msg2">
                                        </div>
                                    </div>

                                    <div class="inputBox mt-5">
                                        <input type="text" required="required" id="vCode" class="p-2">
                                        <span>Verification Code</span>
                                        <i></i>
                                    </div>

                                    
                                    <button class="button mt-5 p-2" onclick="adminSignIn();">Admin Log In</button>
                                    <div class="create-account  mt-4">
                                        
                                    <div class="create-account mt-3">
                                        <p>Don't want Admin Login? <a href="#" onclick="changeViewAdmin();" style="text-decoration: none;" class="forget-pw">Back</a></p>
                                    </div>
                                      

                                </div>
                            </div>
                        </div>
                    </div>
                
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