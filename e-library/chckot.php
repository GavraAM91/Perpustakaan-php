<?php
session_start();

@include 'connection.php';
function generateRandomCode()
{
    $prefix = 'BOOKS'; // You can customize the prefix
    $randomCode = $prefix . uniqid() . mt_rand(1000, 9999);

    return $randomCode;
}

$randomCode = generateRandomCode();
$user_id = $_SESSION['user_name'];
if(isset($_POST['order_btn'])){

   $book_name = $_POST['name_book'];
   $quantity = $_POST['quantity'];
   $name = $_POST["name"];
   $email = $_POST["email"];
   $phone_number = $_POST['phone_number'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $random_code = $_POST['random_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
    $price_total = 0;
    if (mysqli_num_rows($cart_query) > 0) {
        // if(mysqli_num_rows($cart_query) == 0){
        //     echo '<script>alert("Your cart is empty. Add items before checkout.");</script>';
        //     header('location:index.php'); // Redirect to the homepage if the cart wis empty
        // }
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
        };
    }

    $total_product = implode(', ', $product_name);
    $query = "INSERT INTO `order`(`id`,`book_name`,`quantity`,`name`,`phone_number`, `email`, `street`, `city`,`random_code`) 
    VALUES ('','$book_name','$quantity','$name','$phone_number','$email','$street','$city','$random_code')";

    $detail_query = mysqli_query($conn, $query);
 
    if ($cart_query && $detail_query) {
        echo "  
       <div class='order-message-container'>
       <div class='message-container'>
          <h3>terimakasih telah meminjam!</h3>
          <div class='order-detail'>
             <span>" . $total_product . "</span>
          </div>
          <div class='customer-details'>
             <p> your name : <span>" . $name . "</span> </p>
             <p> your number : <span>" . $phone_number . "</span> </p>
             <p> your email : <span>" . $email . "</span> </p>
             <p> your address : <span>" . $street . ", " . $city . "</span> </p>
             <p> your Code : <span>" . $randomCode . "</span> </p>
          </div>
             <a href='users/index.php' class='btn'>continue shopping</a>
          </div>
       </div>
       ";
          //mysqli_query($conn, "DELETE FROM `cart`");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

        <section class="checkout-form">

            <h1 class="heading">complete your order</h1>

            <form action="" method="post">

                <div class="display-order">
                    <?php
                    $account = mysqli_query($conn, "SELECT * FROM users");
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
                    $total = 0;
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $book_name = $fetch_cart['name'];
                            $quantity = $fetch_cart['quantity'];
                    ?>
                            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                    <?php

                        }
                    } else {
                        echo "<div class='display-order'><span>your cart is empty!</span></div>";
                    }
                    ?>
                </div>
                <div class="flex">
                       <input type="hidden" value="<?php echo $book_name; ?>" name="name_book" required>
                        <input type="hidden" value="<?php echo $quantity; ?>" name="quantity" required>
                    <div class="inputBox">
                        <span>your name</span>
                        <input type="text" placeholder="enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>your phone number</span>
                        <input type="number" placeholder="enter your phone number" name="phone_number" required>
                    </div>
                    <div class="inputBox">
                        <span>your email</span>
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>street</span>
                        <input type="text" placeholder="e.g. street name" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>city</span>
                        <input type="text" placeholder="e.g. Tulungagung" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>Random Code : </span>
                        <input type="text" name="random_code" value="<?php echo $randomCode; ?>" readonly>
                    </div>
                </div>
                <input type="submit" value="order now" name="submit" class="btn btn-outline-primary">
            </form>
        </section>
    </div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>