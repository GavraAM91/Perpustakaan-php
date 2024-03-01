<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_edit_buku.css">
    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,700;1,600&display=swap" rel="stylesheet">

</head>

<body>
    <?php
    include 'connection.php';
    //menangkap link yang dikirim dari URL
    $id = $_GET['id_user'];

    //menyimpan data yang ada dalam database
    $query = "SELECT * FROM `data_buku` WHERE id_buku = '$id'";
    $data = mysqli_query($conn, $query);

    while ($d = mysqli_fetch_array($data)) {
    ?>

    <div class="form_reg">
        <form action="update_buku.php" method="post" enctype="multipart/form-data">
            <h1>EDIT DATA BUKU</h1>

            <div class="row mb-3">
                <input type="hidden" name="id" value="<?= $d['id']; ?>">

                <label for="book_name" class="form-label">Book Name : </label>
                <input type="text" class="form-control" name="book_name" id="book_name" placeholder="Masukkan nama buku" value="<?= $d['book_name']; ?>">

                <label for="image" class="form-label">image : </label>
                <input type="file" class="form-control" name="image" id="image" placeholder="Masukkan nama image" value="<?= $d['image']; ?>">

                <label for="book_number" class="form-label">book_number : </label>
                <input type="number" class="form-control" name="book_number" id="book_number" placeholder="Masukkan nomor buku" value="<?= $d['book_number']; ?>">

                <label for="description" class="form-label">description : </label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Masukkan description" value="<?= $d['description']; ?>">

                <label for="penulis" class="form-label">penulis : </label>
                <input type="text" class="form-control" name="penulis" id="penulis" placeholder="masukkan penulis" value="<?= $d['penulis']; ?>">

                <label for="penerbit" class="form-label">penerbit : </label>
                <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="masukkan penerbit" value="<?= $d['penerbit']; ?>">

                <label for="tanggal_terbit" class="form-label">tanggal_terbit : </label>
                <input type="date" class="form-control" name="tanggal_terbit" id="tanggal_terbit" placeholder="Masukkan tanggal terbit" value="<?= $d['tanggal_terbit']; ?>">

                <button class="btn btn-primary" type="submit" value="submit">SUBMIT</button>
            </div>
        </form>
    <?php } ?>
    </div>
</body>

</html>