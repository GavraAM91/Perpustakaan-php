<?php 
    //koneksi ke database
    include 'connection.php';

    //inisialisasi data
    $id = $_POST['id'];
    $book_name = $_POST['book_name'];
    $book_number = $_POST['book_number'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tanggal_terbit = date('Y-m-d', strtotime($_POST['tanggal_terbit']));

    //proses upload gambar
    $foto = $_FILES['image']['name'];
    $ukuran_file = $_FILES['image']['size'];
    $tipe_file = $_FILES['image']['type'];
    $tmp_file = $_FILES['image']['tmp_name'];

    $query = "UPDATE `data_buku` SET `book_name`='$book_name', `image`='$foto',
            `book_number`='$book_number',`description`='$description',`penulis`='$penulis',`penerbit`='$penerbit',
            `tanggal_terbit`='$tanggal_terbit' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika berhasil, arahkan kembali ke halaman index.php
        echo "<script>
            alert('data berhasil ditambahkan');
        </script>";
        header("location:../admin/databuku.php");
    } else {
        // Jika gagal, tampilkan pesan kesalahan
        echo "<script>
        alert('data gagal ditambahkan');
    </script>";
    header("location:../admin/databuku.php");
    mysqli_error($conn);
    }
?>