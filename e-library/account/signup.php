<?php
include 'connection.php';
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST)) {
        header("Location: index.php");
        exit;
    } else {
        echo  "Registration failed. " . mysqli_error($conn);
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_signup.css">
    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,700;1,600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form_reg">
        <form method="post" action="" enctype="multipart/form-data">
            <h1><b>SIGN UP</b></h1>
            <div class="form-group">
                <label for="image">Insert Image : </label>
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="t_number">Nomer telepon</label>
                <input type="number" class="form-control" id="t_number" name="t_number" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
            </div>
            <p>Already have account? <a href="login.php">login</a></p>
            <div class="submit">
                <button type="submit" name="register" class="btn btn-primary">sign up</button>
            </div>
        </form>
    </div>
</body>

</html>