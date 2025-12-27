<!-- Fogot Password Box -->

<h2 class="login-heading text-center pb-1">Forgot Password</h2>

<div class="col-12 d-none mt-1 mb-5 text-center" id="fogotpwdiv1">
    <div class="alert-box alert-box2" role="alert" id="fogotpw1">
    </div>
</div>


<div class="inputBox-fpw mt-4">

    <input type="text" required="required" id="email2" class="p-2">
    <span>Email Address</span>
    <i></i>

</div>

<button class="button mt-3 p-1" onclick="forgotPassword();">Send Verification Code</button>

    <div class="inputBox-fpw mt-4">
        <input type="text" required="required" id="verificationCode" class="p-2">
        <span>Verification Code</span>
        <i></i>
    </div>

    <div class="inputBox-fpw mt-4">
        <input type="password" required="required" id="np" class="p-2">
        <span>New Password</span>
        <!-- <button class="showpw offset-9" type="button" id="npb" onclick="showPassword();">Show</button> -->
        <i></i>
    </div>

    <div class="inputBox-fpw mt-4">
        <input type="password" required="required" id="rnp" class="p-2" />
        <span>Confirm Password</span>
        <!-- <button class="showpw offset-9" type="button" id="rnpb" onclick="showPassword2();">Show</button> -->
        <i></i>
    </div>

    <button class="button mt-3 p-1" onclick="resetPassword();">Change Password</button>

    <div class="create-account mt-3">
        <p>Cancel Password Update? <a href="#" onclick="back();" style="text-decoration: none;" class="forget-pw">Back</a></p>
    </div>


    <!-- Fogot Password Box -->