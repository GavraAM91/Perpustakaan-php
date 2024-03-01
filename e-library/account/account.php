<?php

include 'connection.php';

session_start();

$user_id = $_SESSION['user_name'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>user page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="style/style_account.css">
   <link rel="stylesheet" href="../style/style_order.css">


</head>
<body>

<h1 class="title"> <span>user</span> profile page </h1>

<section class="profile-container">

<?php
   $select_profile = $conn->prepare("SELECT * FROM `users` WHERE username = ?");
   $select_profile->bind_param("s", $user_id);
   $select_profile->execute();
   $result = $select_profile->get_result();

   // Check if the query returned any results
   if ($result && $fetch_profile = $result->fetch_assoc()) {
   ?>
      <div class="profile">
         <img src="../img-profile/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['username']; ?></h3>
         <a href="update_profile.php" class="btn btn-primary-outline" name="update-profile">update profile</a>
         <a href="../order.php" class="btn btn-primary-outline">My Order</a>
         <a href="../users/index.php" class="btn">view shop</a>
         <a href="logout.php" class="btn btn-danger-outline">logout</a>
      </div>
   <?php
   } else {
      echo "No profile found for user with ID: $user_id";
   }

   // Close the prepared statement
   $select_profile->close();
   ?>


</section>
</body>
</html>