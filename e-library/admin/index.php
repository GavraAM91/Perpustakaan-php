<?php
include 'connection.php';

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location: ../account/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_index.css">
    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,700;1,600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">

        <div class="content">
            <h2><b>Halo <span><?php echo $_SESSION['user_name']; ?></span></b></h2>
            <p>this is an admin page</p>
            <a href="user_data.php" class="btn">User Data</a>
            <a href="databuku.php" class="btn">Books Data</a>
            <a href="../account/logout.php" class="btn">logout</a>
        </div>
    </div>
</body>

</html>