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

<body class="main-content shadow">

    <div class="container-fluid vh-100 d-flex justify-content-center">


        <!-- SIGNIN BOX -->
        <div class="row align-content-center">

            <div class="col-12">

                <div class="box-background">

                    <div class="row login-box">

                        <div class="col-6 d-none d-lg-block">

                            <div class="row">
                                <div class="col-12 item">
                                    <h2 class="logo p-5 mb-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-amd" viewBox="0 0 16 16">
                                            <path d="m.334 0 4.358 4.359h7.15v7.15l4.358 4.358V0H.334ZM.2 9.72l4.487-4.488v6.281h6.28L6.48 16H.2V9.72Z" />
                                        </svg>
                                        E-Buy
                                    </h2>
                                </div>

                                <div class="col-12 text-item px-5 pt-5 mt-5">
                                    <h2>Welcome to Our <br />E-commerce World!</h2>
                                    <p>Discover endless shopping possibilities with us.</p>
                                </div>

                                <div class="col-12 social-icon ms-5 ">
                                    <a href="#"><i class="bi bi-facebook" style="color:white;"></i></a>
                                    <a href="#"><i class="bi bi-twitter" style="color:white;"></i></a>
                                    <a href="#"><i class="bi bi-youtube" style="color:white;"></i></a>
                                    <a href="#"><i class="bi bi-instagram" style="color:white;"></i></a>
                                    <a href="#"><i class="bi bi-linkedin" style="color:white;"></i></a>
                                </div>

                            </div>

                        </div>

                        <!-- SIGN IN FORM -->
                        <div class="col-12 col-lg-6 login-section justify-content-center">
                            <div class="row align-content-center">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-box login">
                                            <form action="" id="signIn-Box2" class="p-0 p-lg-5 mt-0 ms-0 ms-lg-5">

                                                <h2>Sign In</h2>

                                                <div class="input-box mb-5">
                                                    <span class="icon"><i class="bi bi-envelope-fill"></i></span>
                                                    <input type="email" required id="email2" value="<?php echo $email; ?>">
                                                    <label>Email</label>
                                                </div>

                                                <div class="input-box">
                                                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-lock-fill" viewBox="0 0 16 16">
                                                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                                            <path d="m8 3.293 4.72 4.72a3 3 0 0 0-2.709 3.248A2 2 0 0 0 9 13v2H3.5A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                                            <path d="M13 9a2 2 0 0 0-2 2v1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1v-1a2 2 0 0 0-2-2Zm0 1a1 1 0 0 1 1 1v1h-2v-1a1 1 0 0 1 1-1Z" />
                                                        </svg></span>
                                                    <input type="password" required id="password2" value="<?php echo $password; ?>">
                                                    <label>Password</label>
                                                </div>

                                                <div class="remember-password">
                                                    <label for=""><input type="checkbox" id="rememberme">Remember Me</label>
                                                    <a href="#" onclick="forgotPassword();">Forget Password</a>
                                                </div>
                                                <button class="button" onclick="signUp();">Log In</button>
                                                <div class="create-account">
                                                    <p>Create A New Account? <a href="#" onclick="changeView();">Sign Up</a></p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- sign up -->
                                <form action="" id="signUp-Box2" class=" p-3 mt-2 ms-5 d-none">

                                    <h2>Sign Up</h2>

                                    <div class="input-box">
                                        <span class="icon"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" required id="fname">
                                        <label>First Name</label>
                                    </div>
                                    <div class="input-box">
                                        <span class="icon"><i class="bi bi-person-fill"></i></span>
                                        <input type="text" required id="lname">
                                        <label>Last Name</label>
                                    </div>
                                    <div class="input-box">
                                        <span class="icon"><i class="bi bi-envelope-fill"></i></span>
                                        <input type="email" required id="email">
                                        <label>Email</label>
                                    </div>
                                    <div class="input-box">
                                        <span class="icon"><i class="bi bi-telephone-fill"></i></span>
                                        <input type="text" required id="mobile">
                                        <label>Contact No</label>
                                    </div>
                                    <div class="input-box">

                                        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-lock-fill" viewBox="0 0 16 16">
                                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                                <path d="m8 3.293 4.72 4.72a3 3 0 0 0-2.709 3.248A2 2 0 0 0 9 13v2H3.5A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                                <path d="M13 9a2 2 0 0 0-2 2v1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1v-1a2 2 0 0 0-2-2Zm0 1a1 1 0 0 1 1 1v1h-2v-1a1 1 0 0 1 1-1Z" />
                                            </svg></span>
                                        <input type="password" required id="password">
                                        <label>Password</label>
                                    </div>

                                    <button class="button" onclick="signUp();">Sign Up</button>
                                    <div class="create-account">
                                        <p>Already Have An Account? <a href="#" onclick="changeView();">Sign In</a></p>
                                    </div>
                                </form>
                            </div>

                            <!-- END OF SIGN IN FORM -->

                        </div>
                    </div>
                </div>



                <!-- modal -->

                <div class="modal" tabindex="-1" id="forgotPasswordModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Forgot Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row g-3">

                                    <div class="col-6">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="np" />
                                            <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();">Show</button>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Re-type Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" id="rnp" />
                                            <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">Show</button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Verification Code</label>
                                        <input type="text" class="form-control" id="vc" />
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- footer -->
            <div class="col-12 fixed-bottom  d-lg-block">
                <p class="text-center" style="color:white;">&copy; 2023 E-Buy.lk | All Rights Reserved</p>
            </div>
            <!-- footer -->

        </div>

        <script src="script.js"></script>
</body>

</html>


 <!-- 
                                      <div class="col-12  text-center login">
                                <h1><b>Sign In</b></h1>
                            </div>

                                    <div class="row">
                                <div class="login col-12">
                                    <div class="form-box">
                                        <form>

                                            <div class="row">
                                                <div class="col-12 input-box">
                                                    <span class="icon"><i class="bi bi-envelope-fill"></i></span>
                                                    <input type="email" required>
                                                    <label class="fw-bold">Email</label>
                                                </div>

                                                <div class="col-12 input-box">
                                                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-lock-fill" viewBox="0 0 16 16">
                                                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                                                            <path d="m8 3.293 4.72 4.72a3 3 0 0 0-2.709 3.248A2 2 0 0 0 9 13v2H3.5A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                                                            <path d="M13 9a2 2 0 0 0-2 2v1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1v-1a2 2 0 0 0-2-2Zm0 1a1 1 0 0 1 1 1v1h-2v-1a1 1 0 0 1 1-1Z" />
                                                        </svg></span>
                                                    <input type="password" required>
                                                    <label class="fw-bold">Password</label>
                                                </div>

                                                <div class="col-12 remember-password">
                                                    <label for=""><input type="checkbox" id="rememberme">Remember Me</label>
                                                    <a href="#" onclick="forgotPassword();">Forget Password</a>
                                                </div>

                                                <button class="button" onclick="signIn();">Log In</button>
                                                <div class="col-12 create-account text-center">
                                                    <p>Create A New Account? <a href="#" class="register-link">Sign Up</a></p>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> -->