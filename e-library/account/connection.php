<?php
$conn = mysqli_connect("localhost","root","","db_library");

    if(!isset($conn)) {
        die("<script>alert('Database not connected')</script>");
    }
?>