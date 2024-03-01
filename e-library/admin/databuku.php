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
  <title>Import Data</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/sb-admin-2.css">
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

  <?php //include '../header.php'; ?>
  <div class="top">
    <h3><b>DATA BUKU</b></h3>
    <div class="tombol-opsi">
      <a href="tambah_buku.php"><button class="btn btn-primary me-md-2" type="button">Tambah data</button></a>
      <a href="delete_all_buku.php"><button type="button" class="btn btn-danger">Delete all</button></a>
    </div>
  </div>
  <table class="table table-striped table-hover table-bordered" border=1>
    <tr>
      <th>NOMOR</th>
      <th>GAMBAR</th>
      <th>NAMA BUKU</th>
      <th>NOMOR BUKU</th>
      <th>DESKRIPSI</th>
      <th>PENULIS</th>
      <th>PENERBIT</th>
      <th>TANGGAL TERBIT</th>
      <th>JUMLAH BUKU</th>
      <th>OPTION</th>
    </tr>
    <?php
    //pemanggilan database
    include 'connection.php';

    //digunakan untuk mengisi bagian nomer
    $no = 1;

    //menampilkan database dengan perulangan 
    $query = "SELECT * FROM `data_buku`";
    $data = mysqli_query($conn, $query);
    while ($d = mysqli_fetch_array($data)) {
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><img src="../image_data/<?php echo $d['image']; ?>"></td>
        <td><?= $d['book_name']; ?></td>
        <td><?= $d['book_number']; ?></td>
        <td><?= $d['description']; ?></td>
        <td><?= $d['penulis']; ?></td>
        <td><?= $d['penerbit']; ?></td>
        <td><?= $d['tanggal_terbit']; ?></td>
        <td><?= $d['jumlah_buku']; ?></td>
        <td>
          <div class="option">
            <a href="delete_buku.php?id=<?= $d['id_buku'] ?>"><button type="button" class="btn btn-danger">Delete</button></a>
            <a href="edit_buku.php?id=<?= $d['id_buku'] ?>"><button type="button" class="btn btn-warning">Edit</button></a>
          </div>
        </td>
      </tr>
    <?php } ?>
  </table>
  <section>
</body>

</html>