<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style/sb-admin-2.css">
  <link rel="stylesheet" href="style/style.css">
  <!--FONT-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,700;1,600&display=swap" rel="stylesheet">

</head>

<body>
<?php
include('header.php');
include('navbar.php'); 
?>
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Data Buku</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../admin/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../account/account.php">Account</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->
    <table class="table table-striped table-hover table-bordered" border=1>
      <h3>USER DATA</h3>
        <tr>
            <th>No</th>
            <th>book name</th>
            <th>Quantity</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>street</th>
            <th>city</th>
            <th>random code</th>
        </tr>
        <?php
        include 'connection.php';

        $no = 1;

        $query = "SELECT * FROM `order`";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['book_name']; ?></td>
                <td><?= $row['quantity']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['phone_number']?></td>
                <td><?= $row['email']?></td>
                <td><?= $row['street']?></td>
                <td><?= $row['city']?></td>
                <td><?= $row['random_code']?></td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>