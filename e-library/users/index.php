<?php

include 'connection.php';

session_start();
if (!isset($_SESSION['user_name'])) {
   header('location: ../account/login.php');
}

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
 
   if (mysqli_num_rows($select_cart) > 0) {
      $message[] = 'product already added to cart';
   } else {
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, image, quantity) VALUES('$product_name', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>E-Library</title>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <link rel="stylesheet" href="style/style_index.css">
   <!--FONT-->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,700;1,600&display=swap" rel="stylesheet">

   <style>
      /* img-property { 
         background-image: url('img-property/background.jpg');
         background-size: cover;
         background-repeat: no-repeat;
         background-position: center;
      } */
      img-detail {
         padding : 70px;
      }
   </style>
</head>

<body>

   <?php include '../header.php' ?>
   <div class="top">
   <!-- <img src="../img-property/background.jpg" class="img-property" alt=""> -->
      <h1><b>Halo <span><?php echo $_SESSION['user_name']; ?></span></b></h1>
      <p class="p">Mau pinjam buku apa hari ini?</p>
      <!-- <img src="../img-property/person_index.jpg" alt=""> -->
   </div>

   <div class="title-menu">
      <h3>Buku yang tersedia</h3>
   </div>

   <div class="container">
      <section class="products">
         <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `data_buku`");
            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_product = mysqli_fetch_assoc($select_products)) {

                  $description = $fetch_product["description"];
                  $description = substr($description, 0, 150);

            ?>
                  <div class="col-md-6">
                     <div class="card mb-3">
                        <div class="row g-0">
                           <div class="col-md-4">
                              <img src="../image_data/<?php echo $fetch_product['image']; ?>" class="card-img-top " alt="">
                           </div>
                           <div class="col-md-8">
                              <div class="card-body">
                                 <h5 class="card-title"><?php echo $fetch_product['book_name']; ?></h5>
                                 <p class="card-text">Penulis : <?= $fetch_product['penulis'] ; ?></p>
                                 <p class="card-text"><?= $description ; ?></p>
                                 <form method="post" action="">
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['book_name']; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                    <input type="submit" class="btn btn-outline-warning" value="add to cart" name="add_to_cart">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#book_data_<?php echo $fetch_product['id_buku']; ?>">
                                       View Detail
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="book_data_<?php echo $fetch_product['id_buku']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="book_name"><?php echo $fetch_product['book_name']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body">
                                                <img src="../image_data/<?php echo $fetch_product['image']; ?>" class="img-detail" alt="">
                                                <p><b>Book Number : </b><?php echo $fetch_product['book_number']; ?></p>
                                                <p><b>Description :</b><?php echo $fetch_product['description']; ?></p>
                                                <p><b>Penulis  :</b><?php echo $fetch_product['penulis']; ?></p>
                                                <p><b>Penerbit : </b><?php echo $fetch_product['penerbit']; ?></p>
                                                <p><b>Tanggal Terbit :</b><?php echo $fetch_product['tanggal_terbit']; ?></p>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-outline-warning" value="add to cart" name="add_to_cart">
                                             </div>   
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            <?php
               }
            }
            ?>
         </div>
      </section>
   </div>
   <!-- <script>
      $(document).ready(function() {
         
         // Fungsi Detail
         $('.detail').click(function() {
            var dataSiswa = $(this).attr("data-id");
                $.ajax({

                    success: function(data) {
                       $('#detail-siswa').html(data);
                       $('#detail').modal("show");
                     }
                  });
               });
               // Fungsi Detail
            });
            </script> -->
            <?php include '../footer.php'; ?>
</body>

</html>