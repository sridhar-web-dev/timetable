<?php

// error_reporting(0);
session_start();
include('./config.php');
if(isset($_POST['register']))
{
    $name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$verify = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($con, $verify);
while ($row = mysqli_fetch_assoc($result)) {
    $email1 = $row['email'];
}
if ($email != $email1) {
    $sqli = "INSERT INTO user (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    $result = mysqli_query($con, $sqli);
    if ($result) {
        $_SESSION['email'] = $_POST['email'];
        echo '<script>alert("Registered Successfully");window.location.replace("user.php");</script>';
    }
} else {
    echo '<script>alert("Email Address Already Exist");window.location.replace("user.php");</script>';
}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
    <section class="my-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5>Create a Account</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Enter Name</label>
                                    <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp">                                    
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label">Enter Email</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">                                    
                                </div>
                                <div class="mb-2">
                                    <label for="phone" class="form-label">Enter Phone number</label>
                                    <input type="phone" class="form-control" name="phone" id="phone" aria-describedby="emailHelp">                                    
                                </div>
                                <div class="mb-2">
                                    <label for="password" class="form-label">Enter Password</label>
                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp" oninput="validatePassword()">                                    
                                </div>
                                <div class="mb-2">
                                    <label for="confirmPassword" class="form-label">Enter confirm password</label>
                                    <input type="password" class="form-control" name="confirmpassword" id="confirmPassword" aria-describedby="emailHelp" oninput="validatePassword()">                                    
                                </div>
                                <p id="passwordError" class="error text-danger"></p>
                                <div class="mb-2">                                    
                                    <input type="submit" class="btn btn-sm btn-primary w-100" name="register" id="register" aria-describedby="emailHelp">                                    
                                </div>
                            </form>
                            <p class='text-center mt-2'>Hava an account? <a href="./login.php">LogIn Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var errorElement = document.getElementById("passwordError");

            if (password !== confirmPassword) {
                errorElement.textContent = "Passwords do not match!";
                document.getElementById("register").disabled = true;
            } else {
                errorElement.textContent = "";
                document.getElementById("register").disabled = false;
            }
        }
    </script>
</html>