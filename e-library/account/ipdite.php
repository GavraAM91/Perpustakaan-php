<?php

include 'connection.php';

session_start();

if (!isset($_SESSION['user_name'])) {
   header('location: ../account/login.php');
   exit(); // Make sure to exit after a header redirect
}

$user_id = $_SESSION['user_name'];

if(isset($_POST['update'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   
   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = 'uploaded_img/'.$image;

   if(!empty($image)){

      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $update_image->bind_param("si", $image, $user_id);
         $update_image->execute();
         $update_image->close();

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('uploaded_img/'.$old_image);
            $message[] = 'image has been updated!';
         }
      }

   }

   // $old_pass = $_POST['old_pass'];
   // $previous_pass = md5($_POST['previous_pass']);
   // $previous_pass = filter_var($previous_pass, FILTER_SANITIZE_STRING);
   // $new_pass = md5($_POST['new_pass']);
   // $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   // $confirm_pass = md5($_POST['confirm_pass']);
   // $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   // if(!empty($previous_pass) || !empty($new_pass) || !empty($confirm_pass)){
   //    if($previous_pass != $old_pass){
   //       $message[] = 'old password not matched!';
   //    }elseif($new_pass != $confirm_pass){
   //       $message[] = 'confirm password not matched!';
   //    }else{
   //       $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
   //       $update_password->bind_param("si", $confirm_pass, $user_id);
   //       $update_password->execute();
   //       $update_password->close();
   //       $message[] = 'password has been updated!';
   //    }
   // }

   // Close the connection
   $conn->close();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>user profile update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/style_account.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<h1 class="title"> update <span>user</span> profile </h1>

<section class="update-profile-container">

   <?php
      $select_profile = mysqli_query($conn, "SELECT * FROM `users` WHERE id_user = '$user_id'");
      while($fetch_profile = mysqli_fetch_array($select_profile)) { 
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="img-profile/<?= $fetch_profile['image']; ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>username : </span>
            <input type="text" name="name" required class="box" placeholder="enter your name" value="<?= $fetch_profile['username']; ?>">
            <span>email : </span>
            <input type="email" name="email" required class="box" placeholder="enter your email" value="<?= $fetch_profile['email']; ?>">
            <span>profile pic : </span>
            <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
         </div>

         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span>old password :</span>
            <input type="password" class="box" name="previous_pass" placeholder="enter previous password" >
            <span>new password :</span>
            <input type="password" class="box" name="new_pass" placeholder="enter new password" >
            <span>confirm password :</span>
            <input type="password" class="box" name="confirm_pass" placeholder="confirm new password" >
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" value="update_profile" name="update" class="btn">
         <a href="user_page.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php } ?>

</section>

</body>
</html>