<?php
session_start();

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {

    $email = $_POST["e"];
    $password = $_POST["p"];
    $rememberme = $_POST["rm"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num == 1) {
        $code = uniqid();
        Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ranjanietamil@gmail.com';
        $mail->Password = 'gnzglzielkmpaaet';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ranjanietamil@gmail.com', 'E-Buy Admin Verification');
        $mail->addReplyTo('ranjanietamil@gmail.com', 'E-Buy Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'E-Buy Admin Verification Code';

        $bodyContent =
            "<html>
        <head>
        <style>
            body
            {
                width: 200px;
                height: auto;
                background-color: #4f1652;
                border-radius: 15px;
            }
            h2
            {
                background-color: #41054d90;
                color:white;
                margin-top: 5px;
                margin-bottom: 5px;
                text-align:center;
            }
            h3{
             color: #41054d90;
            }
            h4{
             color: #41054d90;
            }
            #message
            {
                width: 500px;
                height: auto;
                margin-bottom: 5px;
                margin-left: auto;
                margin-right: auto;
                color:black;
                justify-content: center;
            }
            p{
             color:black;
            }


        </style>
        </head>

        <body>
        
        <h2>E-Buy</h2>
            <div id = 'message'>
            <p><b> Dear Admin,</b><br/>

            We appreciate your trust in E-Buy. To complete your Admin Email Verification process, please enter the following code on the verification page:</p><b><h3> " . $code . "</h3></b>
            <p>
            <b>Please do not share this code with anyone.</b><br/><br/>
            
            We would like to remind you to exercise caution and keep this one-time verification code confidential. Your security is important to us.<br/>
            
            Thank you for choosing E-Buy, and if you have any questions or need assistance, feel free to contact our support team.
            <br/><br/>
            Best regards,<br/></p>
            <h4>The E-Buy Team</h4>                  
            </div>

        </body>
      </html>";

        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ('Failed to send verification code');
        } else {
            echo ('success');

            $d = $admin_rs->fetch_assoc();
            $_SESSION["a"] = $d;
    
            if ($rememberme == "true") {
    
                setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                setcookie("password", $password, time() + (60 * 60 * 24 * 365));
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }
        }
    } else if (empty($email)) {
        echo ("Please Provide Email Address");
    } else if (empty($password)) {
        echo ("Please Provide Your Password");
    } else {
        echo ("Invalid Email or Password");
    }
} else {
    echo ("invalid email address");
}

