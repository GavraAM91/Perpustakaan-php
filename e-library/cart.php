<?php
@include 'connection.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   }
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

if(isset($_POST['checkout'])){  // Changed to POST method
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
   if(mysqli_num_rows($select_cart) == 0){
      echo '<script>alert("Your cart is empty. Add items before checkout.");</script>';
      header('location:users\index.php'); // Redirect to the homepage if the cart is empty
      exit(); // Added exit to stop further execution
   } else {
      header('location:checkout.php'); // Proceed to checkout if the cart is not empty
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/style.css">
</head>
<body>

<?php 
   // include 'header.php';
 ?>

<div class="container">
   <section class="shopping-cart">
      <h1 class="heading">Cart</h1>
      <form action="" method="post"> <!-- Assuming you want to use the GET method -->
         <table>
            <thead>
               <th>image</th>
               <th>name</th>
               <th>quantity</th>
               <th>action</th>
            </thead>
            <tbody>
               <?php 
               $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
               $grand_total = 0;
               if(mysqli_num_rows($select_cart) > 0){
                  while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                     ?>
                     <tr>
                        <td><img src="image_data/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $fetch_cart['name']; ?></td>
                        <td>
                           <form action="" method="post">
                              <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                              <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>" disabled>

                           </form>   
                        </td>
                        <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
                     </tr>
                     <?php
                     $grand_total += $fetch_cart['quantity']; // Update grand total
                  }
               }
               ?>
               <tr class="table-bottom">
                  <td><a href="users/index.php" class="option-btn" style="margin-top: 0;">continue rent</a></td>
                  <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
               </tr>
            </tbody>
         </table>
         <div class="checkout-btn">
            <input type="submit" name="checkout" class="btn btn-primary <?= ($grand_total > 1)?'':''; ?>" value="proceed to checkout">
         </div>
      </form>
   </section>
</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
