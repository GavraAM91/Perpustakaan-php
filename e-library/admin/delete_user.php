<?php 
    //connect database  
    include 'connection.php';

    //menangkap data yg dikirim dari URL 
    $id = $_GET['id_user'];

    //query untuk menghapus data dengan id 
    $query = "DELETE FROM `users` WHERE id_user = '$id'";
    $result = mysqli_query($conn, $query);

    //mengalihkan halaman langsung ke index.php
    header("Location: user_data.php");
?>