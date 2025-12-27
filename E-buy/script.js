function changeView() {
    var signUpBox = document.getElementById("signUp-Box");
    var signInBox = document.getElementById("signIn-Box");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}

function signUp() {

    var f = document.getElementById("fname");
    var l = document.getElementById("lname");
    var e = document.getElementById("email");
    var p = document.getElementById("password");
    var m = document.getElementById("mobile");

    var form = new FormData();
    form.append("f", f.value);
    form.append("l", l.value);
    form.append("e", e.value);
    form.append("p", p.value);
    form.append("m", m.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                // window.location = "signin.php";
                document.getElementById("msg2").innerHTML = "Registration complete, Signin";
                document.getElementById("msgdiv2").className = "d-block";
                document.getElementById("fname").value = "";
                document.getElementById("lname").value = "";
                document.getElementById("email").value = "";
                document.getElementById("password").value = "";

                document.getElementById("mobile").value = "";

            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("msgdiv2").className = "d-block";
            }
            // if (t == "success") {
            //     document.getElementById("msg").innerHTML = t;
            //     document.getElementById("msg").className = "alert alert-success";
            //     document.getElementById("msgdiv").className = "d-block";
            // } else {
            //     document.getElementById("msg").innerHTML = t;
            //     document.getElementById("msgdiv").className = "d-block";
            // }

        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(form);

}

function signIn() {
    var e = document.getElementById("email2");
    var pw = document.getElementById("password2");
    var rm = document.getElementById("rememberme");

    var f = new FormData();
    f.append("e", e.value);
    f.append("pw", pw.value);
    f.append("rm", rm.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }

    r.open("POST", "signInProcess.php", true);
    r.send(f);
}

function back() {
    window.location = "signin.php";
}

var bm;
function forgotPassword() {

    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                document.getElementById("fogotpw1").innerHTML = "Code sent to your email";
                document.getElementById("fogotpwdiv1").className = "d-block";
            } else {
                document.getElementById("fogotpw1").innerHTML = t;
                document.getElementById("fogotpwdiv1").className = "d-block";
            }

            // if (t == "success") {

            //     // changePassword();

            //     document.getElementById("fogotpw").innerHTML = "Check your email for the verification code";
            //     document.getElementById("fogotpwdiv").className = "d-block";

            // } else if (t == "Invalid Email Address") {
            //     document.getElementById("fogotpw").innerHTML = t;
            //     document.getElementById("ffogotpwdiv").className = "d-block";

            // } else {
            //     document.getElementById("fogotpw").innerHTML = t;
            //     document.getElementById("ffogotpwdiv").className = "d-block";
            // }

        }

    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();


}

function changePassword() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("forgetPassword").innerHTML = t;
        }
    }
    r.open("GET", "fogotPassword.php", true);
    r.send();
}


function showPassword() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {

        np.type = "text";
        npb.innerHTML = "Hide";

    } else {

        np.type = "password";
        npb.innerHTML = "Show";

    }

}


function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {

        rnp.type = "text";
        rnpb.innerHTML = "Hide";

    } else {

        rnp.type = "password";
        rnpb.innerHTML = "Show";

    }

}

function resetPassword() {

    var email = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("verificationCode");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                // alert("Your Password Updated");
                document.getElementById("fogotpw1").innerHTML = "Your Password Updated";
                document.getElementById("fogotpwdiv1").className = "d-block";
                // bm.hide();
                setTimeout(() => location.reload(), 3000);
            } else {
                document.getElementById("fogotpw1").innerHTML = t;
                document.getElementById("fogotpwdiv1").className = "d-block";
            }
        }
    };

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);

}



function basicSearch(x) {
    var txt = document.getElementById("basic_search_txt").value;
    var select = document.getElementById("basic_search_select").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);

}

function advancedSearch(x) {
    // var page = x;
    var category = document.getElementById("cat").value;
    var brand = document.getElementById("brand").value;
    var model = document.getElementById("model").value;
    var condition = document.getElementById("c2");
    var color = document.getElementById("color").value;
    var min = document.getElementById("min").value;
    var max = document.getElementById("max").value;
    var txt = document.getElementById("t").value;
    var sort = document.getElementById("s").value;

    // alert(category);
    // alert(brand);
    // alert(model);
    // alert(color);
    // alert(min);
    // alert(max);
    // alert(txt);
    // alert(page.value);
    // alert(sort.value);

    var f = new FormData();

    f.append("cat", category);
    f.append("b", brand);
    f.append("m", model);
    f.append("con", condition.value);
    f.append("col", color);
    f.append("min", min);
    f.append("max", max);
    f.append("t", txt);
    f.append("s", sort);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("advancedSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);
}

function adsearchbody() {
    document.getElementById("adsearch").className = "d-block";
}

function signout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                window.location = "signin.php";
            }
        }
    }

    r.open("GET", "signoutprocess.php", true);
    r.send();
}

function change() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");
}

function imageChange() {

    var img = document.getElementById("profileimage");
    img.onchange = function () {
        var files_count = img.files.length;
        for (var i = 0; i < files_count; i++) {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);
            document.getElementById("p_img").src = url;
        }
    }
}

function updateProfile() {

    var pImg = document.getElementById("profileimage").files[0];
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var mobile = document.getElementById("mobile").value;
    var gender = document.getElementById("gender").value;
    var line1 = document.getElementById("a_line1").value;
    var line2 = document.getElementById("a_line2").value;
    var pCode = document.getElementById("pc").value;
    var city = document.getElementById("city").value;
    var district = document.getElementById("district").value;
    var province = document.getElementById("province").value;

    var f = new FormData();
    f.append("pImg", pImg);
    f.append("fname", fname);
    f.append("lname", lname);
    f.append("mobile", mobile);
    f.append("gender", gender);
    f.append("addressLine1", line1);
    f.append("addressLine2", line2);
    f.append("postalcode", pCode);
    f.append("city", city);
    f.append("district", district);
    f.append("province", province);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }


    r.open("POST", "updateProfileProcess.php", true);
    r.send(f);

}

function updateUserStatus() {

    var userid = document.getElementById("uid");

    var f = new FormData();
    f.append("u", userid.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            // alert(t);
            if (response == "Deactive") {
                documen.getElementById("msg").innerHTML = "User Deactivate Successfully";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgDiv").className = "d-block";
                userid.value = "";
                usersLoad();

            } else if (response == "Active") {
                documen.getElementById("msg").innerHTML = "User Activate Successfully";
                document.getElementById("msg").className = "alert alert-success";
                document.getElementById("msgDiv").className = "d-block";
                userid.value = "";
                usersLoad();

            } else {
                documen.getElementById("msg").innerHTML = t;
                document.getElementById("msgDiv").className = "d-block";
            }
        }
    }

    r.open("POST", "updateUserStatusProcess.php", true);
    r.send(f);

}

function reload() {
    location.reload();
}

function registerBrand() {
    var brand = document.getElementById("brand");

    var f = new FormData();
    f.append("b", brand.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                document.getElementById("msg1").innerHTML = "Brand Added Successfully";
                document.getElementById("msg1").className = "alert alert-success";
                document.getElementById("msgDiv1").className = "d-block";
                brand.value = "";
            } else {
                document.getElementById("msg1").innerHTML = t;
                document.getElementById("msgDiv1").className = "d-block";
            }
        }
    }

    r.open("POST", "registerBrandProcess.php", true);
    r.send(f);
}

function registerCat() {
    var cat = document.getElementById("cat");

    var f = new FormData();
    f.append("c", cat.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                document.getElementById("msg2").innerHTML = "Category Registration Successfully";
                document.getElementById("msg2").className = "alert alert-success";
                document.getElementById("msgDiv2").className = "d-block";
                cat.value = "";
            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("msgDiv2").className = "d-block";
            }

        }
    };

    r.open("POST", "registerCategoryProcess.php", true);
    r.send(f);
}


function registerColor() {
    var color = document.getElementById("color");

    var f = new FormData();
    f.append("clr", color.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                document.getElementById("msg3").innerHTML = "Color Registration Successfully";
                document.getElementById("msg3").className = "alert alert-success";
                document.getElementById("msgDiv3").className = "d-block";
                color.value = "";
            } else {
                document.getElementById("msg3").innerHTML = t;
                document.getElementById("msgDiv3").className = "d-block";
            }

        }
    };

    r.open("POST", "registerColorProcess.php", true);
    r.send(f);
}

function registerModel() {
    var model = document.getElementById("model");

    var f = new FormData();
    f.append("m", model.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 & r.status == 200) {
            var response = r.responseText;

            if (response == "success") {
                document.getElementById("msg4").innerHTML = "Model Registration Successfully";
                document.getElementById("msg4").className = "alert alert-success";
                document.getElementById("msgDiv4").className = "d-block";
                model.value = "";
            } else {
                document.getElementById("msg4").innerHTML = response;
                document.getElementById("msgDiv4").className = "d-block";
            }
        }
    };

    r.open("POST", "registerModelProcess.php", true);
    r.send(f);

}


function loadProduct(x) {
    var page = x;

    var f = new FormData();
    f.append("p", page);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 & r.status == 200) {
            var t = r.responseText;
            // alert(t);
            document.getElementById("pid").innerHTML = t;
        }
    };

    r.open("POST", "loadProductProcess.php", true);
    r.send(f);

}

function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product added to the Wishlist Successfully!") {
                swal("Success!", t, "success");
            } else if (t == "Product Removed from the Wishlist") {
                // document.getElementById("heart" + id).style.className = "text-dark";
                swal("Removed!", t, "error").then((value) => {
                    if (value) {
                        window.location.reload();
                    }
                });
            } else if (t == "Please Login First") {
                swal("You are Not Logged Yet!", t, "error").then((value) => {
                    if (value) {
                        window.location.reload();
                    }
                });
            }
        }
    }

    r.open("GET", "addToWatchlistProcess.php?id=" + id, true);
    r.send();

}

function addToCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product added to the cart successfully!") {
                swal("Success!", t, "success");
            } else {
                swal("You are Not Logged Yet!", t, "error").then((value) => {
                    if (value) {
                        window.location.reload();
                    }
                });

            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function deleteFromCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Product has been removed from the cart") {

                swal("Removed!", t, "warning").then((value) => {
                    if (value) {
                        window.location.reload();
                    }
                });
                // window.location.reload();
            } else {
                // alert(t);
                swal("Error!", t, "error").then((value) => {
                    if (value) {
                        window.location.reload();
                    }
                });
            }

        }
    }

    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();
}

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Product has been removed from the Watchlist") {

                swal("Removed!", t, "warning").then((value) => {
                    if (value) {
                        window.location.reload();
                    }
                });
                // window.location.reload();
            } else {
                // alert(t);
                swal("Error!", t, "error").then((value) => {
                    if (value) {
                        window.location.reload();
                    }
                });
            }


        }
    }

    r.open("GET", "removeFromWatchListProcess.php?id=" + id, true);
    r.send();
}

function loadMainImg(id) {

    var new_img = document.getElementById("product_img" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + new_img + ")";

}

function addProduct() {

    var category = document.getElementById("category").value;
    var brand = document.getElementById("brand").value;
    var model = document.getElementById("model").value;
    var title = document.getElementById("title").value;
    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }
    var clr = document.getElementById("clr").value;
    var qty = document.getElementById("qty").value;
    var cost = document.getElementById("cost").value;
    var dwc = document.getElementById("dwc").value;
    var doc = document.getElementById("doc").value;
    var desc = document.getElementById("desc").value;
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category);
    f.append("b", brand);
    f.append("m", model);
    f.append("t", title);
    f.append("con", condition);
    f.append("col", clr);
    f.append("qty", qty);
    f.append("cost", cost);
    f.append("dwc", dwc);
    f.append("doc", doc);
    f.append("desc", desc);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Product added successfull.");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function incrementCartQty(x) {
    var cartId = x;
    var qty = document.getElementById("qty" + x);
    var newQty = parseInt(qty.value) + 1;
    // alert(newQty);

    var f = new FormData();
    f.append("c", cartId);
    f.append("q", newQty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
            if (t == "success") {
                qty.value = parseInt(qty.value) + 1;
                // loadQty();
                window.location.reload();
            } else {

                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";

            }
        }
    }

    r.open("POST", "updateCartQtyProcess.php", true);
    r.send(f);

}

function decrementCartQty(x) {
    var cartId = x;
    var qty = document.getElementById("qty" + x);
    var newQty = parseInt(qty.value) - 1;
    // alert(newQty);

    var f = new FormData();
    f.append("c", cartId);
    f.append("q", newQty);

    if (newQty > 0) {
        var r = new XMLHttpRequest();
        r.onreadystatechange = function () {
            if (r.status == 200 && r.readyState == 4) {
                var t = r.responseText;
                // alert(t);
                if (t == "success") {
                    qty.value = parseInt(qty.value) - 1;
                    // loadQty();
                    window.location.reload();
                } else {
                    alert(t);
                }
            }
        }

        r.open("POST", "updateCartQtyProcess.php", true);
        r.send(f);
    }
}

function qty_inc(qty) {
    var input = document.getElementById("qty_input");

    if (input.value < qty) {
        var newValue = parseInt(input.value) + 1;
        input.value = newValue;
    } else {
        alert("Maximum quantity has achieved.");
        input.value = qty;
    }

}

function qty_dec() {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {
        var newValue = parseInt(input.value) - 1;
        input.value = newValue;
    } else {
        input.value = 1;
    }
}

function printInvoice() {
    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

// function checkout(pid) {
//     var f = new FormData();
//     f.append("cart", true);

//     var r = new XMLHttpRequest();
//     r.onreadystatechange = function () {
//         if (r.readyState == 4 & r.status == 200) {
//             var t = r.responseText;
//             // alert(t);
//             var payment = JSON.parse(t);
//             // var umail = obj["umail"];
//             // var amount = obj["amount"];

//             // f.append(umail, "umail");
//             // f.append(amount, "amount");


//             // if (t == "address error") {
//             //     alert("Please Update Your Profile.");
//             //     window.location = "userProfile.php";
//             // } else {
//             doCheckout(payment, "checkoutProcess.php");
//         }
//     }
//     // }

//     r.open("POST", "paymentProcess.php", true);
//     r.send(f);
// }

// function doCheckout(payment, path) {

//     // Payment completed. It can be a successful failure.
//     payhere.onCompleted = function onCompleted(orderId) {
//         console.log("Payment completed. OrderID:" + orderId);
//         // Note: validate the payment and show success or failure page to the customer

//         var f = new FormData();
//         f.append("payment", JSON.stringify(payment));

//         var r = new XMLHttpRequest;
//         r.onreadystatechange = function () {
//             if (r.status == 200 && r.readyState == 4) {
//                 var t = r.responseText;
//                 // alert(t);
//                 var order = JSON.parse(t);

//                 if (order.resp == "success") {
//                     // reload();
//                     window.location = "invoice.php?orderId=" + order.order_id;
//                 } else {
//                     alert(t);
//                 }
//             }
//         }

//         r.open("POST", path, true);
//         r.send(f);
//         // if (r.readyState == 4 && r.status == 200) {
//         //     var t = r.responseText;
//         //     alert(t);
//         // }
//     };

//     // Payment window closed
//     payhere.onDismissed = function onDismissed() {
//         // Note: Prompt user to pay again or show an error page
//         console.log("Payment dismissed");
//     };

//     // Error occurred
//     payhere.onError = function onError(error) {
//         // Note: show an error page
//         console.log("Error:" + error);
//     };

//     // Show the payhere.js popup, when "PayHere Pay" is clicked
//     // document.getElementById('payhere-payment').onclick = function (e) {
//     payhere.startPayment(payment);
//     // };

// }

function checkOut() {
    //alert("ok");

    var f = new FormData();
    f.append("cart", true);


    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            //alert(response);
            var payment = JSON.parse(response);
            doCheckout(payment, "checkoutProces.php");

        }
    };

    request.open("POST", "paymentProcess.php", true);
    request.send(f);
}

function doCheckout(payment, path) {

    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer

        var f = new FormData();
        f.append("payment", JSON.stringify(payment));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                // alert(response);
                if (response == "Success") {
                    alert("Payment Successfull.");
                    window.location = "invoice.php?id=" + payment["order_id"];
                } else {
                    alert(response);
                }
            }
        };

        request.open("POST", path, true);
        request.send(f);

    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
    };

    // Show the payhere.js popup, when "PayHere Pay" is clicked
    // document.getElementById('payhere-payment').onclick = function (e) {
    payhere.startPayment(payment);
    // };
}

function payNow(pid) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            var obj = JSON.parse(t);

            var umail = obj["umail"];
            var amount = obj["amount"];

            if (t == "address error") {
                alert("Please Update Your Profile.");
                window.location = "updateProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    // window.location = "invoice.php";
                    invoice(orderId, pid, umail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1222483",    // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/singleProductView.php?id=" + pid,     // Important
                    "cancel_url": "http://localhost/eshop/singleProductView.php?id=" + pid,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": umail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }
        }
    }

    r.open("GET", "payNowProcess.php?id=" + pid + "&qty=" + qty, true);
    r.send();

}

function chartLoad() {

    var ctx = document.getElementById('myChart');

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            // alert(t);
            var data = JSON.parse(t);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: data.labels,
                        data: data.data,
                        backgroundColor: [
                            'rgb(80, 10, 99)',
                            '#ee30d1',
                            'white'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }

    r.open("POST", "chartLoadProcess.php", true);
    r.send();
}

function loadBrands() {

    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            document.getElementById("brand").innerHTML = t;
        }
    }

    r.open("GET", "loadBrandsProcess.php?c=" + category, true);
    r.send();

}

function loadModel() {

    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            document.getElementById("model").innerHTML = t;
        }
    }

    r.open("GET", "loadModel.php?b=" + brand, true);
    r.send();

}

function changeProductImage() {

    var images = document.getElementById("imageuploader");

    images.onchange = function () {

        var file_count = images.files.length;

        if (file_count <= 4) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + "files uploaded. You are proceed to upload 3 or less than 3 files.");
        }

    }

}

function updateSendId(pid) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                window.location = "updateProduct.php";
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendIdProcess.php?pid=" + pid, true);
    r.send();

}

function updateProduct() {

    var title = document.getElementById("title").value;
    var qty = document.getElementById("qty").value;
    var dwc = document.getElementById("dwc").value;
    var doc = document.getElementById("doc").value;
    var descri = document.getElementById("desc").value;
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("title", title);
    f.append("qty", qty);
    f.append("dwc", dwc);
    f.append("doc", doc);
    f.append("descri", descri);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("image" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Product Updated Successful");
                window.location = "stockManage.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "updateProductProcess.php", true);
    r.send(f);

}

function addClr() {

    var colour = document.getElementById("clr_in").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "colourAdd.php?clr=" + colour, true);
    r.send();

}

function invoice(orderId, pid, umail, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", pid);
    form.append("m", umail);
    form.append("a", amount);
    form.append("q", qty);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "invoiceProcess.php", true);
    request.send(form);

}


function changeViewAdmin() {
    var signInBox = document.getElementById("signIn-Box");
    var signInBoxV = document.getElementById("signIn-Box-V");
    var email = document.getElementById("e");
    var password = document.getElementById("p");
    var rm = document.getElementById("rememberme");


    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("rm", rm.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                signInBox.classList.toggle("d-none");
                signInBoxV.classList.toggle("d-none");
                document.getElementById("msg2").innerHTML = "Verification code sent to your email , Please check it";
                document.getElementById("msgdiv2").className = "d-block";
            } else {
                document.getElementById("msg").innerHTML = t;
                document.getElementById("msgdiv").className = "d-block";
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}



function adminSignIn() {
    var e = document.getElementById("e");
    var pw = document.getElementById("p");
    var vcode = document.getElementById("vCode");

    var f = new FormData();
    f.append("e", e.value);
    f.append("pw", pw.value);
    f.append("vcode", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "adminDashboard.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
                document.getElementById("msgdiv2").className = "d-block";
            }
        }
    }

    r.open("POST", "adminSignInProcess.php", true);
    r.send(f);
}


var bm;
function adminforgotPassword() {

    var email = document.getElementById("e");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                document.getElementById("fogotpw1").innerHTML = "Verification Code sent to your email";
                document.getElementById("fogotpwdiv1").className = "d-block";
            } else {
                document.getElementById("fogotpw1").innerHTML = t;
                document.getElementById("fogotpwdiv1").className = "d-block";
            }


        }

    }

    r.open("GET", "adminForgotPasswordProcess.php?e=" + email.value, true);
    r.send();


}

function adminchangePassword() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("forgetPassword").innerHTML = t;
        }
    }
    r.open("GET", "adminfogotPassword.php", true);
    r.send();
}


function adminresetPassword() {

    var email = document.getElementById("e");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vCode");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                document.getElementById("fogotpw1").innerHTML = "Your Password Updated";
                document.getElementById("fogotpwdiv1").className = "d-block";
                // bm.hide();
                setTimeout(() => location.reload(), 3000);
            } else {
                document.getElementById("fogotpw1").innerHTML = t;
                document.getElementById("fogotpwdiv1").className = "d-block";
            }
        }
    };

    r.open("POST", "adminresetPasswordProcess.php", true);
    r.send(f);

}

function adminsignout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t = "success") {
                window.location = "adminSignin.php";
            }
        }
    }

    r.open("GET", "adminsignoutprocess.php", true);
    r.send();
}

function alertLogin() {
    Swal.fire({
        icon: "error",
        title: "You are Not Logged Yet!",
        text: "Please Login First"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "signin.php";
        }
    });
}


function adminalertLogin() {
    Swal.fire({
        icon: "error",
        title: "You are Not Logged Yet!",
        text: "Please Login First"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "adminSignin.php";
        }
    });
}
// function promptSignIn() {
//     Swal.fire({
//         icon: 'error',
//         title: 'Please log in first',
//         text: 'You need to log in to proceed with the purchase.'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             window.location = 'signin.php';
//         }
//     });
// }

function manageUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "Deactivated") {
                document.getElementById("a" + email).innerHTML = "Activate";
                document.getElementById("a" + email).classList = "btn btn-info fw-bold";
            } else if (t == "Activated") {
                document.getElementById("d" + email).innerHTML = "Deactivate";
                document.getElementById("d" + email).classList = "btn btn-dark";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "adminUserManageProcess.php?email=" + email, true);
    r.send();
}

function searchUser() {

    var txt = document.getElementById("user");

    var f = new FormData();
    f.append("t", txt.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("searchUser").innerHTML = t;
        }
    }

    r.open("POST", "searchUserProcess.php", true);
    r.send(f);

}

function changeStatus(id) {

    var product_id = id;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "activated" || t == "deactivated") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "changeStatusProcess.php?p=" + product_id, true);
    r.send();

}





