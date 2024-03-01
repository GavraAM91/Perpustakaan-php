<?php
include 'connection.php';

if (isset($_POST['submit'])) {

    $book_name = $_POST['book_name'];
    $book_number = $_POST['book_number'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tanggal_terbit = date('Y-m-d', strtotime($_POST['tanggal_terbit']));
    $jumlah_buku = $_POST['jumlah_buku'];

    // Validasi data
    // if (empty($image)) {
    //     echo "Nama file gambar tidak boleh kosong.";
    //     exit();
    // }

    if (empty($book_name)) {
        echo "Nama buku tidak boleh kosong.";
        exit();
    }
    if (empty($book_number)) {
        echo "Nomor buku tidak boleh kosong.";
        exit();
    }
    if (empty($description)) {
        echo "Nomor buku tidak boleh kosong.";
        exit();
    }
    if (empty($penulis)) {
        echo "deskripsi tidak boleh kosong.";
        exit();
    }
    if (empty($penerbit)) {
        echo "Nama penerbit tidak boleh kosong.";
        exit();
    }
    if (empty($tanggal_terbit)) {
        echo "Tanggal terbit tidak boleh kosong.";
        exit();
    }

    // Proses upload gambar
    $foto = $_FILES['image']['name'];
    $ukuran_file = $_FILES['image']['size'];
    $tipe_file = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $tmp_file = $_FILES['image']['tmp_name'];
    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    //cek apakah yang diupload gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $foto);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    //cek jika ukuran terlalu besar 
    if ($ukuran_file > 1500000) {
        echo "<script>
                alert('ukuran terlalu besarr!');
            </script>";
        return false;
    }



    if (move_uploaded_file($tmp_file, 'image_data/')) {
        // Proses simpan ke database
        $query = "INSERT INTO data_buku (`id_buku`, `image`, `book_name`, `book_number`, `description`, `penulis`, `penerbit`, `tanggal_terbit`, `jumlah_buku`) 
                    VALUES ('','$foto','$book_name','$book_number','$description',
                            '$penulis','$penerbit','$tanggal_terbit','$jumlah_buku')";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            echo "<script>alert('Data berhasil ditambahkan')</script>";
            header("location: databuku.php");
        } else {
            echo "<script>
                    alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.')
                </script>";
            header('location: databuku,php');
        }
    } else {

        echo "Gagal mengunggah gambar. Kode Kesalahan: " . $_FILES['image']['error'];
        echo "<br><a href='form.php'>Kembali Ke Form</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah buku</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style_edit_buku.css">
    <!--FONT-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,700;1,600&display=swap" rel="stylesheet">
    <!--JAVASCRIPT-->
    <script src="script.js"></script>

</head>

<body>
    <div class="form_reg">
        <h1>TAMBAH DATA BUKU</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Insert Image : </label>
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
            </div>
            <div class="form-group">
                <label for="book_name">Book name : </label>
                <input type="text" class="form-control" id="book_name" name="book_name" placeholder="Enter book_name" required>
            </div>
            <div class="form-group">
                <label for="book_number">Book Number : </label>
                <input type="text" class="form-control" id="book_number" name="book_number" placeholder="Enter book_number" required>
            </div>
            <div class="form-group">
                <label for="description">description: </label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis : </label>
                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Enter penulis" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Penerbit : </label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="penerbit buku" required>
            </div>
            <div class="form-group">
                <label for="tanggal_terbit">Tanggal Terbit : </label>
                <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" placeholder="tanggal_terbit" required>
            </div>
            <div class="form-group">
                <label for="jumlah_buku">jumlah buku: </label>
                <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" placeholder="jumlah_buku" required>
            </div>
            <div class="submit">
                <button type="submit" name="submit" class="btn btn-primary">Tambah buku!</button>
            </div>
        </form>
    </div>
</body>

</html>