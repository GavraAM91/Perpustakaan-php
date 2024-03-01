<header class="header">

   <div class="flex">
      <?php 
         // if ($_SESSION['user_name']) {
         //    echo'<a href="#" class="logo">E-Library</a>';
         // } if ($_SESSION['admin_name']) {
         //    echo '<a href="#" class="logo">data buku</a>';
         // }
         
      ?>
      <a href="index.php" class="logo">E-Library</a>
     

      <?php
      include 'connection.php';
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="../cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>
      
      <nav class="navbar">
         <a href="../account/account.php">account</a>
      </nav>
      
      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>