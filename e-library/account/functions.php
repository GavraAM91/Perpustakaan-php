<?php
//inisialisasi data 
require 'connection.php';


//function for signup 
function registrasi($data)
{
    //mengidentifikasi fungsi global 
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email =  $data["email"];
    $t_number = $data["t_number"];
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $data["confirmPassword"]);

    // if(mysqli_affected_rows($conn) > 0) {
    //     echo "<script>
    //         alert('data berhasil ditambahkan');  
    //     </script";
    // }
    
    //profile picture program 
    $foto = $_FILES['image']['name'];
    $ukuran_file = $_FILES['image']['size'];
    $tipe_file = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $tmp_file = $_FILES['image']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if($error === 4) {
        echo "<script>
            alert('pilih gambar terlebih dahulu!');
        </script>";
        return false;
    }

    //cek apakah yang diupload gambar
    $ekstensiGambarValid = ['jpg' ,'jpeg', 'png'];
    $ekstensiGambar = explode('.',$foto);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
            alert('yang anda upload bukan gambar!');
        </script>";
        return false;
    }

    //cek jika ukuran terlalu besar 
    if($ukuran_file > 1500000) {
        echo "<script>
            alert('ukuran terlalu besarr!');
        </script>";
        return false;
    }

    //jika lolos pengecekan, gambar siap diupload
    $image_folder = '../img-profile/'.$foto;
    // Move uploaded file to designated folder
    move_uploaded_file($tmp_file, $image_folder);
    
    //cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('username sudah digunakan');
        </script>";
        return false;
    }


    //konfirmasi email sudah ada / belum
    $result = mysqli_query($conn, "SELECT email  FROM users WHERE email = '$email'");
    if (mysqli_fetch_array($result)) {
        echo "<script>
            alert('Email sudah digunakan');
        </script>";
        return false;
    }

    $result = mysqli_query($conn, "SELECT t_number FROM users WHERE t_number = '$t_number'");
    if (mysqli_fetch_array($result)) {
        echo "<script>
            alert('Nomer telepon sudah digunakan');
        </script>";
        return false;
    }

    //konfirmasi password 
    if ($password !== $confirm_password) {
        echo "<script> 
            alert('password tidak sama!');
        </script>";

        return false;
    }

    //notif data berhasil ditambahkan
    if (mysqli_affected_rows($conn) > 0) {
        header('Location: index.php');
        echo "<script>
        alert('data berhasil ditambahkan');
        </script>";
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan data ke dalam database 
    $sql = "INSERT INTO `users`(`id_user`, `image`, `username`, `email`, `t_number`, `password`) VALUES('', '$image_folder', '$username', '$email', '$t_number', '$password')";
    if (mysqli_query($conn, $sql)) {
        // Data was successfully inserted
        echo "<script>
            alert('Data berhasil ditambahkan');
            window.location = 'login.php'; // Redirect to login.php
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
