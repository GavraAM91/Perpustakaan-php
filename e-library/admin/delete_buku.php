<?php 
    //connect database  
    include 'connection.php';

    //menangkap data yg dikirim dari URL 
    $id = $_GET['id_buku'];

    //query untuk menghapus data dengan id 
    $query = "DELETE FROM `data_buku` WHERE id_buku = '$id'";
    $result = mysqli_query($conn, $query);

    //mengalihkan halaman langsung ke index.php
    header("Location: databuku.php");
?>